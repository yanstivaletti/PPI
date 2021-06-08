<?php
     require_once "conexaoMysql.php";
    $pdo = mysqlConnect();
    $nome = $sexo = $email = $telefone = "";
    $cep = $logradouro = $cidade = $estado = $peso = $altura = $tipo_sanguineo =  "";
    
    if (isset($_POST["nome"])) $nome = $_POST["nome"];
    if (isset($_POST["sexo"])) $sexo = $_POST["sexo"];
    if (isset($_POST["email"])) $email = $_POST["email"];
    if (isset($_POST["telefone"])) $telefone = $_POST["telefone"];
    if (isset($_POST["cep"])) $cep = $_POST["cep"];
    if (isset($_POST["logradouro"])) $logradouro= $_POST["logradouro"];
    if (isset($_POST["cidade"])) $cidade = $_POST["cidade"];
    if (isset($_POST["estado"])) $estado = $_POST["estado"];
    if (isset($_POST["peso"])) $peso = $_POST["peso"];
    if (isset($_POST["altura"])) $altura= $_POST["altura"];
    if (isset($_POST["sangue"])) $tipo_sanguineo = $_POST["sangue"];
    
    
    
    
        $sql1 = <<<SQL
        INSERT INTO PESSOA (nome,sexo,email,telefone, 
                                cep,logradouro,cidade, estado)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?);
        SQL;
        
        $sql2 = <<<SQL
        INSERT INTO PACIENTE (peso,altura,tipo_sanguineo,codigo)
        VALUES (?,?,?,?)
        SQL;
        
        try {
             $pdo->beginTransaction();
  
            $stmt = $pdo->prepare($sql1);
            if(!$stmt->execute([$nome, $sexo, $email, $telefone,
            $cep, $logradouro, $cidade, $estado]))
            {
              throw new Exception('Falha na operação 1');
            }
          
            
            $ultimoIdInserido = $pdo->lastInsertId();

            $stmt2 = $pdo->prepare($sql2);
            if(!$stmt2->execute([$peso,$altura,$tipo_sanguineo,$ultimoIdInserido]))
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
            
    
?>