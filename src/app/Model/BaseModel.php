<?php
namespace App\Model;

use App\Common\ResultException;
use PhalApi\Model\NotORMModel as NotORM;

class BaseModel extends NotORM {

    protected function getTableName($id) {
        return '';
    }

    public function add($data) {
        $orm = $this->getORM();
        $orm->insert($data);
        return $orm->insert_id();
    }

    public function find($where) {
        return $this->getORM()
            ->select('*')
            ->where($where)
            ->fetchOne();
    }

    public function findList($where,$pageNum,$pageSize) {
        return $this->getORM()
            ->select('*')
            ->where($where)
            ->limit($pageSize,($pageNum-1)*$pageSize)
            ->fetchAll();
    }

    public function updateByWhere($where,$update) {
        $line = $this->getORM()
            ->where($where)
            ->update($update);
        if($line === false){
            throw new ResultException('操作失败', 3);
        }
        return $line;
    }

    public function deleteByWhere($where) {
        $line = $this->getORM()
            ->where($where)
            ->delete();
        if($line <= 0){
            throw new ResultException('操作失败', 3);
        }
        return $line;
    }
}