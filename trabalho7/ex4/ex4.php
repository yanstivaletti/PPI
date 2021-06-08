<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

class Medico
{
  public $nome;
  public $tel;

  function __construct($nome,$tel)
  {
    $this->nome = $nome; 
    $this->tel = $tel;
  }
}

$esp = $_GET['esp'] ?? '';

$sql = <<<SQL
  SELECT nome_medico, telefone_medico
  FROM medico
  WHERE especialidade_medico = ?
  SQL;

$stmt = $pdo->prepare($sql);
$stmt->execute([$esp]);

$i = 0;
$medicos = array();
while ($row = $stmt->fetch()){
 $medicos[$i] = new Medico ($row['nome_medico'],$row['telefone_medico']);
 $i = $i+1;
}

echo json_encode($medicos);