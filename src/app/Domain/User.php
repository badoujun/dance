<?php
namespace App\Domain;

use App\Model\User as UserModel;

class User {

    public function signUp($phone,$pwd) {
        $data = array('phone' => $phone, 'pwd' => $pwd);
        $model = new UserModel();
        return $model->add($data);
    }

    public function signIn($phone,$pwd) {
        $data = array('phone' => $phone, 'pwd' => $pwd);
        $model = new UserModel();
        return $model->find($data);
    }

    public function findUser($phone) {
        $data = array('phone' => $phone);
        $model = new UserModel();
        return $model->find($data);
    }
}