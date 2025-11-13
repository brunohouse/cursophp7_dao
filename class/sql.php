<?php

class Sql extends PDO{

    private $conn;

    public function __construct(){

        $this->conn = new PDO("mysql:host=localhost;dbname=dbphp7",
                                "root","");

    }

    private function setParams($statment, $parameters = array()){

        foreach ($parameters as $key => $value){
            $this->setParam($statment,$key, $value);
        }

    }

    private function setParam($statment, $key, $value){
        $statment->bindParam($key, $value);
    }

    // Funcao execQuery() prepara a variavel $smtm com todos os...
    // parametros e executa dentro do banco de dados, atraves...
    // da funcao execute()

    public function execQuery($rawQuery, $params = array()){
        $stmt = $this->conn->prepare($rawQuery);
          
        $this->setParams($stmt,$params);

        $stmt->execute();

        return $stmt;
        
    }

    public function select($rawQuery, $params = array()):array{
        $stmt = $this->execQuery($rawQuery, $params);  
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //retorna o array formatado   
    }

}
?>