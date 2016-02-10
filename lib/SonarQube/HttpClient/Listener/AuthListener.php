<?php

namespace SonarQube\HttpClient\Listener;

use Buzz\Listener\ListenerInterface;
use Buzz\Message\MessageInterface;
use Buzz\Message\RequestInterface;
use Buzz\Util\Url;
use SonarQube\Client;

class AuthListener implements ListenerInterface {

    // TODO Comment

    private $method;

    private $username;

    private $password;

    public function __construct($method, $username, $password) {
        $this->method = $method;
        $this->username = $username;
        $this->password = $password;
    }

    public function preSend(RequestInterface $request) {
        // Skip by default
        if (null === $this->method) {
            return;
        }

        switch ($this->method) {
            case Client::AUTH_BASIC_TOKEN:

                $request->addHeader('Authorization: Basic ' . base64_encode($this->username . ':' . $this->password));

                break;
        }
    }

    public function postSend(RequestInterface $request, MessageInterface $response) {
    }
}
