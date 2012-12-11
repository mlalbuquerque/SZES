<?php

namespace Model\DAO;

class User extends Engine\Dao
{
    
    public function findAll(array $options = array())
    {
        $this->prepareSelectFrom();
        $assoc = $this->db->executeQuery($this->qb->getSQL())->fetchAll(\PDO::FETCH_ASSOC);
        return $this->entitiesFromArray($assoc);
    }

    public function findOne(array $options = array())
    {
        $this->prepareSelectFrom();
        $assoc = $this->db->executeQuery($this->qb->getSQL())->fetch(\PDO::FETCH_ASSOC);
        return ($assoc) ? $this->entityFromArray($assoc) : $assoc;
    }
    
    public function getTotal(array $options = array())
    {
        return size($this->findAll());
    }
    
    public function getTableName()
    {
        return 'Users';
    }
    
    public function getTableAlias()
    {
        return 'u';
    }
    
    public static function getColumns()
    {
        return array('name', 'email');
    }
    
}
