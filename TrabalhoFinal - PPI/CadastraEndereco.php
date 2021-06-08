<?php
require "conexaoMysql.php";
$pdo = mysqlConnect();

if (isset($_POST["cep"])) $cep = $_POST["cep"];
if (isset($_POST["cidade"])) $cidade = $_POST["cidade"];
if (isset($_POST["estado"])) $estado = $_POST["estado"];
if (isset($_POST["logradouro"])) $logradouro = $_POST["logradouro"];

### CADASTRO DE ENDEREÇO 
   
  $sql = <<<SQL
    INSERT INTO ENDERECO (CEP,Cidade,Estado,Logradouro)
    VALUES (?,?,?,?)
    SQL;
  
  try {
       $pdo->beginTransaction();

      $stmt = $pdo->prepare($sql);
      if(!$stmt->execute([$cep, $logradouro, $cidade, $estado]))
      {
        throw new Exception('Falha na operação 1');
      }
                            
      $pdo->commit();
      header("Location: index.html");
      }
      catch (Exception $e) {
        $pdo->rollback();
        exit('Falha inesperada: ' . $e->getMessage());
      }
?>