<!doctype html>
<html>
<head>
	<title>ex1</title>
	<meta name = "viewport" content = "width = devide-widthz, initial-scale = 1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
<main>
<?php

    require "conexaoMysql.php";
    $pdo = mysqlConnect();

    if(isset($_POST["cep"])) $cep = $_POST["cep"];
    if(isset($_POST["lugradouro"]))$lugradouro = $_POST["lugradouro"];
    if(isset($_POST["bairro"]))$bairro = $_POST["bairro"];
    if(isset($_POST["cidade"]))$cidade = $_POST["cidade"];
    if(isset($_POST["estado"]))$estado = $_POST["estado"];
    try {
         $sql = <<<SQL

         INSERT INTO exercicio2 (cep,lugradouro,bairro,cidade,estado)
         VALUES (?,?,?,?,?)
         SQL;

         $stmt = $pdo->prepare($sql);
         $stmt->execute([
             $cep,$lugradouro,$bairro,$cidade,$estado
         ]);
         header("location: novapagina.php");
         exit();
    }
    catch(Exception $e) {
        if($e->errorInfo[1]==1062)
            exit('Dados Duplicados' . $e->getMessage());
        else
            exit('Falaha ao cadastrar os dados' . $e->getMessage());
    }

               
?>
</main>
</body>
</html>