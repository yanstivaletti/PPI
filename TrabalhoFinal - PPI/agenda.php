<?php

require_once "conexaoMysql.php";
$pdo = mysqlConnect();

$esp = $medico = $data = $hora = $nome = $sexo = $email = "";

                            
if (isset($_POST["esp"])) $esp = $_POST["esp"];
if (isset($_POST["medicos"])) $medico = $_POST["medicos"];
if (isset($_POST["data"])) $data= $_POST["data"];
if (isset($_POST["hora"])) $hora = $_POST["hora"];
if (isset($_POST["nome"])) $nome = $_POST["nome"];
if (isset($_POST["sexo"])) $sexo= $_POST["sexo"];
if (isset($_POST["email"])) $email = $_POST["email"];



$sql = <<<SQL
    INSERT INTO AGENDA (Horário,_DATA,CodigoMedico,Nome,Sexo,Email)
    VALUES (?,?,?,?,?,?)
    SQL;    

try {
   $pdo->beginTransaction();

  $stmt = $pdo->prepare($sql);
  if(!$stmt->execute([$hora,$data,$medico,$nome,$sexo,$email]))
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