<!doctype html>
<html>
<head>
	<title>ex1</title>
	<meta name = "viewport" content = "width = devide-widthz, initial-scale = 1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
<main>
<h1> Informações do Usuario </h1>
<?php
                $cep = $_POST["cep"];
                $lugradouro = $_POST["lugradouro"];
                $bairro = $_POST["bairro"];
                $cidade = $_POST["cidade"];
                $estado = $_POST["estado"];

                echo <<<HTML

                <div class = "row g-2">

                    <div class = col-md> $cep </div>
                    <div class = col-md> $lugradouro</div>
                    <div class = col-md> $bairro </div>
                    <div class = col-md> $cidade</div>
                    <div class = col-md> $estado </div>

                </div>
                HTML;
?>
</main>
</body>
</html>