<?php
namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

class User extends NotORM {

    public function addUser($data) {
        $orm = $this->getORM();
        $orm->insert($data);
        return $orm->insert_id();
    }

    public function findUser($data) {
        return $this->getORM()
            ->select('*')
            ->where($data)
            ->fetchOne();
    }
}