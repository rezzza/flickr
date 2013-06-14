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
    /**
     * {@inheritdoc}
     */
    public function post($url, array $data = array(), array $headers = array())
    {
        if (!class_exists('\Guzzle\Http\Client')) {
            throw new \LogicException('Please, install guzzle/http before using this adapter.');
        }

        $client  = new Client('', array('redirect.disable' => true));
        $request = $client->post($url, $headers, $data);
        // flickr does not supports this header and return a 417 http code during upload
        $request->removeHeader('Expect');

        return $request->send()
            ->xml();
    }
}
