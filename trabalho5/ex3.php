
<?php
                
function salvaString($string, $arquivo)
     {
        $arq = fopen($arquivo, "w");
        fwrite($arq, $string);
        fclose($arq);
     }

     $email = $_POST["email"];
     $senha = $_POST["password"];
     $senhaHash = password_hash($senha,PASSWORD_DEFAULT);

    salvaString($email,"email.txt");
    salvaString($senhaHash,"senhaHash.txt");


               
?>