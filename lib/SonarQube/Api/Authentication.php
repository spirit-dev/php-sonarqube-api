<?php

namespace SonarQube\Api;

class Authentication extends AbstractApi {

    // TODO Comment

    public function validate() {
        return $this->get('authentication/validate');
    }

}