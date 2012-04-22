<?php
/*
 * This file is part of the YepSua package.
 * (c) 2009-2011 Omar Yepez <omar.yepez@yepsua.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * YsJQMask todo description.
 *
 * @package    YepSua
 * @subpackage CommonUtil
 * @author     Omar Yepez <omar.yepez@yepsua.com>
 * @version    SVN: $Id$
 */
class YsJQMask extends YsJQueryPlugin {

  const VERSION = "1.1.3";
  const LICENSE = "MIT License";
  public static $event = 'setMask';
  public static $unsetMaskEvent = 'unsetMask';
  public static $unmaskedValEvent = 'unmaskedVal';
  public static $maskStringEvent = 'mask.string';
  public static $setMasksEvent = 'mask.masks';
  public static $setRulesEvent = 'mask.rules';


  public function registerOptions(){
      return   array(
            //options
             '_attr' =>  array('key' => 'attr', 'is_quoted' => false),
             '_mask' =>  array('key' => 'mask', 'is_quoted' => false),
             '_type' =>  array('key' => 'type', 'is_quoted' => false),
             '_maxLength' =>  array('key' => 'maxLength', 'is_quoted' => false),
             '_defaultValue' =>  array('key' => 'defaultValue', 'is_quoted' => true),
             '_textAlign' =>  array('key' => 'textAlign', 'is_quoted' => false),
             '_selectCharsOnFocus' =>  array('key' => 'selectCharsOnFocus', 'is_quoted' => false),
             '_setSize' =>  array('key' => 'setSize', 'is_quoted' => false),
             '_autoTab' =>  array('key' => 'autoTab', 'is_quoted' => false),
             '_fixedChars ' =>  array('key' => 'fixedChars ', 'is_quoted' => false),
            // events
             '_onInvalid' =>  array('key' => 'onInvalid', 'is_quoted' => false),
             '_onValid' =>  array('key' => 'onValid', 'is_quoted' => false),
             '_onOverflow' =>  array('key' => 'onOverflow', 'is_quoted' => false)
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

  public static function build($options = null){
    $jquery = self::getInstance();
    $jquery->setEvent(self::$event);
    return $jquery;
  }

  public static function unsetMask($jquerySelector = null){
    $jquery = self::getInstance();
    $jquery->setEvent(self::$unsetMaskEvent);
    if($jquerySelector !== null){
      $jquery->setSelector($jquerySelector);
    }
    return $jquery;
  }
  
  public static function unmaskedVal($jquerySelector = null){
    $jquery = self::getInstance();
    $jquery->setEvent(self::$unmaskedValEvent);
    if($jquerySelector !== null){
      $jquery->setSelector($jquerySelector);
    }
    return $jquery;
  }

  public static function maskString($el){
    $jquery = self::getInstance();
    $jquery->setEvent(self::$maskStringEvent);
    $jquery->addArgumentsBeforeOptions($el);
    return $jquery;
  }



  public static function mask($mask, $options){
    $jquery = self::getInstance();
    $jquery->setEvent(self::$event);
    return $jquery;
  }

  public static function setMasks($masks){
    $jquery = self::getInstance();
    $jquery->setEvent(self::$setMasksEvent);
    $jquery->addArgumentsBeforeOptions($masks);
    return $jquery;
  }

  public static function setRules($rules){
    $jquery = self::getInstance();
    $jquery->setEvent(self::$setRulesEvent);
    $jquery->addArgumentsBeforeOptions($rules);
    return $jquery;
  }

}
