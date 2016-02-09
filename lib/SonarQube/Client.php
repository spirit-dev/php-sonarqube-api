<?php

namespace SonarQube;

use Buzz\Client\Curl;
use Buzz\Client\ClientInterface;

class Client {

    private $options = array(
        'user-agent' => 'php-sonarqube-api (http://github.com/spirit-dev/php-sonarqube-api)',
        'timeout' => 60
    );

    private $baseUrl;

    private $httpClient;

    public function __construct($baseUrl, ClientInterface $httpClient = null) {

        $httpClient = $httpClient ?: new Curl();
        $httpClient->setTimeout($this->options['timeout']);
        $httpClient->verifyPeer(false);

        $this->baseUrl = $baseUrl;
        $this->httpClient = new HttpClient($this->baseUrl, $this->options, $httpClient);

    }

}