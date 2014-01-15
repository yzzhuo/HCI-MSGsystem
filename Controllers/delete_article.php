﻿<?php 
/*
*管理员删除文章功能
*Create By 关丽莎 at 2014-1-14
*
*/
//引用相关模块
include_once('../conf/config.php');
include_once('../Models/user_basic.php');

//传来3个参数，id为文章的主码
$id=$_POST['id'];
$user=$_POST['user'];
$password=$_POST['password'];

if(!isset($_POST['id'])||empty($_POST['id'])
	|| !isset($_POST['user'])||empty($_POST['user'])
	||!isset($_POST['password'])||empty($_POST['password'])) {
    echo '参数不完整！';
}

if(user_basic::search($user,$password) == true) {
	try {
		user_basic::deleteArticle($id);
	}catch(PDOException $e) {
		echo $e;
	}
}
?>