<?php

namespace Galoa\ExerciciosPhp\TextWrap;

/**
 * Implemente sua resolução aqui.
 */
class Resolucao implements TextWrapInterface {
  /**
   * {@inheritdoc}
   */
    public function textWrap(string $text, int $length): array {

    $ret = array();
    $retIndex = 0;
    $retLenght = 0;
    $tokenStart = 0;
    $tokenEnd = 0;
    $wordLength = 0;
    $toInsert = "";
    $nextWord = "";
    $insertBiggerWord = false;

    // Percorre todo o vetor de entrada
    while (isset($text[$tokenStart])) {
        
        // Pega a próxima palavra do texto, seu tamanho e avança a posição do token final
        $nextWord = $this->getNextWord($text, $tokenStart);
        $wordLength= strlen($nextWord);
        $tokenEnd += $wordLength;
        $tokenEnd++;
        
        // Se o comprimento da palavra foi maior que o comprimento permitido
        if ($wordLength >= $length) {
            // Caso ainda não esteja preparado para inserir a palavra
            if ($insertBiggerWord == false) {
                // Insere no vetor o que já estava guardado no buffer
                array_push($ret, $toInsert);
                $toInsert = ""; $retLenght = 0; $retIndex++;
                // Prepara para a inserção da palavra maior, fazendo com que ela seja relida
                $tokenEnd = $tokenStart;
                $insertBiggerWord = true;
            }
            // Caso a etapa de preparação acima já houver sido concluída
            else {
                // Insere o trecho da palavra no vetor
                $tokenEnd = $tokenEnd - ($wordLength-$length)-1;
                $toInsert .= $this->getSubstring($text, $tokenStart, $tokenEnd);
                array_push($ret, $toInsert);
                $toInsert = ""; $retLenght = 0; $retIndex++;
                $insertBiggerWord = false;
            }
        }
        
        // Caso a palavra caiba na linha atual do vetor
        elseif ($retLenght+$wordLength-1 < $length) {
            // Adiciona a palavra ao buffer de inserção
            $retLenght += $wordLength;
            $retLenght++;
            $toInsert .= $this->getSubstring ($text, $tokenStart, $tokenEnd);
        }
        
        // Caso não seja possível inserir a nova palavra naquela linha
        else {
            /* Insere no vetor o que estava no buffer e ajusta as variveis para que a leitura da palavra seja refeita */
            array_push($ret, $toInsert);
            $toInsert = ""; $retLenght = 0; $retIndex++;
            $tokenEnd = $tokenStart;
        }
        
        // Inserção do trecho concluído, avança o token inicial
        $tokenStart = $tokenEnd;
    }
    // Insere no vetor o que restou no buffer
    array_push($ret, $toInsert);
    $retIndex++;
    // Remove as linhas que são vazias ou espaços em branco
    $ret = $this->removeBlankLine ($ret, $retIndex);
    $ret = array_values($ret);

    // Caso a string de entrada for vazia, o vetor retornado deve ser vazio
    if (empty($ret[0])) {
         return [""];
    }

    return $ret;
    }
    
    /*
    Desc: Retorna uma substring, dada uma string pai e os indices inicial e final.
    Param: Texto, indice inicial para copiar, indice final para copiar. 
    Retorno: Substring composta pelo texto entre os indices .
    */
    private function getSubstring (string $txt, int $start, int $end) {
        $str = "";
        for ($j = $start; isset($txt[$j]) && $j < $end; $j++) {
            $str .= $txt[$j]; 
        }
        return $str;
    }
    
    /*
    Desc: Dado um texto e o índice inicial, retorna a próxima palavra.
    Param: Texto, indice inicial. 
    Retorno: Substring composta pela próxima palavra do texto a partir do índice inicial.
    */
    private function getNextWord (string $txt, int $start) {
        $end = $start;
        while(isset($txt[$end]) && $txt[$end] != " ") {
            $end++;    
        }
        return $this->getSubstring ($txt, $start, $end);
    }

    /*
    Desc: Dado um vetor de Strings, remove todos elementos vazios.
    Param: Texto, tamanho do vetor. 
    Retorno: Novo vetor sem os elementos vazios.
    */
    private function removeBlankLine (array $vet, int $size):array {
        for ($i = 0; $i < $size; $i++) {
            if (empty($vet[$i]) || $vet[$i] == " ") {
                unset($vet[$i]);
            } else {
	    	$vet[$i] = trim($vet[$i]);
            }
        }
        return $vet;
    }
}
