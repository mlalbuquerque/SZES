<?php

namespace BO\Engine;

class Bo
{
    
    protected $dao_loader, $dao, $labels;

    public function __construct(\Model\DAO\Engine\DaoLoader $dao)
    {
        $this->dao_loader = $dao;
        $this->dao = $this->dao_loader[get_called_class()];
        $this->labels = array();
        $cols = $this->dao->getColumns();
        foreach ($cols as $col)
            $this->labels[$col] = \Util\Text::generateLabel($col);
    }
    
    public function getColLabels(array $only_these_cols = array()) {
        if (!empty($only_these_cols))
        {
            $cols = array();
            foreach ($only_these_cols as $col)
                $cols[$col] = $this->labels[$col];
            
            return $cols;
        }
        return $this->labels;
    }
    
    public function getColLabel($col)
    {
        return $this->labels[$col];
    }
    
    public function setColLabels(array $labels)
    {
        foreach ($labels as $col => $value)
            $this->setColLabel($col, $value);
    }
    
    public function setColLabel($col, $value)
    {
        if (array_key_exists($col, $this->labels))
            $this->labels[$col] = $value;
    }
    
    public function getEmptyFields(\Model\Entity $object, $excluded_fields = array(), $separator = ', ')
    {
        $cols = $this->getColLabels();
        $attrs = get_object_vars($object);
        $fields = array();
        foreach ($attrs as $attr => $value)
            if (array_key_exists($attr, $cols) && empty($value) && !in_array($attr, $excluded_fields))
                array_push($fields, $cols[$attr]);
            
        return implode($separator, $fields);
    }
    
}