<?php
namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

class User extends NotORM {

    public function addUser($phone,$pwd) {
        $data = array('phone' => $phone, 'pwd' => $pwd);
        $orm = $this->getORM();
        $orm->insert($data);
        return $orm->insert_id();
    }

    public function findUser($phone,$pwd) {
        $data = array('phone' => $phone, 'pwd' => $pwd);
        return $this->getORM()
            ->select('*')
            ->where($data)
            ->fetchOne();
    }
}