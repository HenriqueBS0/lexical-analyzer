<?php

use HenriqueBS0\LexicalAnalyzer\LexicalAnalyzer;

require_once __DIR__ . '/vendor/autoload.php';

function teste() {
    try {
        throw new Exception('Teste');
        $bErro = false;
    } catch(Exception $ex) {
        $bErro = true;
        throw $ex;
    }
    finally {
        
    }
}

try {
    $retorno = teste();
}
catch(Exception $ex) {
    echo $ex->getMessage();
}
finally {
    echo $retorno;
}