<?php

namespace HenriqueBS0\LexicalAnalyzer;

class Position {
    private int $startLine;
    private int $endLine;
    private int $lineStartPosition;
    private int $lineEndPosition;
    private int $startPosition;
    private int $endPosition;

    public function __construct(int $startLine, int $endLine, int $lineStartPosition, int $lineEndPosition, int $startPosition, int $endPosition)
    {
        $this->startLine = $startLine;
        $this->endLine = $endLine;
        $this->lineStartPosition = $lineStartPosition;
        $this->lineEndPosition = $lineEndPosition;
        $this->startPosition = $startPosition;
        $this->endPosition = $endPosition;
    }

    public function getStartLine() : int
    {
        return $this->startLine;
    }

    public function getEndLine() : int
    {
        return $this->endLine;
    }

    public function getLineStartPosition() : int
    {
        return $this->lineStartPosition;
    }

    public function getLineEndPosition() : int
    {
        return $this->lineEndPosition;
    }

    public function getStartPosition() : int
    {
        return $this->startPosition;
    }

    public function getEndPosition() : int
    {
        return $this->endPosition;
    }

    public static function get(array $characteres, int $startPosition, int $endPosition) : self 
    {
        $startLine = 1;
        $endLine   = 1;
        $lineStartPosition = 1;
        $lineEndPosition = 1;

        $line         = 1;
        $linePosition = 1;

        for ($position=1; $position <= $endPosition; $position++) { 
            $character = $characteres[$position - 1];

            $isLineBreak = PHP_EOL === $character; 

            if($isLineBreak) {
                $line++;
            }

            if($position === $startPosition)  {
                $startLine         = $isLineBreak ? ($line - 1) : $line;
                $lineStartPosition = $linePosition;
            }

            if($position === $endPosition) {
                $endLine         = $line;
                $lineEndPosition = $linePosition;
            }

            if ($isLineBreak) {
                $linePosition = 0;
            }

            $linePosition++;
        }

        return new self($startLine, $endLine, $lineStartPosition, $lineEndPosition, $startPosition, $endPosition);
    }
}