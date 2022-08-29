<?php

namespace HenriqueBS0\LexicalAnalyzer;

use Exception;

class LexicalAnalyzerException extends Exception {

    private Position $position;
    private TokenStack $tokens;

    public function __construct(Position $position, TokenStack $tokens, string $message = '', int $code = 0)
    {
        parent::__construct($message, $code);
        $this->position = $position;
        $this->tokens = $tokens;
    }

    public function getPosition() : Position
    {
        return $this->position;
    }

    public function getTokens() : TokenStack 
    {
        return $this->tokens;
    }
}