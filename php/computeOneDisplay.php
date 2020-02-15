<?php

    include '../classes/Calculator.php';

    $oneDisplay = new OneDisplayCalculator($_POST['input']);

    try{
        $oneDisplay     ->checkDisplay();        
        echo $oneDisplay->oneDisplayJson($oneDisplay->calculate());   
    }catch (Exception $e){
        $oneDisplay     ->oneDisplayJson($e         ->getMessage());
    }

?>