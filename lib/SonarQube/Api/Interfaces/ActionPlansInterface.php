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

interface ActionPlansInterface {

    /**
     * Close an action plan. Requires Administer permission on project
     * Type POST
     * Parameters
     *      Required
     *          - key           Key of the action plan
     *
     * @return mixed
     */
    public function close();

    /**
     * Create an action plan. Requires Administer permission on project
     * Type POST
     * Parameters
     *      Optional
     *          - deadline      Due date of the action plan. Format: YYYY-MM-DD
     *          - description   Description of the action plan
     *      Required
     *          - name          Name of the action plan
     *          - project       Project key
     *
     * @return mixed
     */
    public function create();

    /**
     * Delete an action plan. Requires Administer permission on project
     * Type POST
     * Parameters
     *      Required
     *          - key           Key of the action plan
     *
     * @return mixed
     */
    public function delete();

    /**
     * Open an action plan. Requires Administer permission on project
     * Type POST
     *      Required
     *          - key           Key of the action plan
     *
     * @return mixed
     */
    public function open();

    /**
     * Get a list of action plans. Requires Browse permission on project
     * Type GET
     * Parameters
     *      Optional
     *          - deadline      Due date of the action plan. Format: YYYY-MM-DD
     *          - description   Description of the action plan
     *      Required
     *          - key           Key of the action plan
     *              - name          Name of the action plan
     *
     * @return mixed
     */
    public function search();

    /**
     * Update an action plan. Requires Administer permission on project
     * Type POST
     * Parameters
     *      Required
     *          - key           Key of the action plan
     *
     * @return mixed
     */
    public function update();
}