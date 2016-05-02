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

namespace SonarQube\Api;

use SonarQube\Api\Interfaces\IssuesInterface;

/**
 * Class Authentication
 * @package SonarQube\Api
 */
class Issues extends AbstractApi implements IssuesInterface {
    /**
     * Add a comment. Requires authentication and Browse permission on project
     * Type POST
     * Parameters
     *      Optional
     *          - text                  Comment
     *      Required
     *          - issue                 Key of the issue
     *
     * @param array $parameters
     * @return mixed
     */
    public function addComment(array $parameters) {
        $this->checkParamIsSet($parameters, array("issue"));

        return $this->post('issues/add_comment', $parameters);
    }

    /**
     * Assign/Unassign an issue. Requires authentication and Browse permission on project
     * Type POST
     * Parameters
     *      Optional
     *          - assignee              Login of the assignee
     *      Required
     *          - issue                 Key of the issue
     *
     * @param array $parameters
     * @return mixed
     */
    public function assign(array  $parameters) {
        $this->checkParamIsSet($parameters, array("issue"));

        return $this->post('issues/assign', $parameters);
    }

    /**
     * Bulk change on issues. Requires authentication and User role on project(s)
     * Type POST
     * Parameters
     *      Optional
     *          - assign.assignee           To assign the list of issues to a specific user (login), or unassign all the issues
     *          - comment                   To add a comment to a list of issues
     *          - do_transition.transition  Transition
     *          - plan.plan                 To plan the list of issues to a specific action plan (key), or unlink all the issues from an action plan
     *          - sendNotifications
     *          - set_severity.severity     To change the severity of the list of issues
     *      Required
     *          - issues                    Comma-separated list of issue keys
     *
     * @param array $parameters
     * @return mixed
     */
    public function bulkChange(array $parameters) {
        $this->checkParamIsSet($parameters, array("issue"));

        return $this->post('issues/bulk_change', $parameters);
    }

    /**
     * Display changelog of an issue
     * Type GET
     * Parameters
     *      Required
     *          - issue                 Key of the issue
     *
     * @param array $parameters
     * @return mixed
     */
    public function changeLog(array $parameters) {
        $this->checkParamIsSet($parameters, array("issue"));

        return $this->post('issues/changelog', $parameters);
    }

    /**
     * Create a manual issue. Requires authentication and Browse permission on project
     * Type POST
     * Parameters
     *      Optional
     *          - line                  Line on which to log the issue. If no line is specified, the issue is attached to the component and not to a specific line
     *          - message               Description of the issue
     *          - severity              Severity of the issue
     *      Required
     *          - component             Key of the component on which to log the issue
     *          - rule                  Manual rule key
     *
     * @param array $parameters
     * @return mixed
     */
    public function create(array $parameters) {
        $this->checkParamIsSet($parameters, array("component", "rule"));

        return $this->post('issues/create', $parameters);
    }

    /**
     * Delete a comment. Requires authentication and Browse permission on project
     * Type POST
     * Parameters
     *      Required
     *          - key                   Key of the comment
     *
     * @param array $parameters
     * @return mixed
     */
    public function deleteComment(array $parameters) {
        $this->checkParamIsSet($parameters, array("key"));

        return $this->post('issues/delete_comment', $parameters);
    }

    /**
     * Do workflow transition on an issue. Requires authentication and Browse permission on project
     * Type POST
     * Parameters
     *      Optional
     *          - actionKey             Action to perform
     *      Required
     *          - issue                 Key of the issue
     *
     * @param array $parameters
     * @return mixed
     */
    public function doAction(array $parameters) {
        $this->checkParamIsSet($parameters, array("issue"));

        return $this->post('issues/do_action', $parameters);
    }

    /**
     * Do workflow transition on an issue. Requires authentication and Browse permission on project
     * Type POST
     * Parameters
     *      Optional
     *          - transition            Transition
     *      Required
     *          - issue                 Key of the issue
     *
     * @param array $parameters
     * @return mixed
     */
    public function doTransition(array $parameters) {
        $this->checkParamIsSet($parameters, array("issue"));

        return $this->post('issues/do_transition', $parameters);
    }

    /**
     * Edit a comment. Requires authentication and User role on project
     * Type POST
     * Parameters
     *      Optional
     *          - text                  New comment
     *      Required
     *          - key                   Key of the comment
     *
     * @param array $parameters
     * @return mixed
     */
    public function editComment(array $parameters) {
        $this->checkParamIsSet($parameters, array("key"));

        return $this->post('issues/edit_comment', $parameters);
    }

    /**
     * Plan/Unplan an issue. Requires authentication and Browse permission on project
     * Type POST
     * Parameters
     *      Optional
     *          - plan                  Key of the action plan
     *      Required
     *          - issue                 Key of the issue
     *
     * @param array $parameters
     * @return mixed
     */
    public function plan(array $parameters) {
        $this->checkParamIsSet($parameters, array("issue"));

        return $this->post('issues/plan', $parameters);
    }

    /**
     * Assign/Unassign an issue. Requires authentication and Browse permission on project
     * Type GET
     * Parameters
     *      Optional
     *          - actionPlans           Comma-separated list of action plan keys (not names)
     *          - asc                   Ascending sort
     *          - assigned              To retrieve assigned or unassigned issues
     *          - assignees             Comma-separated list of assignee logins
     *          - componentRoots        To retrieve issues associated to a specific list of components and their sub-components (comma-separated list of component keys). Views are not supported
     *          - components            To retrieve issues associated to a specific list of components (comma-separated list of component keys). Note that if you set the value to a project key, only issues associated to this project are retrieved. Issues associated to its sub-components (such as files, packages, etc.) are not retrieved. See also componentRoots
     *          - createdAfter          To retrieve issues created after the given date (inclusive). Format: date or datetime ISO formats
     *          - createdAt             To retrieve issues created at a given date. Format: date or datetime ISO formats
     *          - createdBefore         To retrieve issues created before the given date (exclusive). Format: date or datetime ISO formats
     *          - extra_fields          Add some extra fields on each issue. Available since 4.4
     *          - hideRules             To not return rules
     *          - issues                Comma-separated list of issue keys
     *          - languages             Comma-separated list of languages. Available since 4.4
     *          - pageIndex             Index of the selected page
     *          - pageSize              Maximum number of results per page. Default value: 100 (except when the 'components' parameter is set, value is set to "-1" in this case). If set to "-1", the max possible value is used
     *          - planned               To retrieve issues associated to an action plan or not
     *          - reporters             Comma-separated list of reporter logins
     *          - resolutions           Comma-separated list of resolutions
     *          - resolved              To match resolved or unresolved issues
     *          - rules                 Comma-separated list of coding rule keys. Format is :
     *          - severities            Comma-separated list of severities
     *          - sort                  Sort field
     *          - statuses              Comma-separated list of statuses
     *
     * @param array $parameters
     * @return mixed
     */
    public function search(array $parameters) {
        return $this->get('issues/search', $parameters);
    }

    /**
     * Change severity. Requires authentication and Browse permission on project
     * Type POST
     * Parameters
     *      Optional
     *          - severity              New severity
     *      Required
     *          - issue                 Key of the issue
     *
     * @param array $parameters
     * @return mixed
     */
    public function setSeverity(array $parameters) {
        $this->checkParamIsSet($parameters, array("issue"));

        return $this->post('issues/set_severity', $parameters);
    }

    /**
     * Get Possible Workflow Transitions for an Issue. Requires Browse permission on project
     * Type POST
     * Parameters
     *      Required
     *          - issue                 Key of the issue
     *
     * @param array $parameters
     * @return mixed
     */
    public function transition(array $parameters) {
        $this->checkParamIsSet($parameters, array("issue"));

        return $this->post('issues/transitions', $parameters);
    }

}