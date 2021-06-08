<?php

require_once "conexaoMysql.php";
require "autenticacao.php";
session_start();
$pdo = mysqlConnect();

class RequestResponse
{
  public $success;
  public $detail;

  function __construct($success, $detail)
  {
    $this->success = $success;
    $this->detail = $detail;
  }
}

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';


if (!empty($senhaHash = checkPassword($pdo, $email, $senha))) {

  $_SESSION['emailUsuario'] = $email;
  $_SESSION['loginString'] = hash('sha512', $senhaHash . $_SERVER['HTTP_USER_AGENT']); 
  $response = new RequestResponse(true, 'restrict.php');
} 
else
  $response = new RequestResponse(false, ''); 

echo json_encode($response);