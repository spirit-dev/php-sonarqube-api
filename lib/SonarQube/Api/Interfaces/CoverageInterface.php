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
     * Get code coverage. Require Browse permission on file's project
     * Type GET
     * Parameters
     *      Optional
     *          - from      First line to return. Starts at 1
     *          - to        Last line to return (inclusive)
     *          - type      Type of coverage info to return (UT, IT, OVERALL, Default value: UT)
     *      Required
     *          - key       File key  Example value: my_project:/src/foo/Bar.php
     *
     * @return mixed
     */
    public function show();

}