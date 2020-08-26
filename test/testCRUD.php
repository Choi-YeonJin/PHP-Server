<?php
/**
 * 2020/8/14
 * Copyright (c) ITKOO
 *
 * index.php 에서 주석 다 ~~ 뺀 버전
 */

use Model\UserModel;
use DAO\UserDAO;
include_once("application/lib/autoload.php");

$userDAO = new UserDAO();
$userModel = new UserModel();

$userModel->setName("구지원");
$userModel->setCreatedAt(time());

$userId = $userDAO->insert($userModel);

$id = 1;
$userDAO->select($id);
$userList = $userDAO->selectAll();
//foreach ($userList as $userModel){
//
//}



