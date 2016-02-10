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

namespace SonarQube\HttpClient\Listener;

use Buzz\Listener\ListenerInterface;
use Buzz\Message\MessageInterface;
use Buzz\Message\RequestInterface;
use Buzz\Util\Url;
use SonarQube\Client;

/**
 * Class AuthListener
 * @package SonarQube\HttpClient\Listener
 */
class AuthListener implements ListenerInterface {

    /**
     * @var
     */
    private $method;

    /**
     * @var
     */
    private $username;

    /**
     * @var
     */
    private $password;

    /**
     * AuthListener constructor.
     * @param $method
     * @param $username
     * @param $password
     */
    public function __construct($method, $username, $password) {
        $this->method = $method;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @param RequestInterface $request
     */
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

    /**
     * @param RequestInterface $request
     * @param MessageInterface $response
     */
    public function postSend(RequestInterface $request, MessageInterface $response) {
    }
}
