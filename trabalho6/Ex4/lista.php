<?php 
require "conexaoMysql.php";
$pdo = mysqlConnect();

try {
    $sql = <<<SQL 
    SELECT * FROM cadastro
    INNER JOIN paciente
    ON cadastro.id = paciente.id;
    SQL;

    $stmt = $pdo->query($sql);

}
catch (Exception $e) {
    exit('Ocorreu uma falha: '. $e->getMessage());
}

?>
<!doctype html>
<html>
<head>
<title>ex1</title>
<meta name = "viewport" content = "width = devide-widthz, initial-scale = 1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
<main>

<div class = "container">
<table class = "table table-striped table-hover">
    <?php
    
    while($row = $stmt->fetch()){

        $id = $pdo->lastInsertId();
        $nome = htmlspecialchars($row['nome']);
        $sexo = htmlspecialchars($row['sexo']);
        $email = htmlspecialchars($row['email']);
        $telefone = htmlspecialchars($row['telefone']);

        $cep = htmlspecialchars($row['cep']);
        $lugradouro = htmlspecialchars($row['logradouro']);
        $cidade = htmlspecialchars($row['cidade']);
        $estado = htmlspecialchars($row['estado']);

        $peso = htmlspecialchars($row['peso']);
        $altura = htmlspecialchars($row['altura']);
        $ts = htmlspecialchars($row['ts']);
    

    echo <<<HTML
        <tr>
        <td> $id </td>
        <td> $nome </td>
        <td> $sexo </td>
        <td> $email </td>
        <td> $telefone </td>
        <td> $cep </td>
        <td> $lugradouro </td>
        <td> $cidade </td>
        <td> $estado </td>
        <td> $peso </td>
        <td> $altura</td>
        <td> $ts</td>

        </tr>
    
    HTML;
    
    }
    ?>


</table>

</div>

</main>
</body>
</html>

