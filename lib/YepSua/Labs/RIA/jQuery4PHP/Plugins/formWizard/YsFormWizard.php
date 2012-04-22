<?php
/*
 * This file is part of the YepSua package.
 * (c) 2009-2011 Omar Yepez <omar.yepez@yepsua.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * YsFormWizard todo description
 *
 * @package    YepSua
 * @subpackage jQuery4PHP
 * @author     Omar Yepez <omar.yepez@yepsua.com>
 * @version    SVN: $Id$
 */
class YsFormWizard extends YsJQueryPlugin {

  const VERSION = "3.0.5";
  const LICENSE = "MIT License";
  const STEP_CLASS = "step";
  const SUBMIT_STEP_CLASS = "step submit_step";
  const STATE_METHOD = "state";
  const SHOW_METHOD =  "show";
  const RESET_METHOD =  "reset";
  const DESTROY_METHOD =  "destroy";
  const BACK_METHOD =  "back";
  const NEXT_METHOD =  "next";
  const UPDATE_STEPS_METHOD =  "update_steps";
  const OPTION_METHOD =  "option";
  
  public static $event = 'formwizard';
  
  public function registerOptions(){
    return   array(
              //options
               '_historyEnabled' =>  array('key' => 'historyEnabled', 'is_quoted' => false),
               '_validationEnabled' =>  array('key' => 'validationEnabled', 'is_quoted' => false),
               '_validationOptions' =>  array('key' => 'validationOptions', 'is_quoted' => false),
               '_formPluginEnabled' =>  array('key' => 'formPluginEnabled', 'is_quoted' => false),
               '_formOptions' =>  array('key' => 'formOptions', 'is_quoted' => false),
               '_linkClass' =>  array('key' => 'linkClass', 'is_quoted' => false),
               '_submitStepClass' =>  array('key' => 'submitStepClass', 'is_quoted' => false),
               '_back' =>  array('key' => 'back', 'is_quoted' => false),
               '_next' =>  array('key' => 'next', 'is_quoted' => false),
               '_textSubmit' =>  array('key' => 'textSubmit', 'is_quoted' => false),
               '_textNext' =>  array('key' => 'textNext', 'is_quoted' => false),
               '_textBack' =>  array('key' => 'textBack', 'is_quoted' => false),
               '_remoteAjax' =>  array('key' => 'remoteAjax', 'is_quoted' => false),
               '_inAnimation' =>  array('key' => 'inAnimation', 'is_quoted' => false),
               '_outAnimation' =>  array('key' => 'outAnimation', 'is_quoted' => false),
               '_inDuration' =>  array('key' => 'inDuration', 'is_quoted' => false),
               '_outDuration' =>  array('key' => 'outDuration', 'is_quoted' => false),
               '_easing' =>  array('key' => 'easing', 'is_quoted' => false),
               '_focusFirstInput' =>  array('key' => 'focusFirstInput', 'is_quoted' => false),
               '_disableInputFields' =>  array('key' => 'disableInputFields', 'is_quoted' => false),
               '_disableUIStyles' =>  array('key' => 'disableUIStyles', 'is_quoted' => false),
             //events
               '_afterRemoteAjax' =>  array('key' => 'after_remote_ajax', 'is_quoted' => false),
               '_beforeRemoteAjax' =>  array('key' => 'before_remote_ajax', 'is_quoted' => false),
               '_stepShown' =>  array('key' => 'step_shown', 'is_quoted' => false),
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

  public static function build($jquerySelector = null){
    $jquery = self::getInstance();
    $jquery->setEvent(self::$event);
    if($jquerySelector !== null) { $jquery->setSelector($jquerySelector); }
    return $jquery;
  }
  
  public static function state(){
    $jquery = self::callJQueryMethod(self::$event,self::STATE_METHOD);
    return $jquery;
  }
  
  public static function show($step){
    $jquery = self::callJQueryMethod(self::$event,self::STATE_METHOD, $step);
    return $jquery;
  }

  public static function reset(){
    $jquery = self::callJQueryMethod(self::$event,self::RESET_METHOD);
    return $jquery;
  }
  
  public static function destroyWizard(){
    $jquery = self::callJQueryMethod(self::$event,self::DESTROY_METHOD);
    return $jquery;
  }
  
  public static function back(){
    $jquery = self::callJQueryMethod(self::$event,self::BACK_METHOD);
    return $jquery;
  }
  
  public static function next(){
    $jquery = self::callJQueryMethod(self::$event,self::NEXT_METHOD);
    return $jquery;
  }
  
  public static function updateSteps(){
    $jquery = self::callJQueryMethod(self::$event,self::UPDATE_STEPS_METHOD);
    return $jquery;
  }
  
  public static function changeOptions($options){
    $jquery = self::getInstance();
    $jquery->setEvent(self::$event);
    $jquery->addArgumentsBeforeOptions(new YsArgument(self::OPTION_METHOD));
    $jquery->setOptions($options);
    return $jquery;
  }
  
  //TEMPLATES
  
  public static function initWizard($id,$htmlProperties = null){
    return YsHTML::getTag(YsHTML::FORM, sprintf('id="%s" %s ', $id , $htmlProperties));
  }
  
  public static function endWizard(){
    return YsHTML::getTagClosed(YsHTML::FORM);
  }
  
  public static function initStep($id,$caption,$htmlProperties = null){
    return self::stepTemplate($id,self::STEP_CLASS,$caption,$htmlProperties);
  }
  
  public static function initSubmitStep($id,$caption,$htmlProperties = null){
    return self::stepTemplate($id,self::SUBMIT_STEP_CLASS,$caption,$htmlProperties);
  }
  
  public static function stepTemplate($id,$type,$caption,$htmlProperties = null){
    $template = new YsHTML();
    $template->addToTemplate(YsHTML::getTag(YsHTML::SPAN, sprintf('id="%s" class="%s" %s ', $id , $type, $htmlProperties)));
    $template->addToTemplate(YsHTML::getTag(YsHTML::H3));
    $template->addToTemplate($caption);
    $template->addToTemplate(YsHTML::getTagClosed(YsHTML::H3));
    return $template;
  }
   
  public static function endStep(){
    return YsHTML::getTagClosed(YsHTML::SPAN);
  }
}