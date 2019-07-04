<?php
namespace App\Domain;

use App\Model\Team as TeamModel;
use App\Model\TeamJoin as TeamJoinModel;
use App\Model\TeamUser as TeamUserModel;
use App\Common\ResultException as ResultException;
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

    public function findTeamUser($userId,$teamId,$state,$pageNum,$pageSize) {
        $where = array(
            'userId' => $userId,
            'teamId' => $teamId,
            'state' => $state,
        );
        $where = array_filter($where);
        $model = new TeamUserModel();
        return $model->findList($where,$pageNum,$pageSize);
    }

    public function findTeamJoin($userId,$teamId,$state,$pageNum,$pageSize) {
        $where = array(
            'userId' => $userId,
            'teamId' => $teamId,
            'state' => $state,
        );
        $where = array_filter($where);
        $model = new TeamJoinModel();
        return $model->findList($where,$pageNum,$pageSize);
    }

    public function joinTeam($userId,$teamId) {
        //是否已加入
        $teamUserList = $this->findTeamUser($userId,$teamId,1,1,1);
        if(!empty($teamUserList)){
            throw new ResultException('已加入该团队', 3);
        }
        //是否已申请待审核
        $teamJoinList = $this->findTeamJoin($userId,$teamId,1,1,1);
        if(!empty($teamJoinList)){
            throw new ResultException('已提交申请，待审核', 3);
        }
        //新增申请记录
        $data = array(
            'userId' => $userId,
            'teamId' => $teamId,
            'state' => 1,
        );
        $model = new TeamJoinModel();
        return $model->insert($data);
    }

    public function findTeamJoinById($joinId) {
        $where = array(
            'id' => $joinId,
        );
        $model = new TeamJoinModel();
        return $model->find($where);
    }

}