<?php

namespace App;

use Iterator;
use FilterIterator;

class PhoneFilter extends FilterIterator
{
    private $_patterns;
    
    public function __construct(Iterator $iterator,$patterns=null)
    {
        parent::__construct($iterator);

        $this->_patterns=is_null($patterns) ? [
                '/\+?([0-9]{3})-?([0-9]{3})-?([0-9]{3})/',
            ] : $patterns;
    }

    public function accept()
    {
        foreach($this->_patterns as $pattern) {
            if(preg_match($pattern,$this->current()['message_text'])) {
                return true;
            }
        }

        return false;
    }
}

