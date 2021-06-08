<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();


$cep = $_GET['cep'] ?? '';

$sql = <<<SQL
  SELECT rua, bairro, cidade
  FROM endereco
  WHERE cep = ?
  SQL;

$stmt = $pdo->prepare($sql);
$stmt->execute([$cep]);

$row = $stmt->fetch();

$rua = $row['rua'];
$bairro = $row['bairro'];
$cidade = $row['cidade'];

class Endereco
{
  public $rua;
  public $bairro;
  public $cidade;

  function __construct($rua, $bairro, $cidade)
  {
    $this->rua = $rua;
    $this->bairro = $bairro; 
    $this->cidade = $cidade;
  }
}

$endereco1 = new Endereco( $rua, $bairro, $cidade);

$enderecos = array(
  $cep => $endereco1
);

  
$endereco = array_key_exists($cep, $enderecos) ? 
  $enderecos[$cep] : new Endereco('', '', '');
  
echo json_encode($endereco);