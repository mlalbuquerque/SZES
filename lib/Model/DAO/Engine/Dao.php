<?php

namespace Model\DAO\Engine;

abstract class Dao
{
    
    protected $db, $qb;

    public function __construct(\Doctrine\DBAL\Connection $db)
    {
        $this->db = $db;
        $this->qb = $db->createQueryBuilder();
    }
    
    abstract public function findAll(array $options = array());
    abstract public function findOne(array $options = array());
    abstract public function getTotal(array $options = array());
    abstract public static function getColumns();
    abstract public function getTableName();
    abstract public function getTableAlias();
    
    protected function getColumn($index)
    {
        $cols = static::getColumns();
        $col = (array_key_exists($index, $cols)) ? $cols[$index] : $index;
        return $col;
    }
    
    protected static function getSelectColumns($prefix = null)
    {
        $cols = (!empty($prefix)) ? array_map(function ($value) use ($prefix) {
            return $prefix.'.'.$value;
        }, static::getColumns()) : static::getColumns();
        return implode(', ', $cols);
    }
    
    protected function prepareSelectFrom()
    {
        $this->qb->resetQueryParts();
        $this->qb->select(self::getSelectColumns())
             ->from($this->getTableName(), $this->getTableAlias());
    }
    
    protected function entityFromArray(array $values)
    {
        $object = false;
        if (!empty($values))
        {
            $class = '\\Model\\'.\Util\Text::classNameOnly(get_called_class());
            $object = new $class();
            $object->fromArray($values);
        }
        return $object;
    }
    
    protected function entitiesFromArray(array $list)
    {
        $objList = array();
        foreach ($list as $values)
            $objList[] = $this->entityFromArray($values);
        
        return $objList;
    }
    
}
