<?php

declare(strict_types = 1);

namespace Ericjank\Hutils\Helpers;

use Ericjank\Hutils\Helpers\Code;
use Hyperf\Di\Annotation\Scanner;

Class Helper
{
    public static $scanner = [];
    public function __construct()
    {
        if ( ! isset(self::$scanner['code']))
        {
            self::$scanner['code'] = new Scanner();
            self::$scanner['code']->scan([dirname(__FILE__)]);
        }
    }

    //返回成功
    public function success($data)
    {
        return $this->result(Code::SUCCESS, Code::getMessage(Code::SUCCESS), $data);
    }

    //返回错误
    public function error($code = 422, $message = '', $data = [])
    {
        if (empty($message)) {
            return $this->result($code, Code::getMessage($code), $data);
        } else {
            return $this->result($code, $message, $data);
        }
    }

    public function result($code, $message, $data)
    {
        return ['code' => $code, 'message' => $message, 'data' => $data];
    }

    public function jsonEncode($data)
    {
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 生成随机数
     * @param number $length
     * @return number
     */
    public function generateNumber($length = 6)
    {
        return random_int(pow(10, ($length - 1)), pow(10, $length) - 1);
    }

    /**
     * 生成随机字符串
     * @param number $length
     * @param string $chars
     * @return string
     */
    public function generateString($length = 6, $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz')
    {
        $chars = str_split($chars);

        $chars = array_map(function($i) use($chars) {
            return $chars[$i];
        }, array_rand($chars, $length));

        return implode($chars);
    }

    /**
     * xml to array 转换
     * @param type $xml
     * @return type
     */
    public function xml2array($xml)
    {
        return json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    }

    /**
     * 第三方登录类型
     *
     * @param int $type 类型
     * @return string
     */
    public function getThirdType($type)
    {
        switch ($type) {
            case 1:
                $thirdType = 'Weixin';
                break;
            case 2:
                $thirdType = 'QQ';
                break;
            case 3:
                $thirdType = 'Weibo';
                break;
            default :
                $thirdType = 'Weixin';
        }

        return $thirdType;
    }

    //短信验证码类型
    public function sendCodeType(int $code_type): array
    {
        switch ($code_type) {
            case 1: //手机号登陆验证码
                $type = 'signup';
                $template = 'ali_login';
                $suffix = '_login';
                break;
            case 2: //绑定手机号验证码
                $type = 'signup';
                $template = 'ali_login';
                $suffix = '_bind';
                break;
            case 3: //修改密码验证码
                $type = 'signup';
                $template = 'ali_login';
                $suffix = '_resetpwd';
                break;
            case 4: //设置支付密码验证码
                $type = 'signup';
                $template = 'ali_login';
                $suffix = '_resetpaypwd';
                break;
            case 5: //忘记密码
                $type = 'signup';
                $template = 'ali_login';
                $suffix = '_forgetpwd';
                break;
            default://手机号登陆验证码
                $type = 'signup';
                $template = 'ali_login';
                $suffix = '_login';
                break;
        }
        return [
            'type' => $type,
            'template' => $template,
            'suffix' => $suffix,
        ];
    }

    /**
     * 创建默认用户名
     *
     * @return string
     */
    public function createDefaultUsername(): string
    {
        return (string) $this->generateNumber(9);
    }

    /**
     * 创建默认昵称
     *
     * @return string
     */
    public function createDefaultNickname(): string
    {
        return 'TXC'.$this->generateNumber(7);
    }

}
