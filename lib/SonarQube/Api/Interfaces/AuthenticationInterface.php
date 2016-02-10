<?php

namespace SonarQube\Api\Interfaces;

/**
 * Interface AuthenticationInterface
 * @package SonarQube\Api\Interfaces
 */
interface AuthenticationInterface {

    /**
     * Check credentials
     * Type GET
     *
     * @return mixed
     */
    public function validate();

}