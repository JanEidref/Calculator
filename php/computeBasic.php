<?php

    include '../classes/Calculator.php';

    $calculator = new Calculator($_POST['firstNumber'], $_POST['secondNumber'], $_POST['operation']);
    
    try{
        $calculator->createJson($calculator->calculate());
    }catch (Exception $e){
        $calculator->createJson($e         ->getMessage());
    }
        
?>