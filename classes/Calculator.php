<?php
    class Calculator{

        //Properties of class calculator
        protected $firstNumber, $secondNumber, $operator, $result;

        //Methods of class calculator
        function __construct($firstNumber, $secondNumber, $operator){
            $this->firstNumber  = $firstNumber;
            $this->secondNumber = $secondNumber;
            $this->operator     = $operator;
        }

        function calculate(){

            if($this->firstNumber == NULL || $this->secondNumber == NULL){
                throw new Exception("Fields cannot be blank!");
            }else if(is_numeric($this->firstNumber) == FALSE || is_numeric($this->secondNumber) == FALSE){
                throw new Exception("Input should be numeric values only!");
            }else{
                switch ($this->operator){

                    case "+" :
                        $this->result = $this->firstNumber + $this->secondNumber;
                        return $this->result;         
                        break;
        
                    case "-" :
                        $this->result = $this->firstNumber - $this->secondNumber;                     
                        return $this->result;
                        break;
        
                    case "x" :
                        $this->result = $this->firstNumber * $this->secondNumber;                 
                        return $this->result;
                        break;
        
                    case "/" :
                        if($this->secondNumber == 0){
                            throw new Exception("Cannot Divide by 0!");
                        }else{
                            $this->result = $this->firstNumber / $this->secondNumber;
                            return $this->result;
                        }
                        break;
    
                }
            }
            
        }
        
        function createJson($result){

            if(isset($this->result) == TRUE){
                $object = array('Result' => $result, 'Status' => '', 'Alert' => "");
                echo json_encode($object);
            }else{
                $display = $this->firstNumber . $this->operator . $this->secondNumber;
                $object = array('Result' => $display, 'Status' => '<strong>Error:</strong> ' .$result, 'Alert' => "alert alert-danger");
                echo json_encode($object);
            }
        }

    }//end of class calculator

    class OneDisplayCalculator extends Calculator{

        //Properties of class onedisplaycalculator
        private $display;

        //Methods of class onedisplaycalculator
        function __construct($display){
            $this->display = $display;
        }

        function checkDisplay(){

            if($this->display == NULL){
                throw new Exception("Fields cannot be blank!");
            }else if($this->display[0] == "+" || $this->display[0] == "-" || $this->display[0] == "x" || $this->display[0] == "/"){
                throw new Exception("Syntax Error!");
            }else if($this->display[strlen($this->display)-1] == "+" || $this->display[strlen($this->display)-1] == "-" || 
                     $this->display[strlen($this->display)-1] == "x" || $this->display[strlen($this->display)-1] == "/"){
                throw new Exception("Syntax Error!");
            }

            $checkPlus    = strpos($this->display, "+");
            $checkMinus   = strpos($this->display, "-");
            $checkTimes   = strpos($this->display, "x");
            $checkDivide  = strpos($this->display, "/");
            
            if($checkPlus == FALSE && $checkTimes == FALSE && $checkMinus == FALSE && $checkDivide == FALSE){
                throw new Exception("Please select an operation!");
            }else{
                for($counter = 0; $counter < strlen($this->display); $counter++){
                    if($this->display[$counter] == "+" || $this->display[$counter] == "-" || 
                       $this->display[$counter] == "x" || $this->display[$counter] == "/" ){
                        $operators[] = $this->display;
                    }
                }
            }

            if(count($operators) > 1){
                throw new Exception("Please select only one operator!");
            }
            
            if($checkPlus > 0){
                $operation = $this->display[$checkPlus];
            }else if($checkMinus > 0){
                $operation = $this->display[$checkMinus];                
            }else if($checkTimes > 0){
                $operation = $this->display[$checkTimes];                
            }else if($checkDivide > 0){
                $operation = $this->display[$checkDivide];                
            } 

            $values = explode($operation, $this->display);

            $this->firstNumber  = $values[0];
            $this->secondNumber = $values[1];
            $this->operator     = $operation;

        }
        
        function oneDisplayJson($result){
            
            if(isset($this->result) == TRUE){
                $object = array('Result' => $result, 'Status' => '', 'Alert' => "");
                echo json_encode($object);
            }else{
                $object = array('Result' => $this->display, 'Status' => '<strong>Error:</strong> ' .$result, 'Alert' => "alert alert-danger");
                echo json_encode($object);
            }

        }
    
    }//end of class calculator

?>