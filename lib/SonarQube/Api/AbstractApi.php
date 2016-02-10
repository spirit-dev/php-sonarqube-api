<?php

namespace SonarQube\Api;

use SonarQube\Client;

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
}