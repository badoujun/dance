<?php
namespace App\Model;

class Team extends BaseModel {

    protected function getTableName($id) {
        return 'team';
    }

}