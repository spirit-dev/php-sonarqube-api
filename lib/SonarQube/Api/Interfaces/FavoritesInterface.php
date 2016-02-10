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
interface CoverageInterface {

    /**
     * Get the logged in user's list of favorites
     * Type GET
     *
     * @return mixed
     */
    public function show();

    /**
     * Create a favorite
     * Type POST
     * Parameters
     *      Required
     *          - id            id or key of the component
     *
     * @return mixed
     */
    public function create();

    /**
     * Delete a favorite
     * Type DELETE
     * Parameters
     *      Required
     *          - id            id or key of the component
     *
     * @return mixed
     */
    public function delete();

}