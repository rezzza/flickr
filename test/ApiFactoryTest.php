<?php
/**
 * Created by PhpStorm.
 * User: Leonardo
 * Date: 25/02/14
 * Time: 22:28
 */

class ApiFactoryTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \Rezzza\Flickr\ApiFactory
     */
    protected $api;

    public function setUp()
    {
        $config = include 'config.php';

        $metadata = new \Rezzza\Flickr\Metadata($config['key'], $config['secret']);
        $metadata->setOauthAccess($config['access_token'], $config['secret_access_token']);

        $this->api = new \Rezzza\Flickr\ApiFactory($metadata, new \Rezzza\Flickr\Http\GuzzleAdapter());
    }

    public function testMultiCall()
    {
        $recents_xml = $this->api->call('flickr.photos.getRecent');

        $calls = array();
        foreach ($recents_xml->photos->photo as $photo_metadata_xml) {
            $photo_id = (string)$photo_metadata_xml['id'];
            $calls[] = array('service' => 'flickr.photos.getSizes', 'parameters' => array('photo_id' => $photo_id), 'endpoint' => null);
        }

        $photos_xml = $this->api->multiCall($calls);
        foreach ($photos_xml as $photo_xml) {
            $this->assertInstanceOf('\SimpleXMLElement', $photo_xml);
            $this->assertObjectNotHasAttribute('err', $photo_xml);
        }
    }

}