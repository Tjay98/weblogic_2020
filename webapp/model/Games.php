<?php
use ActiveRecord\Model;

class Games extends \ActiveRecord\Model {


    protected $dice1;
    protected $dice2;
    protected $totalDice;


    private $_numbersPlayed;
    private $_numbersBot;
    private $_playerPoints = 0;
    private $_botPoints = 0;
    private $_playerTurn = true;
    private $_dice;
    private $_win;


    public function __construct()
    {
       
    }
//numero aleatório do dado 1
    protected function dice1($dado1){
        $dado1 = rand(1,6);
        return $dado1;
    }

    //numero aleatório do dado 2
    protected function dice2($dado2){
        $dado2 = rand(1,6);
        return $dado2;
    }

  
//somar o valor do dado 1 e do dado 2
    protected function SumDice(){
        $totalDice = $dado1 + $dado2;
        return $totalDice;
    }

    //mudar o jogador
    public function changeCurrentPlayer() { //mudar o turno do jogador
        $this->_playerTurn = !$this->_playerTurn; //se era o bot a jogar passa a ser o jogador
    }

    //compara o valor do dados com as caixas
    public function CompareDiceBoxes()
    {
        for ($i = 0; $i < $_selectedNumbersArray; $i++) {
            $_sumSelectedNumbers += $_selectedNumbersArray[$i];
          }
          
		if ($_sumSelectedNumbers === 0) {
            rollTheDice();
          } else if ($_sumSelectedNumbers !== $totalDice) {
            incorrectPopup();
            $numDiv.removeClass("selected");
          } else {
            rollTheDice();
          }
    }
    
    //para saber se ganha
    public function WinGame()
    {
        if ($numbersPlayed === 9) {
            winGamePopup();
        } else {
            return;
        }

    }
    
      

    
}