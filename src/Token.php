<?php

namespace HenriqueBS0\LexicalAnalyzer;

class Token {
    private string $token;
    private string $lexeme;
    private Position $position;

    public function __construct(string $token, string $lexeme, Position $position)
    {
        $this->token = $token;
        $this->lexeme = $lexeme;
        $this->position = $position;
    }

    public function getToken() : string
    {
        return $this->token;
    }

    public function getLexeme() : string
    {
        return $this->lexeme;
    }

    public function getPosition() : Position
    {
        return $this->position;
    }
}