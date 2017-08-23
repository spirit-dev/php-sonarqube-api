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
use SonarQube\Exception\ErrorException;
use SonarQube\Exception\RuntimeException;

/**
 * Class ErrorListener
 * @package SonarQube\HttpClient\Listener
 */
class ErrorListener implements ListenerInterface {

    /**
     * @var array
     */
    private $options;

    /**
     * ErrorListener constructor.
     * @param array $options
     */
    public function __construct(array $options) {
        $this->options = $options;
    }

    /**
     * @param RequestInterface $request
     */
    public function preSend(RequestInterface $request) {
    }

    /**
     * @param RequestInterface $request
     * @param MessageInterface $response
     * @throws ErrorException
     */
    public function postSend(RequestInterface $request, MessageInterface $response) {
        if ($response->isClientError() || $response->isServerError()) {
            $content = $response->getContent();
            if (is_array($content) && isset($content['message'])) {
                if (400 == $response->getStatusCode()) {
                    $message = $this->parseMessage($content['message']);

                    throw new ErrorException($message, 400);
                }
            }

            $errorMessage = null;
            if (isset($content['error'])) {
                $errorMessage = implode("\n", $content['error']);
            } elseif (isset($content['errors'])) {
                $errorMessage = $this->parseMessage($content['errors']);
            } elseif (isset($content['message'])) {
                $errorMessage = $this->parseMessage($content['message']);
            } else {
                $errorMessage = $content;
            }

            throw new RuntimeException($errorMessage, $response->getStatusCode());
        }
    }

    /**
     * @param $message
     * @return string
     */
    protected function parseMessage($message) {
        $string = $message;

        if (is_array($message)) {
            $format = '"%s" %s';
            $errors = array();

            foreach ($message as $field => $messages) {
                if (is_array($messages)) {
                    $messages = array_unique($messages);
                    foreach ($messages as $error) {
                        $errors[] = sprintf($format, $field, $error);
                    }
                } elseif (is_integer($field)) {
                    $errors[] = $messages;
                } else {
                    $errors[] = sprintf($format, $field, $messages);
                }
            }

            $string = implode(', ', $errors);
        }

        return $string;
    }
}
