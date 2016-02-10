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
 * Interface EventsInterface
 * @package SonarQube\Api\Interfaces
 */
interface EventsInterface {

    /**
     * Get a list of events from a project
     * Type GET
     * Parameters
     *      Optional
     *          - categories        Comma-separated list of category filters (case-sensitive)
     *          - fromDateTime      ISO-8601 datetime (inclusive)
     *          - toDateTime        ISO-8601 datetime (inclusive)
     *          - fromDate          Date (inclusive)
     *          - toDate            Date (inclusive)
     *      Required
     *          - resource          id or key of the project
     *
     * @return mixed
     */
    public function show();

    /**
     * Create an event on a project
     * Type POST
     * Parameters
     *      Optional
     *          - description       Description of the event
     *          - dateTime          ISO-8601 datetime (inclusive)
     *      Required
     *          - resource          id or key of the project
     *          - name              Name of the event
     *          - category          Category
     *
     * @return mixed
     */
    public function create();


    /**
     * Delete an event
     * Type DELETE
     * Parameters
     *      Required
     *          - id              id of the event
     *
     * @return mixed
     */
    public function delete();

}