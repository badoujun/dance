<?php
namespace App\Model;

class TeamUser extends BaseModel {

    protected function getTableName($id) {
        return 'team_user';
    }

}