<?php

namespace HenriqueBS0\LexicalAnalyzer;

use HenriqueBS0\DataStructures\Stack;

class TokenStack {
    private Stack $stack;

    public function push(Token $token) : void 
    {
        $this->stack->push($token);
    }

    public function pop() : Token 
    {
        return $this->stack->pop();
    }

    public function top() : Token 
    {
        return $this->stack->pop();
    }

    public function isEmpty(Token $token) : bool 
    {
        return $this->stack->isEmpty($token);
    }
}