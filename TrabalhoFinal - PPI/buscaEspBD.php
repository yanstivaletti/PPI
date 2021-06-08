<?php
require_once "conexaoMysql.php";
$pdo = mysqlConnect();

#### AGENDAMENTO DE CONSULTA
## Requisição AJAX especialidades
class Especialidade
{
  public $especialidade;
 
  function __construct($especialidade)
  {
    $this->especialidade = $especialidade;
  }
}
try {
  $sql = <<<SQL
  SELECT DISTINCT ESPECIALIDADE FROM MEDICO
  SQL;
  $stmt = $pdo->prepare($sql);
  $stmt->execute([]);
  while ($row = $stmt->fetch()){
    $especialidade = $row['ESPECIALIDADE'];
    $especialidades[] = new Especialidade($especialidade);
  }
  echo json_encode($especialidades);
}catch(Exception $e){
  exit('Ocorreu uma falha na conexão com o BD: ' . $e->getMessage());
}
?>