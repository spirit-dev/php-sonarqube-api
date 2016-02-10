<?php

namespace SonarQube\HttpClient;

use Buzz\Client\ClientInterface;
use Buzz\Listener\ListenerInterface;
use SonarQube\Exception\ErrorException;
use SonarQube\Exception\RuntimeException;
use SonarQube\HttpClient\Listener\ErrorListener;
use SonarQube\HttpClient\Message\Request;
use SonarQube\HttpClient\Message\Response;

class HttpClient implements HttpClientInterface {

    // TODO Comment

    protected $options = array(
        'user_agent' => 'php-sonarqube-api (http://github.com/spirit-dev/php-sonarqube-api)',
        'timeout' => 10,
    );

    protected $baseUrl;

    protected $listeners = array();

    protected $headers = array();

    private $lastResponse;

    private $lastRequest;

    public function __construct($baseUrl, array $options, ClientInterface $client) {
        $this->baseUrl = $baseUrl;
        $this->options = array_merge($this->options, $options);
        $this->client = $client;

        $this->addListener(new ErrorListener($this->options));

        $this->clearHeaders();
    }

    public function addListener(ListenerInterface $listener) {
        $this->listeners[get_class($listener)] = $listener;
    }

    public function clearHeaders() {
        $this->headers = array();
    }

    public function setOption($name, $value) {
        $this->options[$name] = $value;
    }

    public function setHeaders(array $headers) {
        $this->headers = array_merge($this->headers, $headers);
    }

    public function get($path, array $parameters = array(), array $headers = array()) {
        if (0 < count($parameters)) {
            $path .= (false === strpos($path, '?') ? '?' : '&') . http_build_query($parameters, '', '&');
        }

        return $this->request($path, array(), 'GET', $headers);
    }

    public function request($path, array $parameters = array(), $httpMethod = 'GET', array $headers = array()) {
        $path = trim($this->baseUrl . $path, '/');

        $request = $this->createRequest($httpMethod, $path);
        $request->addHeaders($headers);
        $request->setContent(http_build_query($parameters));

        $hasListeners = 0 < count($this->listeners);
        if ($hasListeners) {
            foreach ($this->listeners as $listener) {
                $listener->preSend($request);
            }
        }

        $response = new Response();

        try {
            $this->client->send($request, $response);
        } catch (\LogicException $e) {
            throw new ErrorException($e->getMessage());
        } catch (\RuntimeException $e) {
            throw new RuntimeException($e->getMessage());
        }

        $this->lastRequest = $request;
        $this->lastResponse = $response;

        if ($hasListeners) {
            foreach ($this->listeners as $listener) {
                $listener->postSend($request, $response);
            }
        }

        return $response;
    }

    private function createRequest($httpMethod, $url) {
        $request = new Request($httpMethod);
        $request->setHeaders($this->headers);
        $request->fromUrl($url);

        return $request;
    }

    public function post($path, array $parameters = array(), array $headers = array()) {
        return $this->request($path, $parameters, 'POST', $headers);
    }

    public function patch($path, array $parameters = array(), array $headers = array()) {
        return $this->request($path, $parameters, 'PATCH', $headers);
    }

    public function delete($path, array $parameters = array(), array $headers = array()) {
        return $this->request($path, $parameters, 'DELETE', $headers);
    }

    public function put($path, array $parameters = array(), array $headers = array()) {
        return $this->request($path, $parameters, 'PUT', $headers);
    }

    public function getLastRequest() {
        return $this->lastRequest;
    }

    public function getLastResponse() {
        return $this->lastResponse;
    }
}
