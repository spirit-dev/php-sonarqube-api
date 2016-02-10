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

namespace SonarQube;

use Buzz\Client\ClientInterface;
use Buzz\Client\Curl;
use SonarQube\Exception\InvalidArgumentException;
use SonarQube\HttpClient\HttpClient;
use SonarQube\HttpClient\HttpClientInterface;
use SonarQube\HttpClient\Listener\AuthListener;

class Client {

    // TODO Comment

    const AUTH_BASIC_TOKEN = 'basic_token';

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
        $this->username = $username;
        $this->password = $password;
        $this->httpClient = new HttpClient($this->baseUrl, $this->options, $httpClient);
        $this->authenticate();
    }

    private function authenticate($authMethod = self::AUTH_BASIC_TOKEN) {
        $this->httpClient->addListener(new AuthListener($authMethod, $this->username, $this->password));
        return $this;
    }

    public function getHttpClient() {
        return $this->httpClient;
    }

    public function setHttpClient(HttpClientInterface $httpClient) {
        $this->httpClient = $httpClient;

        return $this;
    }

    public function getBaseUrl() {
        return $this->baseUrl;
    }

    public function setBaseUrl($url) {
        $this->baseUrl = $url;

        return $this;
    }

    public function clearHeaders() {
        $this->httpClient->clearHeaders();

        return $this;
    }

    public function setHeaders(array $headers) {
        $this->httpClient->setHeaders($headers);

        return $this;
    }

    public function getOption($name) {
        if (!array_key_exists($name, $this->options)) {
            throw new InvalidArgumentException(sprintf('Undefined option called: "%s"', $name));
        }

        return $this->options[$name];
    }

    public function setOption($name, $value) {
        if (!array_key_exists($name, $this->options)) {
            throw new InvalidArgumentException(sprintf('Undefined option called: "%s"', $name));
        }

        $this->options[$name] = $value;

        return $this;
    }

    public function __get($api) {
        return $this->api($api);
    }

    public function api($name) {

        switch ($name) {

            case 'action_plans':
                break;
            case 'authentication':
                $api = new Api\Authentication($this);
                break;
            case 'coverage':
                break;
            case 'duplications':
                break;
            case 'events':
                break;
            case 'favorites':
                break;
            case 'issue_filters':
                break;
            case 'issues':
                break;
            case 'languages':
                break;
            case 'manual_measures':
                break;
            case 'metrics':
                break;
            case 'permissions':
                break;
            case 'profiles':
                break;
            case 'projects':
                break;
            case 'properties':
                break;
            case 'qualitygates':
                break;
            case 'qualityprofiles':
                break;
            case 'resources':
                break;
            case 'rules':
                break;
            case 'server':
                break;
            case 'sources':
                break;
            case 'system':
                break;
            case 'tests':
                break;
            case 'timemachine':
                break;
            case 'updatecenter':
                break;
            case 'user_properties':
                break;
            case 'users':
                break;
            case 'webservices':
                break;

            default:
                throw new \InvalidArgumentException('Invalid endpoint: "' . $name . '".');
        }

        return $api;

    }
}