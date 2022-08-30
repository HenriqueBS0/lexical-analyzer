<?php

namespace HenriqueBS0\LexicalAnalyzer;

use HenriqueBS0\Automaton\Automaton;
use HenriqueBS0\Automaton\AutomatonException;

class LexicalAnalyzer {
    private Automaton $automaton;

    public function __construct(Automaton $automaton)
    {
        $this->automaton = $automaton;
    }

    private function getAutomaton() : Automaton 
    {
        return $this->automaton;
    }

    public function getTokens(string $input) : TokenStack 
    {
        $tokens = new TokenStack();

        $characteres = str_split($input);

        $startReadingPosition = 1;
        $readPosition         = 1;
        $endReadingPosition   = count($characteres);

        $token = null;

        while($readPosition <= $endReadingPosition) {
            $partInput = self::getPartInput($characteres, $startReadingPosition, $readPosition);

            $position = Position::get($characteres, $startReadingPosition, $readPosition);

            $isLastCharacter = $readPosition === $endReadingPosition;

            try {
                $finalState = $this->getAutomaton()->getFinalState($partInput); 
                $token = new Token($finalState, $partInput, $position);

                if($isLastCharacter) {
                    $tokens->push($token);
                }

                $readPosition++;
            }
            catch(AutomatonException $ex) {
                $lastStateIsNotFinal  = $ex->getCode() === AutomatonException::CODE_LAST_STATE_IS_NOT_FINAL;                
                $noValidToken         = is_null($token);

                $throw = $noValidToken && (!$lastStateIsNotFinal || $isLastCharacter);

                if($throw) {
                    throw new LexicalAnalyzerException($position, $tokens->reverseOrdering(), $ex->getMessage());
                }

                if($lastStateIsNotFinal) {
                    $readPosition++;
                }
                else {
                    $tokens->push($token);                    
                    $startReadingPosition = $token->getPosition()->getEndPosition() + 1;
                    $readPosition = $token->getPosition()->getEndPosition() + 1;
                    $token = null;
                }
            }
        }

        return $tokens->reverseOrdering();
    }

    private static function getPartInput(array $characteres, int $startPostion, int $endPosition) {
        return implode(array_splice($characteres, ($startPostion - 1), (($endPosition + 1) - $startPostion)));
    }
}