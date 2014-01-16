﻿<?php
/*
 * 开启常规项
 */
session_start();
header('Content-type:text/html; charset=utf-8');

/*
 * 此处定义一些静态参数
 * 说明：请使用define函数
 */
define('SYS_NAME','信息平台');
define('SYS_POWER','HCI人机交互中心');

/*
 * 数据库连接
 * 说明：请使用PDO进行数据库操作
 */
$db_url = '127.0.0.1';
$db_port = '3306';
$db_user = 'root';
$db_pwd = '123';
$db_name = 'hcimsg';

try {
    $db = new PDO("mysql:host=$db_url;port=$db_port;dbname=$db_name",$db_user,$db_pwd);
    //禁用仿真效果
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    $db->exec('SET NAMES UTF8');
} catch(PDOException $e) {
    echo $e;
}

/*
 * 系统类
 */
class sys {
    /*
     * 构造函数
     */
    function __construct() {
        //@todo 初始化系统
    }

    /*
     * redirect方法
     * 跳转到指定页面
     * @author C860
     * @param $url string 跳转地址
     * return NULL
     */
    static function redirect($url) {
        echo '<script type="text/javascript">location.href="'.$url.'";</script>';
        exit(0);
    }

    /*
     * alert方法
     * 弹出提示框提示信息
     * @author C860
     * @param $msg string 提示信息
     * @return NULL
     */
    static function alert($msg) {
        echo '<script type="text/javascript">alert("'.$msg.'");</script>';
    }
}

