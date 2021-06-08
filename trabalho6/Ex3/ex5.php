<?php
    function checkLogin($pdo, $email, $senha){
        $sql = <<<SQL
        SELECT senhaHash
        FROM exercicio3
        WHERE email = :
        SQL;

        try{
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email]);
            $row = $stmt->fetch();
            if (!$row)
                return false;
            else
                return password_verify($senha,$row['senhaHash']);
        }
        catch (Exception $e) {
            exit('Falha inesperada: ' . $e->getMessage());
        }
    }     

    $errorMsg = "";
    if($_SERVER["REQUEST_METHOD"] == "POST") {

        require "conexaoMysql.php";
        $pdo = mysqlConnect();

        $email = $senha = "";
        if (isset($_POST['email'])) $email = $_POST['email'];
        if (isset($_POST['password'])) $email = $_POST['password'];
        
        if(checkLogin($pdo,$email,$senha)) {
            header("location: nova-pagina.php");
            exit();
        }else
            $errorMsg = "Dados Incorretos";
    
    
    }
               
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>ex3</title>
    <style>

    .container {
    background-color:  white;
    font-family: Helvetica;
    left:50%;
    top:50%;
    margin-left:-250px;
    margin-top:-100px;
    width:500px;
    height:200px;
    position:absolute;
    padding: 2rem;
    border: 1px solid gray;
    border-radius: 1rem;
    align-items: center;
    font-weight: 700;
}

    body{
        background-color: rgb(241, 238, 238);
    }

    input[type=text]:focus {
        border: 5px solid rgb(255, 0, 234);
    }
    </style>
  </head>
  <body>
    
    <main>
        <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">

            <div class = "container">
                <div>
                    <label for = "nome">Email:</label>
                    <p></p>
                    <input type="text" name = "email" id = "nome" maxlength="60" size="60">
                    <p></p>
                </div>
                
                <div>
                    <label for = "email">Senha:</label>
                    <p></p>
                    <input type="password" name = "password" id = "email" maxlength="60" size="60">
                    <p></p>
                </div>

                <input type="submit" name="enviar" value="Enviar">
            </div>  

        </form>

        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST" && $errorMsg !== ""){
            echo <<<HTML
                <div class = "alert alert-warning alert-dismissible" role = "alert">
                <strong>$errorMsg</strong>
                </div>
                HTML;
        }
        
        ?>
    <footer></footer>
  </main>
  </body>
</html>