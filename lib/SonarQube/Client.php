<?php

namespace SonarQube;

use Buzz\Client\ClientInterface;
use Buzz\Client\Curl;
use Buzz\Listener\BasicAuthListener;

class Client {

    private $options = array(
        'user-agent' => 'php-sonarqube-api (http://github.com/spirit-dev/php-sonarqube-api)',
        'timeout' => 60
    );

    private $baseUrl;
    private $username;
    private $password;

    private $httpClient;

    public function __construct($baseUrl, $username, $password, ClientInterface $httpClient = null) {

        $httpClient = $httpClient ?: new Curl();
        $httpClient->setTimeout($this->options['timeout']);
        $httpClient->setVerifyPeer(false);

        $this->baseUrl = $baseUrl;
        $this->httpClient = new HttpClient($this->baseUrl, $this->options, $httpClient);
        $this->authenticate();
    }

    private function authenticate() {
        $this->httpClient->addListener(new BasicAuthListener($this->username, $this->password));
        return $this;
    }

}