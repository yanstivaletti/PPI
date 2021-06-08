


<?php
                
function carregaString($arquivo)
    {
        $arq = fopen($arquivo, "r");
        $string = fgets($arq);
        fclose($arq);
        return $string;
}   
    $emailFornecido = $_POST["email"];
    $senhaFornecida = $_POST["password"];
    $email = carregaString("email.txt");
    $senha = carregaString("senhaHash.txt");
    $senhaHash = htmlspecialchars($senha);

    if(password_verify($senhaFornecida,$senhaHash)){
        header("Location: nova-pagina.php");
        exit();
    }


               
?>