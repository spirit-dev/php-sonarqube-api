<?php
/**
 * Copyright (c) 2016. Spirit-Dev
 *    _             _
 *   /_`_  ._._/___/ | _
 * . _//_//// /   /_.'/_'|/
 *    /
 *
 * By Jean Bordat ( Twitter @Ji_Bay_ )
 * Since 2K10 until today
 * @mail <bordat.jean@gmail.com>
 *
 * hex: 53 70 69 72 69 74 2d 44 65 76
 */

namespace SonarQube\HttpClient;

/**
 * Interface HttpClientInterface
 * @package SonarQube\HttpClient
 */
interface HttpClientInterface {

    /**
     * @param $path
     * @param array $parameters
     * @param array $headers
     * @return mixed
     */
    public function get($path, array $parameters = array(), array $headers = array());

    /**
     * @param $path
     * @param array $parameters
     * @param array $headers
     * @return mixed
     */
    public function post($path, array $parameters = array(), array $headers = array());

    /**
     * @param $path
     * @param array $parameters
     * @param array $headers
     * @return mixed
     */
    public function patch($path, array $parameters = array(), array $headers = array());

    /**
     * @param $path
     * @param array $parameters
     * @param array $headers
     * @return mixed
     */
    public function put($path, array $parameters = array(), array $headers = array());

    /**
     * @param $path
     * @param array $parameters
     * @param array $headers
     * @return mixed
     */
    public function delete($path, array $parameters = array(), array $headers = array());

    /**
     * @param $path
     * @param array $parameters
     * @param string $httpMethod
     * @param array $headers
     * @return mixed
     */
    public function request($path, array $parameters = array(), $httpMethod = 'GET', array $headers = array());

    /**
     * @param $name
     * @param $value
     * @return mixed
     */
    public function setOption($name, $value);

    /**
     * @param array $headers
     * @return mixed
     */
    public function setHeaders(array $headers);
}
