<?php

namespace Rezzza\Flickr\Http;

/**
 * AdapterInterface
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
interface AdapterInterface
{
    /**
     * @param string $url     url
     * @param array  $data    data
     * @param array  $headers headers
     *
     * @return \SimpleXMLElement
     */
    public function post($url, array $data = array(), array $headers = array());

    /**
     * @param array $requests
     * An array of Requests
     * Each Request is an array with $url, $data and $headers
     *
     * @return \SimpleXMLElement[]
     */
    public function multiPost(array $requests);
}
