<?php

class Usuario{

    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

// GETTER E SETTERS

    public function getIdusuario(){
        return $this->idusuario;
    }

    public function setIdusuario($value){
        $this->idusuario = $value;   
    }

    public function getDeslogin(){
        return $this->deslogin;
    }

    public function setDeslogin($value){
        $this->deslogin = $value;   
    }

    public function getDessenha(){
        return $this->dessenha;
    }

    public function setDessenha($value){
        $this->dessenha = $value;   
    }

    public function getDtcadastro(){
        return $this->dtcadastro;
    }

    public function setDtcadastro($value){
        $this->dtcadastro = $value;   
    }

##################################################################################

    // Funcao retorna um usuario pelo ID.
    // Funcao select() usada para enviar a linha de codigo e os...
    // parameros para o banco de dados atraves da classe Sql().


    public function loadById($id){

        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_usuarios
                                WHERE idusuario = :ID",
                                array(":ID"=>$id));

        if(count($result) > 0 ){

                $row = $result[0];

                $this->setIdusuario($row['idusuario']);
                $this->setDeslogin($row['deslogin']);
                $this->setDessenha($row['dessenha']);
                $this->setDtcadastro(new DateTime($row['dtcadastro']));

        }
        
    }

    // Quando for solicitado a classe GET, ira retornar um ARRAY...
    // formatado em json, usando a funcao json_encode.

    public function __toString(){
        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
        ));
    }
    
    // Retorna uma lista de usuarios

    public static function getList(){

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");

    }


    // Retorna uma lista de usuarios pesquisando pelo login
    public static function search($login){

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH
                ORDER BY deslogin", array(':SEARCH'=>"%".$login."%"));
        
    }

    // Retorna um usuario, porem, somente se o LOGIN e a PASSWORD passados como...
    // parametro forem corretos, se não, retornao uma mensagem de erro no login

    public function login($login, $password){

        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN
                                and dessenha = :PASSWORD",
                                array(":LOGIN"=>$login,
                                    ":PASSWORD"=>$password));

        if(count($result) > 0 ){

                $row = $result[0];

                $this->setIdusuario($row['idusuario']);
                $this->setDeslogin($row['deslogin']);
                $this->setDessenha($row['dessenha']);
                $this->setDtcadastro(new DateTime($row['dtcadastro']));

        }else{

            throw new Exception("Login ou senha inválidos."); 

        }


    }
    


}