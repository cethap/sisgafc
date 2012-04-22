<?php
/*
 * This file is part of the YepSua package.
 * (c) 2009-2011 Omar Yepez <omar.yepez@yepsua.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * YsJQForm todo description
 *
 *
 * @package    YepSua
 * @subpackage jQuery4PHP
 * @author     Omar Yepez <omar.yepez@yepsua.com>
 * @version    SVN: $Id$
 */
class YsJQForm extends YsJQueryPlugin {

  const VERSION = "2.80";
  const LICENSE = "MIT and GPL licenses";

  public static $event = 'ajaxForm';
  public static $ajaxSubmitEvent = 'ajaxSubmit';
  public static $formSerializeEvent = 'formSerialize';
  public static $fieldSerializeEvent = 'fieldSerialize';
  public static $fieldValueEvent = 'fieldValue';
  public static $resetFormEvent = 'resetForm';
  public static $clearFormEvent = 'clearForm';
  public static $clearFieldsEvent = 'clearFields';


  public function registerOptions(){
    return   array(
              //options
               '_target' =>  array('key' => 'target', 'is_quoted' => false),
               '_replaceTarget' =>  array('key' => 'replaceTarget', 'is_quoted' => false),
               '_url' =>  array('key' => 'url', 'is_quoted' => false),
               '_type' =>  array('key' => 'type', 'is_quoted' => false),
               '_data' =>  array('key' => 'data', 'is_quoted' => false),
               '_dataType' =>  array('key' => 'dataType', 'is_quoted' => false),
               '_success' =>  array('key' => 'success', 'is_quoted' => false),
               '_semantic' =>  array('key' => 'semantic', 'is_quoted' => false),
               '_resetForm' =>  array('key' => 'resetForm', 'is_quoted' => false),
               '_clearForm' =>  array('key' => 'clearForm', 'is_quoted' => false),
               '_iframe' =>  array('key' => 'iframe', 'is_quoted' => false),
               '_iframeSrc' =>  array('key' => 'iframeSrc', 'is_quoted' => false),
               '_forceSync' =>  array('key' => 'forceSync', 'is_quoted' => false),
              // events
               '_beforeSerialize' =>  array('key' => 'beforeSerialize', 'is_quoted' => false),
               '_beforeSubmit' =>  array('key' => 'beforeSubmit', 'is_quoted' => false)
              );
  }

  /**
   * Retrieves a instance of this class.
   * @return object self::$instance
   */
  public static function getInstance()
  {
    $object = __CLASS__;
    self::$instance = new $object();
    return self::$instance;
  }

  public static function ajaxForm($options = null){
    $jquery = self::getInstance();
    $jquery->setEvent(self::$event);
    if($options !== null){
        $jquery->setOptions($options);
    }
    return $jquery;
  }

  public static function ajaxSubmit($options = null){
    $jquery = self::getInstance();
    $jquery->setEvent(self::$ajaxSubmitEvent);
    if($options !== null){
        $jquery->setOptions($options);
    }
    return $jquery;
  }

  public static function formSerialize($jquerySelector = null){
    $jquery = self::callMethod(self::$formSerializeEvent);
    if($jquerySelector !== null){
      $jquery->setSelector($jquerySelector);
    }
    return $jquery;
  }

  public static function fieldSerialize($jquerySelector = null){
    $jquery = self::callMethod(self::$fieldSerializeEvent);
    if($jquerySelector !== null){
      $jquery->setSelector($jquerySelector);
    }
    return $jquery;
  }

  public static function fieldValue($jquerySelector = null){
    $jquery = self::callMethod(self::$fieldValueEvent);
    if($jquerySelector !== null){
      $jquery->setSelector($jquerySelector);
    }
    return $jquery;
  }

  public static function resetForm($jquerySelector = null){
    $jquery = self::callMethod(self::$resetFormEvent);
    if($jquerySelector !== null){
      $jquery->setSelector($jquerySelector);
    }
    return $jquery;
  }

  public static function clearForm($jquerySelector = null){
    $jquery = self::callMethod(self::$clearFormEvent);
    if($jquerySelector !== null){
      $jquery->setSelector($jquerySelector);
    }
    return $jquery;
  }

  public static function clearFields($jquerySelector = null){
    $jquery = self::callMethod(self::$clearFieldsEvent);
    if($jquerySelector !== null){
      $jquery->setSelector($jquerySelector);
    }
    return $jquery;
  }

}