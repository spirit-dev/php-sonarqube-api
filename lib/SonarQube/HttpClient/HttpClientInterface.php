<?php

namespace SonarQube\HttpClient;

interface HttpClientInterface {

    // TODO Comment

    public function get($path, array $parameters = array(), array $headers = array());

    public function post($path, array $parameters = array(), array $headers = array());

    public function patch($path, array $parameters = array(), array $headers = array());

    public function put($path, array $parameters = array(), array $headers = array());

    public function delete($path, array $parameters = array(), array $headers = array());

    public function request($path, array $parameters = array(), $httpMethod = 'GET', array $headers = array());

    public function setOption($name, $value);

    public function setHeaders(array $headers);
}
