<?php

declare(strict_types = 1);

namespace Ericjank\Hutils\Helpers;

class Validation
{
    //手机号
    public function isPhoneNumber(string $phone): bool
    {
        return preg_match("/^1[3456789]{1}\d{9}$/",$phone) ? true : false;
    }

    //6-16位数字或字母密码
    public function isPassword(string $password): bool
    {
        return preg_match("/^[0-9A-Za-z]{6,16}$/",$password) ? true : false;
    }

    //6位支付密码
    public function isPaypwd(string $payPwd): bool
    {
        return preg_match("/^[0-9]{6}$/", $payPwd) ? true : false;
    }

    //身份证号
    public function isIdCard(string $idCard): bool
    {
        $length = strlen($idCard);
        if($length == 18){
            return preg_match("/^[1-9]\d{5}(18|19|20|21|22|23)\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$/", $idCard) ? true : false;
        }elseif ($length == 15){
            return preg_match("/^[1-9]\d{5}\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{2}[0-9Xx]$/", $idCard) ? true : false;
        }else{
            return false;
        }

    }

    //姓名
    public function isChineseName(string $chineseName): bool
    {
        return preg_match("/^[\x{4e00}-\x{9fa5}]{1}[a-zA-Z\x{4e00}-\x{9fa5}·•]{1,7}$/u", $chineseName) ? true : false;
    }

    //昵称
    public function isNickName(string $nickName): bool
    {
        return preg_match("/^[a-zA-Z\x{4e00}-\x{9fa5}0-9\.\/_-]{1,10}$/u", $nickName) ? true : false;
    }

}