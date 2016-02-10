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

use Buzz\Client\ClientInterface;
use Buzz\Listener\ListenerInterface;
use SonarQube\Exception\ErrorException;
use SonarQube\Exception\RuntimeException;
use SonarQube\HttpClient\Listener\ErrorListener;
use SonarQube\HttpClient\Message\Request;
use SonarQube\HttpClient\Message\Response;

/**
 * Class HttpClient
 * @package SonarQube\HttpClient
 */
class HttpClient implements HttpClientInterface {

    /**
     * @var array
     */
    protected $options = array(
        'user_agent' => 'php-sonarqube-api (http://github.com/spirit-dev/php-sonarqube-api)',
        'timeout' => 10,
    );

    /**
     * @var
     */
    protected $baseUrl;

    /**
     * @var array
     */
    protected $listeners = array();

    /**
     * @var array
     */
    protected $headers = array();

    /**
     * @var
     */
    private $lastResponse;

    /**
     * @var
     */
    private $lastRequest;

    /**
     * HttpClient constructor.
     * @param $baseUrl
     * @param array $options
     * @param ClientInterface $client
     */
    public function __construct($baseUrl, array $options, ClientInterface $client) {
        $this->baseUrl = $baseUrl;
        $this->options = array_merge($this->options, $options);
        $this->client = $client;

        $this->addListener(new ErrorListener($this->options));

        $this->clearHeaders();
    }

    /**
     * @param ListenerInterface $listener
     */
    public function addListener(ListenerInterface $listener) {
        $this->listeners[get_class($listener)] = $listener;
    }

    /**
     *
     */
    public function clearHeaders() {
        $this->headers = array();
    }

    /**
     * @param $name
     * @param $value
     */
    public function setOption($name, $value) {
        $this->options[$name] = $value;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers) {
        $this->headers = array_merge($this->headers, $headers);
    }

    /**
     * @param $path
     * @param array $parameters
     * @param array $headers
     * @return Response
     * @throws ErrorException
     */
    public function get($path, array $parameters = array(), array $headers = array()) {
        if (0 < count($parameters)) {
            $path .= (false === strpos($path, '?') ? '?' : '&') . http_build_query($parameters, '', '&');
        }

        return $this->request($path, array(), 'GET', $headers);
    }

    /**
     * @param $path
     * @param array $parameters
     * @param string $httpMethod
     * @param array $headers
     * @return Response
     * @throws ErrorException
     */
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

        $this->client->send($request, $response);
        try {
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

    /**
     * @param $httpMethod
     * @param $url
     * @return Request
     */
    private function createRequest($httpMethod, $url) {
        $request = new Request($httpMethod);
        $request->setHeaders($this->headers);
        $request->fromUrl($url);

        return $request;
    }

    /**
     * @param $path
     * @param array $parameters
     * @param array $headers
     * @return Response
     * @throws ErrorException
     */
    public function post($path, array $parameters = array(), array $headers = array()) {
        return $this->request($path, $parameters, 'POST', $headers);
    }

    /**
     * @param $path
     * @param array $parameters
     * @param array $headers
     * @return Response
     * @throws ErrorException
     */
    public function patch($path, array $parameters = array(), array $headers = array()) {
        return $this->request($path, $parameters, 'PATCH', $headers);
    }

    /**
     * @param $path
     * @param array $parameters
     * @param array $headers
     * @return Response
     * @throws ErrorException
     */
    public function delete($path, array $parameters = array(), array $headers = array()) {
        return $this->request($path, $parameters, 'DELETE', $headers);
    }

    /**
     * @param $path
     * @param array $parameters
     * @param array $headers
     * @return Response
     * @throws ErrorException
     */
    public function put($path, array $parameters = array(), array $headers = array()) {
        return $this->request($path, $parameters, 'PUT', $headers);
    }

    /**
     * @return mixed
     */
    public function getLastRequest() {
        return $this->lastRequest;
    }

    /**
     * @return mixed
     */
    public function getLastResponse() {
        return $this->lastResponse;
    }
}
