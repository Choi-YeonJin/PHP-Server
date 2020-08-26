<?php
/**
 * 2020/8/14
 * Copyright (c) ITKOO
 *
 * 공통 유틸리티
 */

namespace Util;

class WebUtil
{
    public static function convertStringToCamelcase($string) {
        return lcfirst(str_replace('_','',ucwords($string,'_')));
    }

    public static function convertArrayKeyToCamelcase($array) {
        $newArray = array();
        foreach($array as $tmpKey => $tmpValue)
        {
            $newArray[WebUtil::convertStringToCamelcase($tmpKey)]=$tmpValue;
        }
        return $newArray;
    }
}