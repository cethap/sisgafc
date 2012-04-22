<?php
/*
 * This file is part of the YepSua package.
 * (c) 2009-2011 Omar Yepez <omar.yepez@yepsua.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * YsJQueryPlugin todo description
 *
 * @package    YepSua
 * @subpackage jQuery4PHP
 * @author     Omar Yepez <omar.yepez@yepsua.com>
 * @version    SVN: $Id$
 */
class YsJQueryPlugin extends YsJQueryUtil {

  public function registerOptions(){}

  public static function getInstance()
  {
    $object = __CLASS__;
    self::$instance = new $object();
    return self::$instance;
  }

  /**
   * Render function for jLayout functionality
   * @see YsJQueryUtil::render()
   * @return parent::render()
   */
  public function render(){
    if($this->getOptions() !== null){
      if($this->getArgumentsBeforeOptions() !== null || $this->getArgumentsAfterOptions() !== null){
        $this->setArguments($this->getArgumentsBeforeOptions() .  $this->getOptionsLikeJson() . $this->getArgumentsAfterOptions());
      }else{
        $this->setArguments($this->getOptionsLikeJson());
      }
    }
    return parent::render();
  }
  
  public static function callMethod($methodName){
    $jquery = self::getInstance();
    $jquery->setEvent($methodName);
    return $jquery;
  }
  
  public static function callJQueryMethod($methodName){
    $jquery = self::getInstance();
    $args = func_get_args();
    if(sizeof($args) == 1){
      $jquery->setEvent($methodName);
    }
    if(sizeof($args) > 1){
      $jquery->setEvent($args[0]);
      for($i=1; $i < sizeof($args); $i++){
        $jquery->addArgumentsBeforeOptions(new YsArgument($args[$i]));
      }
    }
    return $jquery;
  }
}