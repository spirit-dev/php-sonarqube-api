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
 * Interface IssueInterface
 * @package SonarQube\Api\Interfaces
 */
interface IssuesInterface {

    /**
     * Detail of issue
     * Type GET
     * Parameters
     *      Required
     *          - key         Key of the issue
     *
     * @return mixed
     */
    public function detail();

    /**
     * Get a list of issues. If the number of issues is greater than 10,000, only the first 10,000 ones are returned by the web service. Requires Browse permission on project(s)
     * Type GET
     * Parameters
     *      Optional
     *           - actionPlans         Comma-separated list of action plan keys (not names)
     *           - asc                 Ascending sort - Possible values: true false yes no - Default value: true
     *           - assigned            To retrieve assigned or unassigned issues - Possible values: true false yes no
     *           - assignees           Comma-separated list of assignee logins
     *           - authors             Comma-separated list of SCM accounts
     *           - componentKeys       To retrieve issues associated to a specific list of components sub-components (comma-separated list of component keys). A component can be a view, developer, project, module, directory or file. If this parameter is set, componentUuids must not be set.
     *           - componentRootUuids  Deprecated since 5.1. If used, will have the same meaning as componentUuids AND onComponentOnly=false.
     *           - componentRoots      Deprecated since 5.1. If used, will have the same meaning as componentKeys AND onComponentOnly=false.
     *           - componentUuids      To retrieve issues associated to a specific list of components their sub-components (comma-separated list of component UUIDs). This parameter is mostly used by the Issues page, please prefer usage of the componentKeys parameter. A component can be a project, module, directory or file. If this parameter is set, componentKeys must not be set.
     *           - components          Deprecated since 5.1. If used, will have the same meaning as componentKeys AND onComponentOnly=true.
     *           - createdAfter        To retrieve issues created after the given date (exclusive). Format: date or datetime ISO formats
     *           - createdAt           To retrieve issues created at a given date. Format: date or datetime ISO formats
     *           - createdBefore       To retrieve issues created before the given date (exclusive). Format: date or datetime ISO formats
     *           - directories         Since 5.1. To retrieve issues associated to a specific list of directories (comma-separated list of directory paths). This parameter is only meaningful when a module is selected. This parameter is mostly used by the Issues page, please prefer usage of the componentKeys parameter.
     *           - extra_fields        Add some extra fields on each issue. Available since 4.4 - Possible values: actions transitions assigneeName reporterName actionPlanName
     *           - facets              Comma-separated list of the facets to be computed. No facet is computed by default. - Possible values: severities statuses resolutions actionPlans projectUuids rules assignees reporters authors moduleUuids fileUuids directories languages tags createdAt
     *           - fileUuids           To retrieve issues associated to a specific list of files (comma-separated list of file UUIDs). This parameter is mostly used by the Issues page, please prefer usage of the componentKeys parameter.
     *           - format              Only json format is available. This parameter is kept only for backward compatibility and shouldn't be used anymore
     *           - hideComments        To not return comments - Possible values: true false yes no - Default value: false
     *           - hideRules           To not return rules - Possible values: true false yes no - Default value: false
     *           - ignorePaging        Return the full list of issues, regardless of paging. For internal use only - Possible values: true false yes no - Default value: false
     *           - issues              Comma-separated list of issue keys
     *           - languages           Comma-separated list of languages. Available since 4.4
     *           - moduleUuids         To retrieve issues associated to a specific list of modules (comma-separated list of module UUIDs). This parameter is mostly used by the Issues page, please prefer usage of the componentKeys parameter. Views are not supported. If this parameter is set, moduleKeys must not be set.
     *           - onComponentOnly     Return only issues at a component's level, not on its descendants (modules, directories, files, etc). This parameter is only considered when componentKeys or componentUuids is set. Using the deprecated componentRoots or componentRootUuids parameters will set this parameter to false. Using the deprecated components parameter will set this parameter to true. - Possible values: true false yes no - Default value: false
     *           - p                   1-based page number - Default value: 1
     *           - planned             To retrieve issues associated to an action plan or not - Possible values: true false yes no
     *           - projectKeys         To retrieve issues associated to a specific list of projects (comma-separated list of project keys). This parameter is mostly used by the Issues page, please prefer usage of the componentKeys parameter. If this parameter is set, projectUuids must not be set.
     *           - projectUuids        To retrieve issues associated to a specific list of projects (comma-separated list of project UUIDs). This parameter is mostly used by the Issues page, please prefer usage of the componentKeys parameter. Views are not supported. If this parameter is set, projectKeys must not be set.
     *           - projects            Deprecated since 5.1. See projectKeys
     *           - ps                  Page size. Must be greater than 0. - Default value: 100
     *           - reporters           Comma-separated list of reporter logins
     *           - resolutions         Comma-separated list of resolutions - Possible values: FALSE-POSITIVE WONTFIX FIXED REMOVED
     *           - resolved            To match resolved or unresolved issues - Possible values: true false yes no
     *           - rules               Comma-separated list of coding rule keys
     *           - s                   Sort field - Possible values: CREATION_DATE UPDATE_DATE CLOSE_DATE ASSIGNEE SEVERITY STATUS FILE_LINE
     *           - severities          Comma-separated list of severities - Possible values: INFO MINOR MAJOR CRITICAL BLOCKER
     *           - statuses            Comma-separated list of statuses - Possible values: OPEN CONFIRMED REOPENED RESOLVED CLOSED
     *           - tags                Comma-separated list of tags.
     *
     * @return mixed
     */
    public function show();

    /**
     * Assign/Unassign an issue. Requires authentication and Browse permission on project
     * Type POST
     * Parameters
     *      Optional
     *          - assignee      Login of the assignee
     *      Required
     *          - issue         Key of the issue
     *
     * @return mixed
     */
    public function assignUnassign();

    /**
     * Add a comment. Requires authentication and Browse permission on project
     * Type POST
     * Parameters
     *      Optional
     *          - text          Comment
     *      Required
     *          - issue         Key of the issue
     *
     * @return mixed
     */
    public function addComment();

    /**
     * Delete a comment. Requires authentication and Browse permission on project
     * Type POST
     * Parameters
     *      Required
     *          - key           Key of the comment
     *
     * @return mixed
     */
    public function deleteComment();

    /**
     * Edit a comment. Requires authentication and User role on project
     * Type POST
     * Parameters
     *      Optional
     *          - text          Comment
     *      Required
     *          - issue         Key of the issue
     *
     * @return mixed
     */
    public function editComment();

    /**
     * Change severity. Requires authentication and Browse permission on project
     * Type POST
     * Parameters
     *      Optional
     *          - severity      New severity - Possible values: INFO MINOR MAJOR CRITICAL BLOCKER
     *      Required
     *          - issue         Key of the issue
     *
     * @return mixed
     */
    public function changeSeverity();

    /**
     * Plan/Unplan an issue. Requires authentication and Browse permission on project
     * Type POST
     * Parameters
     *      Optional
     *          - plan      Key of the action plan
     *      Required
     *          - issue     Key of the issue
     *
     * @return mixed
     */
    public function planUnplan();

    /**
     * Do workflow transition on an issue
     * Type POST
     * Parameters
     *      Optional
     *          - transition    Transition - Possible values: confirm unconfirm reopen resolve falsepositive wontfix close
     *      Required
     *          - issue         Key of the issue
     *
     * @return mixed
     */
    public function workflowTransition();

    /**
     * Get Possible Workflow Transitions for an Issue. Requires Browse permission on project
     * Type GET
     * Parameters
     *      Required
     *          - issue     Key of the issue
     *
     * @return mixed
     */
    public function possibleWorkflowTransition();

    /**
     * Create a manual issue. Requires authentication and Browse permission on project
     * Type POST
     * Parameters
     *      Optional
     *          - line          Line on which to log the issue. If no line is specified, the issue is attached to the component and not to a specific line
     *          - message       Description of the issue
     *          - rule          Manual rule key
     *          - severity      Severity of the issue - Possible values: INFO MINOR MAJOR CRITICAL BLOCKER
     *      Required
     *          - component     Key of the component on which to log the issue
     *
     * @return mixed
     */
    public function create();

    /**
     * Bulk change on issues. Requires authentication and User role on project(s)
     * Type POST
     * Parameters
     *      Optional
     *          - assign.assignee           Description
     *          - comment                   To add a comment to a list of issues
     *          - do_transition.transition  Transition - Possible values: confirm unconfirm reopen resolve falsepositive wontfix close
     *          - plan.plan                 To plan the list of issues to a specific action plan (key), or unlink all the issues from an action plan
     *          - sendNotifications         Available since version 4.0 - Possible values: true false
     *          - set_severity.severity     To change the severity of the list of issues - Possible values: INFO MINOR MAJOR CRITICAL BLOCKER
     *      Required
     *          - actions                   Comma-separated list of actions to perform. Possible values: assign | set_severity | plan | do_transition
     *          - issues
     *
     * @return mixed
     */
    public function bulkChanges();

}