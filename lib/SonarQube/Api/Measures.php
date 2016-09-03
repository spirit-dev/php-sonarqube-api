<?php
namespace SonarQube\Api;

use SonarQube\Api\Interfaces\MeasuresInterface;

/**
 * Class Authentication
 * @package SonarQube\Api
 */
class Measures extends AbstractApi implements MeasuresInterface {
    /**
     * @inheritDoc
     */
    public function component(array $parameters = array()) {
        $this->checkParamIsSet($parameters, array("metricKeys"));

        return $this->post('measures/component', $parameters);
    }
    /**
     * @inheritDoc
     */
    public function componentTree(array $parameters = array()) {
        $this->checkParamIsSet($parameters, array("metricKeys"));

        return $this->post('measures/component_tree', $parameters);
    }
}
