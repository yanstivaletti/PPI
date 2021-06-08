<?php
require "conexaoMysql.php";
$pdo = mysqlConnect();
## Requisição AJAX de Horarios


$data = $_GET['data'] ?? '';
$med = $_GET['med'] ?? '';
$horarios = [];

try {
  $sql2 = <<<SQL2
  SELECT Horário FROM AGENDA INNER JOIN MEDICO
  ON MEDICO.CODIGO = AGENDA.CodigoMedico
  WHERE _DATA = ?
  AND MEDICO.CODIGO = ?
  SQL2;
  $stmt2 = $pdo->prepare($sql2);
  $stmt2->execute([$data,$med]);
  while ($row = $stmt2->fetch()){
    $horario =  htmlspecialchars($row['Horário']);
    $horarios[] = $horario;
  }
  echo json_encode($horarios);
}catch(Exception $e){
  exit('Ocorreu uma falha na conexão com o BD: ' . $e->getMessage());
}
?>