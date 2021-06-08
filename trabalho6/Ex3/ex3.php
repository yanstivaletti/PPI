
<?php
                
   require "conexaoMysql.php";
    $pdo = mysqlConnect();

   
    if(isset($_POST["email"])) $email = $_POST["email"];
    if(isset( $_POST["password"])) $senha = $_POST["password"];
     $senhaHash = password_hash($senha,PASSWORD_DEFAULT);


   try {
      $sql = <<<SQL

      INSERT INTO exercicio3 (email,senhaHash)
      VALUES (?,?)
      SQL;

      $stmt = $pdo->prepare($sql);
      $stmt->execute([
          $email,$senhaHash
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