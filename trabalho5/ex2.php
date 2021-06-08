<!doctype html>
<html>
<head>
	<title>ex2</title>
	<meta name = "viewport" content = "width = devide-widthz, initial-scale = 1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
<main>
<h1> Informações de Produtos </h1>
<?php
        $produtos = array("agua","sal","açucar","pão","sabão","detergente","banana","maça","uva","pepino");
        $descricao = array("transparente e mineral", "sal refinado", "açucar refinado", "pão frances quente", "sabonete em pedra",
        "detergente de limao", "banana nanica", "maça verde", "uvas do Sul", "pepino japones");

        $qde = $_GET['qde'];
        for ($i = 0; $i < $qde; $i++){
            $c = rand(0,9);
            echo <<< HTML

            <div class = "row g-2">
                <div class = "col-2">
                    $i
                </div>
                <div class = "col-3">
                    $produtos[$c]
                </div>
                <div class = "col-7">
                    $descricao[$c]
                </div>

            </div> 

            HTML;
        }

?>



</main>
</body>
</html>