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
                // '/\+?([0-9]{3})-?([0-9]{3})-?([0-9]{3})/',
                '/[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*/',
                // 10 Digit North American Number with +1
                '/(?:\+?1[-. ]?)?\(?([2-9][0-8][0-9])\)?[-. ]?([2-9][0-9]{2})[-. ]?([0-9]{4})/',
                '/[Pp]hone',
                // '/phone/'
            ] : $patterns;
    }

    public function accept()
    {
        if (!$this->getInnerIterator()->valid()) {
            return false;
        }

        foreach($this->_patterns as $pattern) {
            $message=$this->getInnerIterator()->current();
            // if(preg_match($pattern,$message->message_text) and $message->infected_flag===0) {
            if(preg_match($pattern,$message->message_text)) {
                return true;
            }
        }

        return false;
    }
}

