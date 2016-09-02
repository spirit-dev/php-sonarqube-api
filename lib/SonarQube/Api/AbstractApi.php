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

namespace SonarQube\Api;

use SonarQube\Client;
use SonarQube\Exception\MissingArgumentException;

abstract class AbstractApi {

    // TODO Comment

    const PER_PAGE = 20;

    protected $client;

    public function __construct(Client $client) {
        $this->client = $client;
    }

    public function configure() {
        return $this;
    }

    protected function get($path, array $parameters = array(), $requestHeaders = array()) {
        $response = $this->client->getHttpClient()->get($path, $parameters, $requestHeaders);

        return $response->getContent();
    }

    protected function post($path, array $parameters = array(), $requestHeaders = array()) {
        $response = $this->client->getHttpClient()->post($path, $parameters, $requestHeaders);

        return $response->getContent();
    }

    protected function patch($path, array $parameters = array(), $requestHeaders = array()) {
        $response = $this->client->getHttpClient()->patch($path, $parameters, $requestHeaders);

        return $response->getContent();
    }

    protected function put($path, array $parameters = array(), $requestHeaders = array()) {
        $response = $this->client->getHttpClient()->put($path, $parameters, $requestHeaders);

        return $response->getContent();
    }

    protected function delete($path, array $parameters = array(), $requestHeaders = array()) {
        $response = $this->client->getHttpClient()->delete($path, $parameters, $requestHeaders);

        return $response->getContent();
    }

    protected function encodePath($path) {
        $path = rawurlencode($path);

        return str_replace('.', '%2E', $path);
    }

    protected function checkParamIsSet($params, array $necessary) {
        for ($i = 0; $i < count($necessary); $i++) {
            if (!array_key_exists($necessary[$i], $params)) {
                throw new MissingArgumentException($necessary[$i]);
            }
        }
    }
}