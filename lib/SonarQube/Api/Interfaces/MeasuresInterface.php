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
interface MeasuresInterface {

    /**
     * Return component with specified measures. The componentId or the componentKey parameter must be provided.
     * Type POST
     * Parameters
     *      Optional
     *          - additionalFields      Comma-separated list of additional fields that can be returned in the response.
     *          - componentId
     *          - componentKey
     *          - developerId           Developer id. If set, developer's measures are returned.
     *          - developerKey          Developer key. If set, developer's measures are returned.
     *      Required
     *          - metricKeys
     *
     * @param array $parameters
     * @return mixed
     */
    public function component(array $parameters);

    /**
     * Deactivate a user. Requires Administer System permission
     * Type POST
     * Parameters
     *      Optional
     *          - additionalFields      Comma-separated list of additional fields that can be returned in the response.
     *          - asc                   Ascending sort. Default true.
     *          - baseComponentId
     *          - baseComponentKey
     *          - developerId           Developer id. If set, developer's measures are returned.
     *          - developerKey          Developer key. If set, developer's measures are returned.
     *          - metricPeriodSort      Measure period to sort by. The 's' param must contain the 'metricPeriod' value.
     *          - metricSort            Metric key to sort by. The 's' param must contain 'metric' or 'metricPeriod'.
     *          - metricSortFilter      Filter components. Sort must be on a metric.
     *          - p                     1-based page number
     *          - ps                    Page size. Must be greater than 0 and less than 500
     *          - q                     Limit search to component names/keys containing/equal to the supplied string.
     *          - qualifiers            Comma-separated list of component qualifiers.
     *          - s                     Comma-separated list of sort fields.
     *          - strategy              Strategy to search for base component descendants. Values: all, children, leaves
     *      Required
     *          - metricKeys
     *
     * @param array $parameters
     * @return mixed
     */
    public function componentTree(array $parameters);
}