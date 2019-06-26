<?php
namespace App\Api;

use PhalApi\Api;
use App\Domain\Team as TeamDomain;
use App\Common\Token;
use App\Common\ResultException;

/**
 * 团队模块接口服务
 */
class Team extends Api {
    /**
     * 入参配置
     */
    public function getRules() {
        return array(
            'createTeam' => array(
                'token' => array('name' => 'token', 'require' => true, 'desc' => 'Token密匙'),
                'teamName' => array('name' => 'teamName', 'require' => true, 'desc' => '团队名称'),
                'detail' => array('name' => 'detail', 'require' => true, 'desc' => '团队说明'),
                'head' => array('name' => 'head', 'require' => true, 'desc' => '团队头像url'),
                'atlas' => array('name' => 'atlas', 'require' => true, 'desc' => '轮播图URL,以逗号分隔'),
                'cityCode' => array('name' => 'cityCode', 'require' => true, 'desc' => '团队城市code'),
                'longitude' => array('name' => 'longitude', 'require' => true, 'desc' => '经度'),
                'latitude' => array('name' => 'latitude', 'require' => true, 'desc' => '纬度'),
            ),
            'updateTeam' => array(
                'token' => array('name' => 'token', 'require' => true, 'desc' => 'Token密匙'),
                'teamId' => array('name' => 'teamId', 'require' => true, 'desc' => '团队ID'),
                'teamName' => array('name' => 'teamName', 'require' => true, 'desc' => '团队名称'),
                'detail' => array('name' => 'detail', 'require' => true, 'desc' => '团队说明'),
                'head' => array('name' => 'head', 'require' => true, 'desc' => '团队头像url'),
                'atlas' => array('name' => 'atlas', 'require' => true, 'desc' => '轮播图URL,以逗号分隔'),
                'cityCode' => array('name' => 'cityCode', 'require' => true, 'desc' => '团队城市code'),
                'longitude' => array('name' => 'longitude', 'require' => true, 'desc' => '经度'),
                'latitude' => array('name' => 'latitude', 'require' => true, 'desc' => '纬度'),
            ),
            'findTeam' => array(
                'teamId' => array('name' => 'teamId', 'require' => false, 'desc' => '团队ID'),
                'teamName' => array('name' => 'teamName', 'require' => false, 'desc' => '团队名称'),
                'cityCode' => array('name' => 'cityCode', 'require' => false, 'desc' => '团队城市code'),
                'longitude' => array('name' => 'longitude', 'require' => false, 'desc' => '经度'),
                'latitude' => array('name' => 'latitude', 'require' => false, 'desc' => '纬度'),
                'pageNum' => array('name' => 'pageNum', 'require' => false, 'default' => 1, 'desc' => '页码'),
                'pageSize' => array('name' => 'pageSize', 'require' => false, 'default' => 10, 'desc' => '每页条数'),
            ),
        );
    }

    /**
     * 创建团队
     * @desc 上传团队信息
     * @return String teamId 团队ID
     */
    public function createTeam() {
        //入参
        $token = $this->token;
        $teamName = $this->teamName;
        $detail = $this->detail;
        $head = $this->head;
        $atlas = $this->atlas;
        $cityCode = $this->cityCode;
        $longitude = $this->longitude;
        $latitude = $this->latitude;
        //验证token
        $userId = Token::checkToken($token);
        //暂定直接创建
        $teamDomain = new TeamDomain();
        $teamId = $teamDomain->addTeam($userId,$teamName,$detail,$head,$atlas,$cityCode,$longitude,$latitude);
        if(empty($teamId)){
            throw new ResultException('操作失败', 3);
        }
        return array(
            'teamId' => $teamId
        );
    }

    /**
     * 修改团队
     * @desc 更新团队信息
     * @return String teamId 团队ID
     */
    public function updateTeam() {
        //入参
        $token = $this->token;
        $teamId = $this->teamId;
        $teamName = $this->teamName;
        $detail = $this->detail;
        $head = $this->head;
        $atlas = $this->atlas;
        $cityCode = $this->cityCode;
        $longitude = $this->longitude;
        $latitude = $this->latitude;
        //验证token
        $userId = Token::checkToken($token);
        //更新
        $teamDomain = new TeamDomain();
        $teamDomain->updateTeam($userId,$teamName,$detail,$head,$atlas,$cityCode,$longitude,$latitude,$teamId);

        return array(
            'teamId' => $teamId
        );
    }

    /**
     * 查询团队
     * @desc 查询团队信息列表
     */
    public function findTeam() {
        //入参
        $teamId = $this->teamId;
        $teamName = $this->teamName;
        $cityCode = $this->cityCode;
        $longitude = $this->longitude;
        $latitude = $this->latitude;
        $pageNum = $this->pageNum;
        $pageSize = $this->pageSize;
        //查询
        $teamDomain = new TeamDomain();
        $teamList = $teamDomain->findTeam($teamId,$teamName,$cityCode,$longitude,$latitude,$pageNum,$pageSize);

        return $teamList;
    }
} 
