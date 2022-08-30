<?php

namespace HenriqueBS0\LexicalAnalyzer;

use HenriqueBS0\DataStructures\Stack;

class TokenStack {
    private Stack $stack;

    public function __construct()
    {
        $this->stack = new Stack();
    }

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

    public function isEmpty() : bool 
    {
        return $this->stack->isEmpty();
    }

    public function reverseOrdering() : self
    {

        $newStack = new Stack();

        while (!$this->stack->isEmpty()) {
            $newStack->push($this->stack->pop());
        }

        $this->stack = $newStack;

        return $this;
    }
}