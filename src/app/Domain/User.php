<?php
namespace App\Domain;

use App\Model\User as UserModel;

class User {

    public function signUp($phone,$pwd) {
        $model = new UserModel();
        return $model->addUser($phone,$pwd);
    }

    public function signIn($phone,$pwd) {
        $model = new UserModel();
        return $model->findUser($phone,$pwd);
    }
}