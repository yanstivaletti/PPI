<?php
    require "conexaoMysql.php";
    $pdo = mysqlConnect();
    
    try {
        $sql = <<<SQL 
        SELECT cep,lugradouro,bairro,
               cidade,estado
        FROM exercicio2
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
        <tr>
        <th>CEP</th>
        <th>Lugradouro</th>
        <th>Bairro</th>
        <th>Cidade</th>
        <th>Estado</th>
        </tr>

        <?php
        
        while($row = $stmt->fetch()){

            $cep = htmlspecialchars($row['cep']);
            $lugradouro = htmlspecialchars($row['lugradouro']);
            $bairro = htmlspecialchars($row['bairro']);
            $cidade = htmlspecialchars($row['cidade']);
            $estado = htmlspecialchars($row['estado']);
        

        echo <<<HTML
            <tr>
            <td> $cep </td>
            <td> $lugradouro </td>
            <td> $bairro </td>
            <td> $cidade </td>
            <td> $estado </td>

            </tr>
        
        HTML;
        
        }
        ?>


    </table>
    
    </div>

</main>
</body>
</html>