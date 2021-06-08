<?php
                
function carregaString($arquivo)
    {
        $arq = fopen($arquivo, "r");
        $string = fgets($arq);
        fclose($arq);
        return $string;
}
    $email = carregaString("email.txt");
    $senha = carregaString("senhaHash.txt");
    $senha = htmlspecialchars($senha);
    echo <<< HTML
        <h1> Dados Carregados </h1>

        <div>
            <p>$email</p>
        <div>

        <div>
            <p>$senha</p>
        <div>
    HTML;

               
?>