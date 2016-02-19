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
 * Interface UsersInterface
 * @package SonarQube\Api\Interfaces
 */
interface UsersInterface {

    /**
     * Create a user. Requires Administer System permission
     * Type POST
     * Parameters
     *      Optional
     *          - email                 User email
     *          - scm_account           SCM accounts. This parameter has been added in 5.1
     *      Required
     *          - login                 User login
     *          - name                  User name
     *          - password              User password
     *          - password_confirmation Must be the same value as "password"
     *
     * @param array $parameters
     * @return mixed
     */
    public function create(array $parameters);

    /**
     * Deactivate a user. Requires Administer System permission
     * Type POST
     * Parameters
     *      Required
     *          - login                 User login
     *
     * @param $login
     * @return mixed
     */
    public function deactivate($login);

    /**
     * Get a list of users
     * Type GET
     * Parameters
     *      Optional
     *          - includeDeactivated    Include deactivated users
     *          - logins                Comma-separated list of user logins
     *
     * @param array $logins
     * @param bool $includeDeactivated
     * @return mixed
     */
    public function search(array $logins, $includeDeactivated = false);

    /**
     * Update a user. Requires Administer System permission
     * Type POST
     * Parameters
     *      Optional
     *          - email                 User email
     *          - scm_account           SCM accounts. This parameter has been added in 5.1
     *      Required
     *          - login                 User login
     *          - name                  User name
     *          - password              User password
     *          - password_confirmation Must be the same value as "password"
     *
     * @param array $parameters
     * @return mixed
     */
    public function update(array $parameters);

}