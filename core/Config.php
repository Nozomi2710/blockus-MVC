<?php

class Config
{
    public static $projectName;
    public static $root;
    public static $imgRoot;
    public static $cssRoot;
    public static $jsRoot;
    public static $paymentUser;
    public static $paymentPWD;

    static function getInstance()
    {
        self::$root = '/SecondStage/payment/';
        self::$cssRoot = self::$root . 'views/css/';
        self::$jsRoot = self::$root . 'views/js/';
        //權限較小的帳號
        self::$paymentUser = "nozomi_2710";
        self::$paymentPWD = "yuma8980";
    }

}
