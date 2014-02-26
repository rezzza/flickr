<?php
/**
 * Created by PhpStorm.
 * User: Leonardo
 * Date: 25/02/14
 * Time: 21:52
 */

class GuzzleAdapterTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \Rezzza\Flickr\Http\AdapterInterface
     */
    protected $guzzle_adapter;

    public function setUp() {
        $this->guzzle_adapter = new \Rezzza\Flickr\Http\GuzzleAdapter();
    }

    public function testMultiPost() {
        $responses = $this->guzzle_adapter->multiPost(array(
            array('url' => 'http://www.ebussola.com', 'data' => array(), 'headers' => array()),
            array('url' => 'http://posttestserver.com', 'data' => array(), 'headers' => array())
        ));
        $this->assertCount(2, $responses);

        foreach ($responses as $response) {
            $this->assertInstanceOf('\SimpleXMLElement', $response);
        }
    }

}