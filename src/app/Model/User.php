<?php
namespace App\Model;

class User extends BaseModel {

    protected function getTableName($id) {
        return 'user';
    }

}