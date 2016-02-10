<?php

namespace SonarQube\HttpClient\Listener;

use Buzz\Listener\ListenerInterface;
use Buzz\Message\MessageInterface;
use Buzz\Message\RequestInterface;
use SonarQube\Exception\ErrorException;
use SonarQube\Exception\RuntimeException;

class ErrorListener implements ListenerInterface {

    // TODO Comment

    private $options;

    public function __construct(array $options) {
        $this->options = $options;
    }

    public function preSend(RequestInterface $request) {
    }

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
            } elseif (isset($content['message'])) {
                $errorMessage = $this->parseMessage($content['message']);
            } else {
                $errorMessage = $content;
            }

            throw new RuntimeException($errorMessage, $response->getStatusCode());
        }
    }

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
