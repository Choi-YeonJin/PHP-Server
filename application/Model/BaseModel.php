<?php
/**
 * 2020/8/14
 * Copyright (c) ITKOO
 *
 * 기본 Model
 */

namespace Model;
use Util\WebUtil;
include_once("../../application/lib/autoload.php");

abstract class BaseModel {
    function __construct() {
    }

    function __destruct()
    {
        // TODO: Implement __destruct() method.
    }

    public function getArray() {
        $methodList = get_class_methods(get_class($this));
        $varList = array();
        foreach ( $methodList as $methodName ) {
            if ( preg_match('/get([A-Z].*)/',$methodName,$matches) ) {
                $functionName = $matches[0];
                if ( $functionName == 'getJson' || $functionName == 'getArray' ) { } else {
                    $varName = lcfirst($matches[1]); $varList[$varName] = call_user_func(array($this,$functionName)); }
            }
        }
        return $varList;
    }

    public function setByArray($keyValueArray) {

        $keyValueArray = WebUtil::convertArrayKeyToCamelcase($keyValueArray);

        $methodList = get_class_methods(get_class($this));

        foreach ( $methodList as $methodName ) {
            if ( preg_match('/set([A-Z].*)/',$methodName,$matches) ) {
                $functionName = $matches[0];
                if ( $functionName == 'setByArray' ) { } else {
                    $varName = lcfirst($matches[1]);
                    if ( isset($keyValueArray[$varName] ) ) { $this->$functionName($keyValueArray[$varName]); }
                }
            }
        }
    }

    public function getJson($obj = null) {
        $stripNewLine = function($string) { return trim($string);};
        return json_encode(array_map($stripNewLine,$this->getArray($obj)), JSON_UNESCAPED_UNICODE);
    }
}
