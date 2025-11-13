<?php 

require_once("config.php");

// Carrega somente um usuario.

// $root = new Usuario();
// $root->loadById(6);
// echo $root;


// Carrega uma lista de usuarios

// $lista = Usuario::getList();
// echo json_encode($lista);


// Carrega uma lista de usuarios listada pelo login

// $lista = Usuario::search("jose");
// echo json_encode($lista);


// Retorna um usuario, porem, somente se o LOGIN e a PASSWORD passados como...
// parametro forem corretos, se não, retornao uma mensagem de erro no login

$login = new Usuario();
$login->login("brunddo","senhateste");
echo $login;

// TESTE TESTE TESTE


?>