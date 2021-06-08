<?php
require "conexaoMysql.php";
$pdo = mysqlConnect();

$cep = $_GET['cep'] ?? '';

class Endereco
{
  public $logradouro;
  public $cidade;
  public $estado;

  function __construct($logradouro,$cidade,$estado)
  {
    $this->logradouro = $logradouro;
    $this->cidade = $cidade; 
    $this->cidade = $estado;
  }
}

### CADASTRO DE ENDEREÇO 
try {
$sql = <<<SQL
  SELECT Logradouro, Cidade, Estado
  FROM ENDERECO
  WHERE CEP = ?
  SQL;

$stmt = $pdo->prepare($sql);
$stmt->execute([$cep]);

while ($row = $stmt->fetch()) {

$logradouro= $row['Logradouro'];
$cidade = $row['Cidade'];
$estado = $row['Estado'];
}


$endereco = new Endereco( $logradouro, $cidade, $estado);

  
echo json_encode($endereco);
}catch(Exception $e){
  exit('Ocorreu uma falha na conexão com o BD: ' . $e->getMessage());
}
########################################
?>