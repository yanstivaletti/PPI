<?php
require "conexaoMysql.php";
$pdo = mysqlConnect();
##Requisição AJAX de medicos de determinada especialidade
class Medico
{
  
  public $nome;
  public $codigo;

  function __construct($nome,$codigo)
  {
    $this->nome = $nome;
    $this->codigo = $codigo;
  }
}

$esp = $_GET['esp'] ?? '';

try {
  $sql2 = <<<SQL
  SELECT NOME, MEDICO.CODIGO FROM MEDICO
  INNER JOIN PESSOA
  ON PESSOA.codigo = MEDICO.CODIGO
  WHERE MEDICO.ESPECIALIDADE = ?
  SQL;## Mostraremos o Nome dos medicos

  $stmt = $pdo->prepare($sql2);
  $stmt->execute([$esp]);

  while ($row = $stmt->fetch()){
    $medicos[] = new Medico($row['NOME'],$row['CODIGO']);
  }
  echo json_encode($medicos);

}catch(Exception $e){
  exit('Ocorreu uma falha na conexão com o BD: ' . $e->getMessage());
}

?>