<?php

namespace Rezzza\Flickr\Http;

use Guzzle\Http\Client;

/**
 * GuzzleAdapter
 *
 * @uses AdapterInterface
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class GuzzleAdapter implements AdapterInterface
{
    
    private $client;
    
    public function __construct()
    {
        if (!class_exists('\Guzzle\Http\Client')) {
            throw new \LogicException('Please, install guzzle/http before using this adapter.');
        }
        
        $this->client  = new Client('', array('redirect.disable' => true));
    }
    
    /**
     * {@inheritdoc}
     */
    public function post($url, array $data = array(), array $headers = array())
    {
        $request = $this->client->post($url, $headers, $data);
        // flickr does not supports this header and return a 417 http code during upload
        $request->removeHeader('Expect');

        return $request->send()
            ->xml();
    }
    
    /**
     * @return $client
     */
    public function getClient()
    {
        return $this->client;
    }
}
