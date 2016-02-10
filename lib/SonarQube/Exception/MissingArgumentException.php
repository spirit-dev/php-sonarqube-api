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

namespace SonarQube\Exception;

/**
 * Class MissingArgumentException
 * @package SonarQube\Exception
 */
class MissingArgumentException extends ErrorException {

    /**
     * MissingArgumentException constructor.
     * @param string $required
     * @param int $code
     * @param null $previous
     */
    public function __construct($required, $code = 0, $previous = null) {
        if (is_string($required)) {
            $required = array($required);
        }

        parent::__construct(sprintf('One or more of required ("%s") parameters is missing!', implode('", "', $required)), $code, $previous);
    }
}
