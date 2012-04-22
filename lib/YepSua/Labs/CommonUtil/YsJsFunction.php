<?php
/*
 * This file is part of the YepSua package.
 * (c) 2009-2011 Omar Yepez <omar.yepez@yepsua.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * YsJsFunction
 *
 * @package    YepSua
 * @subpackage CommonUtil
 * @author     Omar Yepez <omar.yepez@yepsua.com>
 * @version    SVN: $Id$
 */
class YsJsFunction {
    
  private $body;
  private $arguments;
  private $pattern = 'function(%s){%s}';
  private $returnFalse = false;

  const JAVASCRIPT_SINTAX_SEPARATOR = ';';
  const JAVASCRIPT_ARGUMENT_SEPARATOR = ',';
  

  public function  __construct($body= null, $arguments = null)
  {
    $this->setArguments($arguments);
    if($body instanceof self){
      $this->setPattern('%s%s');
      $this->setArguments(null);
    }
    $this->setBody($body);
  }

  public function getPattern(){
    return $this->pattern;
  }

  public function setPattern($pattern){
    $this->pattern = $pattern;
  }

  public function getBody(){
    return (!$this->returnFalse) ? $this->body : $this->body . '; return false';
  }

  public function setBody($body){
    $this->body = $body;
  }

  public function getArguments(){
    return $this->arguments;
  }

  public function setArguments($arguments){
    $this->arguments = $arguments;
  }

  public function  __toString() {
    return sprintf($this->getPattern(), $this->getArguments(),$this->getBody());
  }

  /**
   *@deprecated Use YsJsSintax::setInterval()
   */
  public static function setInterval($function, $interval){
    return sprintf('setInterval(%s, %s);',$function,$interval);
  }

  /**
   *@deprecated Use YsJsSintax::redirect()
   */
  public static function redirect($href){
    return sprintf('window.location = "%s"',$href);
  }

  /**
   *@deprecated Use YsJsSintax::cleanSintax()
   */
  public static function cleanSintax($sintax){
    $errorSintax = array(".()",";;",",}",",]","{;");
    $realSintax = array("",";","}","]","{");
    $sintax = str_replace($errorSintax, $realSintax, $sintax);
    return $sintax;
  }

  /**
   *@deprecated Use YsJsSintax::parseValue()
   */
  public static function parseValue($value){
    return YsJSON::valueToJS($value);
  }

  public static function call($functionName){
    return new YsArgument($functionName, false);
  }

  public static function execute(){
    $function = new YsJsFunction();
    $function->setBody(new YsJQueryDynamic(func_get_args()));
    return $function;
  }
  
  public function getReturnFalse() {
    return $this->returnFalse;
  }

  public function setReturnFalse($returnFalse) {
    $this->returnFalse = $returnFalse;
  }
}
