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

namespace SonarQube\Api\Interfaces;

/**
 * Interface ProjectsInterface
 * @package SonarQube\Api\Interfaces
 */
interface ProjectsInterface {

    /**
     * Search for projects
     * Type GET
     * Parameters
     *      Optional
     *          - desc          Load project description - Possible values: true false
     *          - key           id or key of the project
     *          - libs          Load libraries. Ignored if the parameter key is set - Possible values: true false
     *          - search        Substring of project name, case insensitive
     *          - subprojects   Load sub-projects. Ignored if the parameter key is set - Possible values: true false
     *          - versions      Load version - Possible values: true false
     *          - views         Load views and sub-views. Ignored if the parameter key is set - Possible values: true false
     *
     * @param array $parameters
     * @return mixed
     */
    public function search(array $parameters = array());

    /**
     * Provision a project. Requires Provision Projects permission
     * Type POST
     * Parameters
     *      Optional
     *          - branch        SCM Branch of the project. The key of the project will become key:branch, for instance 'SonarQube:branch-5.0'
     *      Required
     *          - key           Key of the project
     *          - name          Name of the project
     *
     * @param array $parameters
     * @return mixed
     */
    public function create(array $parameters = array());

    /**
     * Delete a project. Requires Administer System permission
     * Type POST
     * Parameters
     *      Required
     *          - id          id or key of the resource (ie: component)
     *
     * @param array $parameters
     * @return mixed
     */
    public function deleteProject(array $parameters = array());

}