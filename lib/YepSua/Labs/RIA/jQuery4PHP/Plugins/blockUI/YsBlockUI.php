<?php
/*
 * This file is part of the YepSua package.
 * (c) 2009-2011 Omar Yepez <omar.yepez@yepsua.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * YsBlockUI todo description
 *
 *
 * @package    YepSua
 * @subpackage jQuery4PHP
 * @author     Omar Yepez <omar.yepez@yepsua.com>
 * @version    SVN: $Id$
 */
class YsBlockUI extends YsJQueryPlugin {

  const VERSION = "2.39";
  const LICENSE = "MIT and GPL licenses";

  public static $event = 'blockUI';
  public static $blockEvent = 'block';
  public static $unblockUIEvent = 'unblockUI';
  public static $unblockEvent = 'unblock';
  public static $growlUIEvent = 'growlUI';
  public static $defaultsEvent = '.defaults';

  public function registerOptions(){
    return   array(
              //options
               '_message' =>  array('key' => 'message', 'is_quoted' => false),
               '_css' =>  array('key' => 'css', 'is_quoted' => false),
               '_overlayCSS' =>  array('key' => 'overlayCSS', 'is_quoted' => false),
               '_growlCSS' =>  array('key' => 'growlCSS', 'is_quoted' => false),
               '_iframeSrc' =>  array('key' => 'iframeSrc', 'is_quoted' => false),
               '_forceIframe' =>  array('key' => 'forceIframe', 'is_quoted' => false),
               '_baseZ' =>  array('key' => 'baseZ', 'is_quoted' => false),
               '_centerX' =>  array('key' => 'centerX', 'is_quoted' => false),
               '_centerY' =>  array('key' => 'centerY', 'is_quoted' => false),
               '_allowBodyStretch' =>  array('key' => 'allowBodyStretch', 'is_quoted' => false),
               '_bindEvents' =>  array('key' => 'bindEvents', 'is_quoted' => false),
               '_constrainTabKey' =>  array('key' => 'constrainTabKey', 'is_quoted' => false),
               '_fadeIn' =>  array('key' => 'fadeIn', 'is_quoted' => false),
               '_fadeOut' =>  array('key' => 'fadeOut', 'is_quoted' => false),
               '_timeout' =>  array('key' => 'timeout', 'is_quoted' => false),
               '_showOverlay' =>  array('key' => 'showOverlay', 'is_quoted' => false),
               '_focusInput' =>  array('key' => 'focusInput', 'is_quoted' => false),
               '_applyPlatformOpacityRules' =>  array('key' => 'applyPlatformOpacityRules', 'is_quoted' => false),
               '_quirksmodeOffsetHack' =>  array('key' => 'quirksmodeOffsetHack', 'is_quoted' => false),
               '_theme' =>  array('key' => 'theme', 'is_quoted' => false),
               '_title' =>  array('key' => 'title', 'is_quoted' => false),
              // events
               '_onUnblock' =>  array('key' => 'onUnblock', 'is_quoted' => false),
               '_onBlock' =>  array('key' => 'onBlock', 'is_quoted' => false),
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

  public static function build($jQuerySelector = null,$options = null){
    $jquery = self::getInstance();
    $jquery->setEvent(self::$event);
    if($jQuerySelector !== null){
        $jquery->setEvent(self::$blockEvent);
        $jquery->setSelector($jQuerySelector);
    }
    if($options !== null){
        $jquery->setOptions($options);
    }
    return $jquery;
  }

  public static function block($options = null){
    return self::build(null, $options);
  }
  
  public static function blockElement($jQuerySelector, $options = null){
    return self::build($jQuerySelector, $options);
  }

  public static function growlUI($title, $message){
    $jquery = self::getInstance();
    $jquery->setEvent(self::$growlUIEvent);
    $jquery->addArgumentsBeforeOptions(new YsArgument($title));
    $jquery->addArgumentsBeforeOptions(new YsArgument($message));
    return $jquery;
  }



  public static function unblock($jQuerySelector = null, $options = null){
    $jquery = self::getInstance();
    $jquery->setEvent(self::$unblockUIEvent);
    if($jQuerySelector !== null){
        $jquery->setEvent(self::$unblockEvent);
        $jquery->setSelector($jQuerySelector);
    }
    if($options !== null){
        $jquery->setOptions($options);
    }
    return $jquery;
  }

  public static function defaults($options = null){
    $sintaxArray = array();
    $jqueryDynamic = new YsJQueryDynamic();
    if($options !== null){
      if(is_array($options)){
        $i = 0;
        foreach ($options as $key => $value){
          $jquery = self::getInstance();
          $jquery->setIsOnlyAccesors(true);
          $jquery->setEvent(self::$event . self::$defaultsEvent);
          $jquery->addAccesorsWithPattern($key, new YsArgument($value), '.%s = %s');
          $sintaxArray[$i++] = $jquery;
        }
        $jqueryDynamic->build($sintaxArray);
      }
    }
    return $jqueryDynamic;
  }

}