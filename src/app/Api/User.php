<?php
namespace App\Api;

use PhalApi\Api;
use App\Domain\User as UserDomain;
use App\Common\Token as Token;

/**
 * 用户模块接口服务
 */
class User extends Api {
    /**
     * 入参配置
     */
    public function getRules() {
        return array(
            'register' => array(
                'phone' => array('name' => 'phone', 'require' => true, 'min' => 11, 'max' => 11, 'desc' => '手机号'),
                'password' => array('name' => 'password', 'require' => true, 'min' => 6, 'max' => 20, 'desc' => '密码'),
            ),
            'login' => array(
                'phone' => array('name' => 'phone', 'require' => true, 'min' => 11, 'max' => 11, 'desc' => '手机号'),
                'password' => array('name' => 'password', 'require' => true, 'min' => 6, 'max' => 20, 'desc' => '密码'),
            ),
            'checkToken' => array(
                'token' => array('name' => 'token', 'require' => true, 'desc' => 'Token密匙'),
            ),
        );
    }

    /**
     * 注册接口
     * @desc 根据手机号和密码进行注册操作
     * @return String token Token密匙
     */
    public function register() {
        $phone = $this->phone;
        $password = $this->password;

        $userDomain = new UserDomain();
        $userId = $userDomain->signUp($phone,$password);

        $token = Token::getToken($userId);
        return array(
            'token' => $token
        );
    }

    /**
     * 登录接口
     * @desc 根据账号和密码进行登录操作
     * @return String token Token密匙
     */
    public function login() {
        $phone = $this->phone;
        $password = $this->password;

        $userDomain = new UserDomain();
        $user = $userDomain->signIn($phone,$password);

        $token = Token::getToken($user['id']);
        return array(
            'token' => $token,
            'user' => $user
        );
    }

    /**
     * 校验Token接口
     * @desc 校验Token
     * @return int userId 用户ID
     */
    public function checkToken() {
        return array(
            'userId' => Token::checkToken($this->token)
        );
    }
} 
