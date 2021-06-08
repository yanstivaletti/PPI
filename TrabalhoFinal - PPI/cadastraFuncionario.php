<?php
 require_once "conexaoMysql.php";
$pdo = mysqlConnect();
$nome = $sexo = $email = $telefone = "";
$cep = $logradouro = $cidade = $estado = $dataIni = $dataFim = $especialidade = $crm =  "";

if (isset($_POST["nome"])) $nome = $_POST["nome"];
if (isset($_POST["sexo"])) $sexo = $_POST["sexo"];
if (isset($_POST["email"])) $email = $_POST["email"];
if (isset($_POST["telefone"])) $telefone = $_POST["telefone"];
if (isset($_POST["cep"])) $cep = $_POST["cep"];
if (isset($_POST["logradouro"])) $logradouro= $_POST["logradouro"];
if (isset($_POST["cidade"])) $cidade = $_POST["cidade"];
if (isset($_POST["estado"])) $estado = $_POST["estado"];
if (isset($_POST["dataIni"])) $dataIni = $_POST["dataIni"];
if (isset($_POST["dataFim"])) $dataFim = $_POST["dataFim"];
if (isset($_POST["esp"])) $especialidade = $_POST["esp"];
if (isset($_POST["crm"])) $crm = $_POST["crm"];
if (isset($_POST["senha"])) $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);
if (isset($_POST["salario"])) $salario = $_POST["salario"];

if ($crm == ''){

  $sql = <<<SQL
  INSERT INTO PESSOA (nome,sexo,email,telefone, 
                        cep,logradouro,cidade, estado)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?);
  SQL;

  $sql2 = <<<SQL
  INSERT INTO FUNCIONARIO (DataContrato,Salario,SenhaHash,Codigo)
    VALUES (?,?,?,?);
  SQL;

  try {
    $pdo->beginTransaction();
  
    $stmt = $pdo->prepare($sql);
    if(!$stmt->execute([$nome, $sexo, $email, $telefone,
    $cep, $logradouro, $cidade, $estado]))
    {
      throw new Exception('Falha na operação 1');
    }
  
    $ultimoIdInserido = $pdo->lastInsertId();
  
    $stmt2 = $pdo->prepare($sql2);
    if(!$stmt2->execute([$dataIni,$salario,$senha,$ultimoIdInserido]))
    {
      throw new Exception('Falha na operação 2');
    }
    $pdo->commit();
    header("Location: restrict.php");
    }
    catch (Exception $e) {
      $pdo->rollback();
      exit('Falha inesperada: ' . $e->getMessage());
    }
########

}else{
    
    $sql1 = <<<SQL
    INSERT INTO PESSOA (nome,sexo,email,telefone, 
                        cep,logradouro,cidade, estado)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?);
    SQL;

    $sql2 = <<<SQL
    INSERT INTO FUNCIONARIO (DataContrato,Salario,SenhaHash,Codigo)
    VALUES (?,?,?,?);
    SQL;

    $sql3 = <<<SQL
    INSERT INTO MEDICO (CRM,ESPECIALIDADE,CODIGO)
    VALUES (?,?,?);
    SQL;

    try {
        $pdo->beginTransaction();
      
        $stmt1 = $pdo->prepare($sql1);
        if(!$stmt1->execute([$nome, $sexo, $email, $telefone,
        $cep, $logradouro, $cidade, $estado]))
        {
          throw new Exception('Falha na operação 1');
        }

        $ultimoIdInserido = $pdo->lastInsertId();

        $stmt2 = $pdo->prepare($sql2);
        if(!$stmt2->execute([$dataIni,$salario,$senha,$ultimoIdInserido]))
        {
          throw new Exception('Falha na operação 2');
        }
        $ultimoIdInserido = $pdo->lastInsertId();

        $stmt3 = $pdo->prepare($sql3);
        if(!$stmt3->execute([$crm,$especialidade,$ultimoIdInserido]))
        {
          throw new Exception('Falha na operação 3');
        }
        $pdo->commit();
        header("Location: restrict.php");
        }
        catch (Exception $e) {
          $pdo->rollback();
          exit('Falha inesperada: ' . $e->getMessage());
        }


}
?>
