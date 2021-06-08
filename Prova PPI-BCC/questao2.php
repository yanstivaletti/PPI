<!DOCTYPE html>
<html>
   <head>
       <meta charset="UTF-8">
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
       <title>Funcionario Web-Clinica</title>

    </head>

       <body>
           <header>
                   <h1>Questao2</h1>
           </header>
           <body>
           <div>
                <table class="table table-striped">

                    <?php
                    
                    require "conexaoMysql.php";
                    $pdo = mysqlConnect();

                    try {
                        $sql = <<<SQL
                        SELECT *
                        FROM veiculo,veiculo_multa
                        WHERE veiculo.id = veiculo_multa.id_veiculo;
                        SQL;

                        $stmt = $pdo->query($sql);

                    }
                    catch (Exception $e) {
                        exit('Ocorreu uma falha: '. $e->getMessage());
                    }

                    while($row = $stmt->fetch()){

                        $tipo_veiculo = htmlspecialchars($row['tipo']);
                        $marca_veiculo = htmlspecialchars($row['marca']);
                        $modelo_veiculo = htmlspecialchars($row['modelo']);
                        $valor_multa = htmlspecialchars($row['valor']);
                        $descricao_infracao = htmlspecialchars($row['descricao']);


                    echo <<<HTML
                        <tr scope = "row">
                            <td > $tipo_veiculo</td>
                            <td> $marca_veiculo </td>
                            <td> $modelo_veiculo </td>
                            <td> $valor_multa </td>
                            <td> $descricao_infracao </td>
                        </tr>

                    HTML;

                    }
                            
                    ?>
                    </table>
                    </div>
                    </body>