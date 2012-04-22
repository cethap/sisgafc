<?php
/*
 * This file is part of the YepSua package.
 * (c) 2009-2011 Omar Yepez <omar.yepez@yepsua.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * YsComponent  todo description
 *
 *
 * @package    YepSua
 * @subpackage jQuery4PHP
 * @author     Omar Yepez <omar.yepez@yepsua.com>
 * @version    SVN: $Id$
 */
abstract class YsComponent {

  private $jquerySelector;
  private $jQueryObject;
  private $componentVarName;

  public function  __construct() {
    $this->jQueryObject = YsJQuery::newInstance();
  }

  public function getJQuerySelector() {
    $template = $this->jquerySelector;
    if (!isset($this->jquerySelector) || $this->jquerySelector === null) {
      $template = sprintf('%s%s', '#', $this->getGridId());
    }
    return $template;
  }

  public function setJQuerySelector($jquerySelector) {
    $this->jquerySelector = $jquerySelector;
  }

  public function getJQueryObject() {
    return $this->jQueryObject;
  }

  public function setJQueryObject(YsJQueryBuilder $jQueryObject) {
    $this->jQueryObject = $jQueryObject;
  }
  
  public function optionsToArray(){
    return array();
  }

  public function getComponentVarName() {
    return $this->componentVarName;
  }

  public function setComponentVarName($componentVarName) {
    $this->componentVarName = $componentVarName;
  }

  public function callMethod($methodName, $args = null, $pattern = '%s.%s(%s)'){
    $args = ($args !== null) ? YsJSON::valuesToJS($args) : '';
    return sprintf($pattern,$this->getComponentVarName(),$methodName, $args);
  }

  public function  __toString() {
   return YsJSON::arrayToJson($this->optionsToArray());
  }
}