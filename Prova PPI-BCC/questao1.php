<?php 


require "conexaoMysql.php";
$pdo = mysqlConnect();

if (isset($_POST["tipo_veiculo"])) $tipo_veiculo = $_POST["tipo_veiculo"];
if (isset($_POST["marca_veiculo"])) $marca_veiculo = $_POST["marca_veiculo"];
if (isset($_POST["modelo_veiculo"])) $modelo_veiculo = $_POST["modelo_veiculo"];
if (isset($_POST["valor_multa"])) $valor_multa = $_POST["valor_multa"];
if (isset($_POST["descricao_infracao"])) $descricao_infracao = $_POST["descricao_infracao"];

### CADASTRO DE ENDEREÇO 
$sql_veiculo = <<<SQL
  INSERT INTO veiculo (tipo,marca,modelo)
  VALUES (?, ? ,?);
  SQL;

$sql_veiculo_multa = <<<SQL
  INSERT INTO veiculo_multa (valor,descricao,id_veiculo)
  VALUES (?, ? ,?);
  SQL;
  try{
    $pdo->beginTransaction();

    $stmt_veiculo = $pdo->prepare($sql_veiculo);
    if(! $stmt_veiculo->execute([$tipo_veiculo,$marca_veiculo,$modelo_veiculo])){
           throw new Exception('Falha Na Operação 1');}

    $stmt_veiculo_multa = $pdo->prepare($sql_veiculo_multa);
       if(! $stmt_veiculo_multa->execute([$valor_multa,$descricao_infracao]))
           throw new Exception('Falha Na Operação 2');


   $pdo->commit();
   header("location: questao1.html");
   exit();
   
}catch (Exception $e) {  
    if ($e->errorInfo[1] === 1062)
      exit('Dados duplicados: ' . $e->getMessage());
    else
      exit('Falha ao cadastrar os dados: ' . $e->getMessage());

}

?>