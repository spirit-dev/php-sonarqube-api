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
 * Interface CoverageInterface
 * @package SonarQube\Api\Interfaces
 */
interface PermissionsInterface {

    /**
     * Add a global or a project permission.
     * Type POST
     * Parameters
     *      Optional
     *          - component     Key of the project. Required if a project permission is set
     *          - group         Group name or "Anyone". Required if user is not set
     *          - user          User login. Required if group is not set
     *      Required
     *          permission      Key of the permission to add. Possible values: admin profileadmin shareDashboard scan dryRunScan provisioning user issueadmin codeviewer
     *
     * @param array $parameters
     * @return mixed
     */
    public function add(array $parameters);

    /**
     * Remove a global or a project permission.
     * Type POST
     * Parameters
     *      Optional
     *          - component     Key of the project. Required if a project permission is set
     *          - group         Group name or "Anyone". Required if user is not set
     *          - user          User login. Required if group is not set
     *      Required
     *          permission      Key of the permission to add. Possible values: admin profileadmin shareDashboard scan dryRunScan provisioning user issueadmin codeviewer
     *
     * @param array $parameters
     * @return mixed
     */
    public function remove(array $parameters);

}