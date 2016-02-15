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
 * Interface ServerInterface
 * @package SonarQube\Api\Interfaces
 */
interface ServerInterface {

    /**
     * Get the server status
     * Type GET
     *
     * @return mixed
     */
    public function status();

    /**
     * Upgrade the SonarQube database
     * Type POST
     *
     * @return mixed
     */
    public function upgrade();

}