<?php


    require "conexaoMysql.php";
    $pdo = mysqlConnect();

    if(isset($_POST["nome"])) $nome = $_POST["nome"];
    if(isset($_POST["sexo"]))$sexo = $_POST["sexo"];
    if(isset($_POST["email"]))$email = $_POST["email"];
    if(isset($_POST["telefone"]))$telefone = $_POST["telefone"];
    if(isset($_POST["cep"])) $cep = $_POST["cep"];
    if(isset($_POST["logradouro"]))$lugradouro = $_POST["logradouro"];
    if(isset($_POST["cidade"]))$cidade = $_POST["cidade"];
    if(isset($_POST["estado"]))$estado = $_POST["estado"];
    if(isset($_POST["peso"]))$peso = $_POST["peso"];
    if(isset($_POST["altura"]))$altura = $_POST["altura"];
    if(isset($_POST["ts"]))$ts = $_POST["ts"];
    try {
         $pdo->beginTransaction();

         $stmt = $pdo->prepare('INSERT INTO cadastro VALUES (?,?,?,?,?,?,?,?)');
         if(! $stmt->execute([$nome,$sexo,$email,$telefone,$cep,$logradouro,$cidade,$estado]))
                throw new Exception('Falha Na Operação 1');

         $stmt = $pdo->prepare('INSERT INTO paciente VALUES (?,?,?)');
            if(! $stmt->execute([$peso,$altura,$ts]))
                throw new Exception('Falha Na Operação 2');


        $pdo->commit();
        header("location: home.html");
        exit();
        
    }
    catch(Exception $e) {
      $pdo->rollBack();
      exit('Falha na transação ');
    }

?>