           <?php
    require "conexaoMysql.php";
    $pdo = mysqlConnect();
    
    try {
        $sql = <<<SQL 
        SELECT email,senhaHash
        FROM exercicio3
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
        <th>Email</th>
        <th>Senha Hash</th>
        </tr>

<?php
    while($row = $stmt->fetch()){

        $email = htmlspecialchars($row['email']);
        $senhaHash = htmlspecialchars($row['senhaHash']);

    echo <<<HTML
        <tr>
        <td> $email </td>
        <td> $senhaHash </td>
        </tr>
    
    HTML;
    
    }
               
?>



    </table>
    
    </div>

</main>
</body>
</html>