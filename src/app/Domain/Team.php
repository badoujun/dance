<?php
namespace App\Domain;

use App\Model\Team as TeamModel;

class Team {

    public function addTeam($userId,$teamName,$detail,$head,$atlas,$cityCode,$longitude,$latitude) {
        $data = array(
            'userId' => $userId,
            'teamName' => $teamName,
            'detail' => $detail,
            'head' => $head,
            'atlas' => $atlas,
            'cityCode' => $cityCode,
            'longitude' => $longitude,
            'latitude' => $latitude,
        );
        $model = new TeamModel();
        return $model->add($data);
    }

    public function updateTeam($userId,$teamName,$detail,$head,$atlas,$cityCode,$longitude,$latitude,$teamId) {
        $where = array(
            'id' => $teamId,
            'userId' => $userId,
        );
        $data = array(
            'teamName' => $teamName,
            'detail' => $detail,
            'head' => $head,
            'atlas' => $atlas,
            'cityCode' => $cityCode,
            'longitude' => $longitude,
            'latitude' => $latitude,
        );
        $model = new TeamModel();
        return $model->updateByWhere($where,$data);
    }

    public function findTeam($teamId,$teamName,$cityCode,$longitude,$latitude,$pageNum,$pageSize) {
        $where = array(
            'id' => $teamId,
            'teamName like ?' => "%".$teamName."%",
            'cityCode' => $cityCode,
        );
        $where = array_filter($where);
        $model = new TeamModel();
        return $model->findList($where,$pageNum,$pageSize);
    }

}