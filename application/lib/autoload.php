<?php
/**
 * 2020/8/14
 * Copyright (c) ITKOO
 *
 * 필요한 파일들을 한번에 require
 * (application 폴더 밑 파일들)
 */

spl_autoload_register(function ($className){
    $className = str_replace("\\", "/", $className);
    require_once $_SERVER['DOCUMENT_ROOT']."/application/".$className.".php";
});
