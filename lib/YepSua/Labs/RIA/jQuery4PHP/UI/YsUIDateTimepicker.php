<?php
/*
 * This file is part of the YepSua package.
 * (c) 2009-2011 Omar Yepez <omar.yepez@yepsua.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * YsUIDatepicker The jQuery UI Datepicker is a highly configurable plugin that
 * adds datepicker functionality to your pages. You can customize the date
 * format and language, restrict the selectable date ranges and add in buttons
 * and other navigation options easily.
 *
 * @package    YepSua
 * @subpackage jQuery4PHP
 * @author     Omar Yepez <omar.yepez@yepsua.com>
 * @version    SVN: $Id$
 */
class YsUIDateTimepicker  extends YsUIDatepicker {

  public static $uiEvent = YsUIConstant::DATETIMEPICKER_WIDGET;
  public static $timepickerEvent = YsUIConstant::TIMEPICKER_WIDGET;

  public function  registerOptions() {
    $timeOptions =   array(
     //options
     '_currentText' =>  array('key' => 'currentText', 'is_quoted' => false),
     '_closeText' =>  array('key' => 'closeText', 'is_quoted' => false),
     '_ampm' =>  array('key' => 'ampm', 'is_quoted' => false),
     '_timeFormat' =>  array('key' => 'timeFormat', 'is_quoted' => false),
     '_timeOnlyTitle' =>  array('key' => 'timeOnlyTitle', 'is_quoted' => false),
     '_timeText' =>  array('key' => 'timeText', 'is_quoted' => false),
     '_hourText' =>  array('key' => 'hourText', 'is_quoted' => false),
     '_minuteText' =>  array('key' => 'minuteText', 'is_quoted' => false),
     '_secondText' =>  array('key' => 'secondText', 'is_quoted' => false),
     '_showButtonPanel' =>  array('key' => 'showButtonPanel', 'is_quoted' => false),
     '_timeOnly' =>  array('key' => 'timeOnly', 'is_quoted' => false),
     '_showHour' =>  array('key' => 'showHour', 'is_quoted' => false),
     '_showMinute' =>  array('key' => 'showMinute', 'is_quoted' => false),
     '_showSecond' =>  array('key' => 'showSecond', 'is_quoted' => false),
     '_showTime' =>  array('key' => 'showTime', 'is_quoted' => false),
     '_stepHour' =>  array('key' => 'stepHour', 'is_quoted' => false),
     '_stepMinute' =>  array('key' => 'stepMinute', 'is_quoted' => false),
     '_stepSecond' =>  array('key' => 'stepSecond', 'is_quoted' => false),
     '_hour' =>  array('key' => 'hour', 'is_quoted' => false),
     '_minute' =>  array('key' => 'minute', 'is_quoted' => false),
     '_second' =>  array('key' => 'second', 'is_quoted' => false),
     '_hourMin' =>  array('key' => 'hourMin', 'is_quoted' => false),
     '_minuteMin' =>  array('key' => 'minuteMin', 'is_quoted' => false),
     '_secondMin' =>  array('key' => 'secondMin', 'is_quoted' => false),
     '_hourMax' =>  array('key' => 'hourMax', 'is_quoted' => false),
     '_minuteMax' =>  array('key' => 'minuteMax', 'is_quoted' => false),
     '_secondMax' =>  array('key' => 'secondMax', 'is_quoted' => false),
     '_minDateTime' =>  array('key' => 'minDateTime', 'is_quoted' => false),
     '_maxDateTime' =>  array('key' => 'maxDateTime', 'is_quoted' => false),
     '_hourGrid' =>  array('key' => 'hourGrid', 'is_quoted' => false),
     '_minuteGrid' =>  array('key' => 'minuteGrid', 'is_quoted' => false),
     '_secondGrid' =>  array('key' => 'secondGrid', 'is_quoted' => false),
     '_alwaysSetTime' =>  array('key' => 'alwaysSetTime', 'is_quoted' => false),
     '_separator' =>  array('key' => 'separator', 'is_quoted' => false),
     '_altFieldTimeOnly' =>  array('key' => 'altFieldTimeOnly', 'is_quoted' => false),
     '_showTimepicker' =>  array('key' => 'showTimepicker', 'is_quoted' => false));
    return array_merge(parent::registerOptions(),$timeOptions);
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

  public static function build($jquerySelector = null){
    $jquery = self::getInstance();
    $jquery->setEvent(self::$uiEvent);
    if($jquerySelector !== null) { $jquery->setSelector($jquerySelector); }
    return $jquery;
  }

  public static function datetimepicker($jquerySelector = null){
    return self::build($jquerySelector);
  }

  public static function timepicker($jquerySelector = null){
    $jquery = self::build($jquerySelector);
    $jquery->setEvent(self::$timepickerEvent);
    return $jquery;
  }

  public static function setDatetime($jquerySelector, $time){
    return parent::setDate($jquerySelector, $time);
  }

  public static function getDatetime($jquerySelector){
    return parent::getDate($jquerySelector);
  }

}