<?php

namespace SonarQube\Api;

use SonarQube\Api\Interfaces\AuthenticationInterface;

/**
 * Class Authentication
 * @package SonarQube\Api
 */
class Authentication extends AbstractApi implements AuthenticationInterface {

    /**
     * @inheritDoc
     */
    public function validate() {
        return $this->get('authentication/validate');
    }


}