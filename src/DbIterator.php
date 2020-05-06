<?php

namespace App;

use Iterator;
use PDO;
use PDOStatement;

class DbIterator implements Iterator
{
    private $_pdo_statement;
    private $_key;
    private $_result;
    private $_valid;

    public function __construct(PDOStatement $pdo_statement)
    {
        $this->_pdo_statement=$pdo_statement;

        $this->_result=$this->_pdo_statement->fetch(
            PDO::FETCH_OBJ, 
            PDO::FETCH_ORI_ABS, 
            $this->_key
        );

        $this->_valid=$this->_result===false ? false : true;
    }

    public function current()
    {
        return $this->_result;
    }

    public function next()
    {
        $this->_key++;

        $this->_result=$this->_pdo_statement->fetch(
            PDO::FETCH_OBJ, 
            PDO::FETCH_ORI_ABS, 
            $this->_key
        );

        if (false===$this->_result) {
            $this->_valid=false;
            return null;
        }        
    }

    public function key()
    {
        return $this->_key;
    }

    public function valid()
    {
        return $this->_valid;
    }

    public function rewind()
    {
        $this->_key=0;
    }
}
