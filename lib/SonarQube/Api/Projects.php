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

namespace SonarQube\Api;

use SonarQube\Api\Interfaces\ProjectsInterface;

/**
 * Class Authentication
 * @package SonarQube\Api
 */
class Projects extends AbstractApi implements ProjectsInterface {

    /**
     * @inheritDoc
     */
    public function search(array $parameters = array()) {
        return $this->get('projects/index', $parameters);
    }

    /**
     * @inheritDoc
     */
    public function create(array $parameters = array()) {
        $this->checkParamIsSet($parameters, array("key", "name"));
        return $this->post('projects/create', $parameters);
    }

    /**
     * @inheritDoc
     */
    public function deleteProject(array $parameters = array()) {
        $this->checkParamIsSet($parameters, array("key"));
        return $this->post('projects/delete', $parameters);
    }

}