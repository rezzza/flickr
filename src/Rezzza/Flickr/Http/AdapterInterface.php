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
}
