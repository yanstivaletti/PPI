<?php

require "conexaoMysql.php";
require "autenticacao.php";
session_start();
$pdo = mysqlConnect();
exitWhenNotLogged($pdo);
 

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="keywords" content="HTML, CSS, JavaScript">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>Funcionario Web-Clinica</title>
    <style>
        *{
            margin: 0px;
        }
        header {
            background-color: #00cccc;
            border:none;
            color:white;

            font-size: 25px;
            font-family: Helvetica, sans-serif;
            padding:0 2rem 1.5rem;
            border-bottom: 1px solid gray;
        }
        nav {
            background-color: gray;
            display: flex;
            
        }
        li {
            display: inline;
            text-align: center;
            float:left;

        }
        nav button {
            border: solid gray;
            background-color: gray;
            color: white;
            padding: 15px 32px;
            display: inline-block;
            font-size: 16px;
            display:block;
            text-align:center;
            text-decoration:none; 

        }
        .formulario {
            color:pink;

        }
        nav button:hover {
            color: blue;
            cursor: pointer;

        }
        button.buttonActive {
            font-weight: bold;
            color: blue;
        }
        img {
            max-height: 150px;
            max-width: 200px;
            width: 350px;
            height: 350px;
            margin: 25px;
            border-radius: 10px;
            

        }
        .tabs section {
            display: none;
        }
        div{
            width: 1200px; 
            margin-left: auto;
            margin-right: auto;
            padding: 2rem;
            border: 1px;
            box-shadow: 2px 2px 2px 2px rgba(0,0,0,0.5);
        }
        
        section.tabActive {
            display: block;
        }
        td,th {
        border: 1px solid #ddd;
        padding: 8px;
            font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
        }

        tr:nth-child(even){
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%; background-color: #f2f2f2;}

        tr:hover {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            background-color: #ddd;
            }

        a {
            text-decoration: none;
        }

    </style>
    </head>

        <body>
            <header>
                    <h1>Web Clínica</h1>
            </header>
            <nav> 
                <section>
                    <ul>
                        <li><button>Novo Funcionario</button></li>
                        <li><button>Novo Paciente</button></li>
                        <li><button>Listar Funcionarios</button></li>
                        <li><button>Listar Pacientes</button></li>
                        <li><button>Listar Endereços</button></li>
                        <li><button>Listar todos Agendamentos</button></li>
                        <li><button>Listar meus Agendamentos</button></li>
                    </ul>
                </section>
            </nav>
            <main>
                <div class = "tabs">
                    <section> 
                      <form action = "cadastraFuncionario.php" method = "POST">
                            <p class = "col-md">
                                <label for = "inputNome" class = "form-label">Nome:</label>
                                <input type = "text" name = "nome" class = "form-control" id = "inputNome">
                            </p>

                            <p class = "col-md">
                                <label for = "inputSex" class = "form-label">Sexo:</label>
                                <select class = "form-control" name = "sexo" id = "inputSex">
                                    <option>Feminino</option>
                                    <option>Masculino</option>
                                    <option>Outro</option>
                                    <option>Prefiro não comentar</option>
                                </select>
                            </p>

                            <p class = "col-md">
                                <label for = "inputEmail" id = "inputEmail" class = "form-label">Email:</label>
                                <input type = "email"  name = "email" class = "form-control" id = "inputEmail">
                            </p>

                            <p class = "col-md">
                                <label for = "inputTele" class = "form-label">Telefone:</label>
                                <input type = "number"  name = "telefone" class = "form-control" id = "inputTele">
                                
                            </p>
                            <p class = "col-md">
                                <label for = "inputCEP" class = "form-label">CEP</label>
                                <input type = "number" name = "cep" class = "form-control" id = "inputCEP" onchange="getCep()">
                            </p>

                            <p class = "col-md">
                                <label for = "inputLogadrouro" class = "form-label">Logradouro</label>
                                <input type = "text" name = "logradouro" class = "form-control" id = "inputLogradouro">
                            </p>

                            <p class = "col-md">
                                <label for = "inputCidade" id = "inputCidade" class = "form-label">Cidade</label>
                                <input type = "text"  name = "cidade" class = "form-control" id = "inputCidade">
                            </p>

                            <p class = "col-md-6">
                                <label for = "inputEstado" class = "form-label">Estado</label>
                                <input type = "text"  name = "estado" class = "form-control" id = "inputEstado">
                                
                            </p>
                            <p class = "col-md">
                                <label for = "senha" class = "form-label">Senha</label>
                                <input type = "password" name = "senha" class = "form-control" id = "inputSenha">
                            </p>

                            <p class = "col-md">
                                <label for = "salario" class = "form-label">Salario</label>
                                <input type = "number" name = "salario" class = "form-control" id = "inputSalario">
                            </p>
                            <p class = "col-md">
                                <label for="dataIni" class = "form-label">Data da Inicio do Contrato:</label>
                                <input type = "date" class = "form-control" id = "dataIni" name = "dataIni">
                            </p>
                             <p class = "col-md">
                                <label for="dataFim" class = "form-label">Data da Fim do Contrato:</label>
                                <input type = "date" class = "form-control" id = "dataFim" name = "dataFim">
                            </p>
                            
                            <p class = "col-md">
                            Médico:
                            <input type="checkbox" id="myCheck" onclick="ehMedico()">
                            </p>
                            <p id="medForm" style="display:none">
                           
                                <label for="esp" class = "form-label">Especialidade</label>
                                <input type = "text" class = "form-control" id = "esp" name = "esp">
                     
                    
                                <label for="crm" class = "form-label">CRM</label>
                                <input type = "text" class = "form-control" id = "crm" name = "crm">
                      
                            </p>
                            <p class = "col-12">
                                <button type = "submit" class = "btn btn-primary"> Cadastrar</button>
                            </p>
                        </form>
                    </section>
                    <section>
                        <form action = "cadastraPaciente.php" method = "POST">
                            <p class = "col-md">
                                <label for = "inputNome" class = "form-label">Nome:</label>
                                <input type = "text" name = "nome" class = "form-control" id = "inputNome">
                            </p>

                            <p class = "col-md">
                                <label for = "inputSex" class = "form-label">Sexo:</label>
                                <select class = "form-control" name = "sexo" id = "inputSex">
                                    <option>Feminino</option>
                                    <option>Masculino</option>
                                    <option>Outro</option>
                                    <option>Prefiro não comentar</option>
                                </select>
                            </p>

                            <p class = "col-md">
                                <label for = "inputEmail" id = "inputEmail" class = "form-label">Email:</label>
                                <input type = "email"  name = "email" class = "form-control" id = "inputEmail1">
                            </p>

                            <p class = "col-md">
                                <label for = "inputTele" class = "form-label">Telefone:</label>
                                <input type = "number"  name = "telefone" class = "form-control" id = "inputTele1">
                                
                            </p>
                            <p class = "col-md">
                                <label for = "inputCEP" class = "form-label">CEP</label>
                                <input type = "number" name = "cep" class = "form-control" id = "inputCEP" onchange="getCep()">
                            </p>

                            <p class = "col-md">
                                <label for = "inputLogadrouro" class = "form-label">Logradouro</label>
                                <input type = "text" name = "logradouro" class = "form-control" id = "inputLogradouro1">
                            </p>

                            <p class = "col-md">
                                <label for = "inputCidade" id = "inputCidade" class = "form-label">Cidade</label>
                                <input type = "text"  name = "cidade" class = "form-control" id = "inputCidade1">
                            </p>

                            <p class = "col-md-6">
                                <label for = "inputEstado" class = "form-label">Estado</label>
                                <input type = "text"  name = "estado" class = "form-control" id = "inputEstado1">
                                
                            </p>
                            <p class = "col-md">
                                <label for="peso" class = "form-label">Peso:</label>
                                <input type = "number" class = "form-control" id = "peso" name = "peso">
                            </p>
                             <p class = "col-md">
                                <label for="altura" class = "form-label">Altura:</label>
                                <input type = "number" class = "form-control" id = "altura" name = "altura">
                            </p>
                            <p class = "col-md">
                                <label for="sangue" class = "form-label">Tipo Sanguíneo:</label>
                                <select class = "form-control" name = "sangue" id = "sangue">
                                    <option>A</option>
                                    <option>B</option>
                                    <option>O</option>
                                    <option>AB</option>
                                </select>
                                
                             </p>
                            <p class = "col-12">
                                <button type = "submit" class = "btn btn-primary"> Cadastrar</button>
                            </p>
                        </form>
                    </section>

                    <section>
                    <table class="table table-striped">
                        <tr>
                            <th data-mdb-sort="false"> Código </th>
                            <th data-mdb-sort="false"> Nome </th>
                            <th data-mdb-sort="false"> Data de Contrato </th>
                            <th data-mdb-sort="false"> Salário </th>
                            <th data-mdb-sort="false"> SenhaHash </th>
                        </tr>

                    <?php

                    try {
                        $sql2 = <<<SQL
                        SELECT PESSOA.codigo,nome,DataContrato,salario,senhaHash
                        FROM PESSOA INNER JOIN FUNCIONARIO 
                        WHERE PESSOA.codigo = FUNCIONARIO.codigo
                        SQL;

                        $stmt2 = $pdo->query($sql2);

                    }
                    catch (Exception $e) {
                        exit('Ocorreu uma falha: '. $e->getMessage());
                    }

                    while($row = $stmt2->fetch()){

                        $codigo = htmlspecialchars($row['codigo']);
                        $nome = htmlspecialchars($row['nome']);
                        $dataIni = htmlspecialchars($row['dataIni']);
                        $salario = htmlspecialchars($row['salario']);
                        $senhaHash = htmlspecialchars($row['senhaHash']);


                    echo <<<HTML
                        <tr scope = "row">
                            <td > $codigo</td>
                            <td> $nome </td>
                            <td> $dataIni </td>
                            <td> $salario </td>
                            <td> $senhaHash </td>
                        </tr>

                    HTML;

                    }
                            
                    ?>
                    </table>
                    </section>
                    <section>
                    <table class="table table-striped">
                    <tr>
                            <th data-mdb-sort="false"> Código </th>
                            <th data-mdb-sort="false"> Nome </th>
                            <th data-mdb-sort="false"> Peso </th>
                            <th data-mdb-sort="false"> Altura </th>
                            <th data-mdb-sort="false"> Tipo Sanguineo </th>
                    </tr>
                    <?php
                     try {
                        $sql1 = <<<SQL
                        SELECT PESSOA.codigo,nome,peso,altura,tipo_sanguineo
                        FROM PESSOA INNER JOIN PACIENTE
                        WHERE PESSOA.codigo = PACIENTE.codigo
                        SQL;
                
                        $stmt1 = $pdo->query($sql1);
                    
                    }
                    catch (Exception $e) {
                        exit('Ocorreu uma falha: '. $e->getMessage());
                    }

                    while($row = $stmt1->fetch()){

                        $codigo = htmlspecialchars($row['codigo']);
                        $nome = htmlspecialchars($row['nome']);
                        $peso = htmlspecialchars($row['peso']);
                        $altura = htmlspecialchars($row['altura']);
                        $sangue = htmlspecialchars($row['tipo_sanguineo']);

                    echo <<<HTML
                        <tr>
                        <td> $codigo</td>
                        <td> $nome </td>
                        <td> $peso </td>
                        <td> $altura </td>
                        <td> $sangue </td>
                        </tr>
                    
                    HTML;
                    
                    }
                            
                    ?>
                    </table>
                    </section>
                    
                    <section>
                    <table class="table table-striped">
                    <tr>
                            <th data-mdb-sort="false"> CEP </th>
                            <th data-mdb-sort="false"> Logradouro </th>
                            <th data-mdb-sort="false"> Cidade </th>
                            <th data-mdb-sort="false"> Estado </th>
                    </tr>
                    <?php
                    
                     try {
                        $sql3 = <<<SQL
                        SELECT CEP,Logradouro,Cidade,Estado
                        FROM ENDERECO
                        SQL;
                
                        $stmt3 = $pdo->query($sql3);
                    
                    }
                    catch (Exception $e) {
                        exit('Ocorreu uma falha: '. $e->getMessage());
                    }

                    while($row = $stmt3->fetch()){

                        $cep = htmlspecialchars($row['CEP']);
                        $logradouro = htmlspecialchars($row['Logradouro']);
                        $cidade = htmlspecialchars($row['Cidade']);
                        $estado = htmlspecialchars($row['Estado']);
                        
                    

                    echo <<<HTML
                        <tr>
                        <td> $cep</td>
                        <td> $logradouro </td>
                        <td> $cidade </td>
                        <td> $estado </td>
                        
                        </tr>
                    
                    HTML;
                    
                    }
                            
                    ?>
                    </table>
                    </section>
                    <section>
                    <table class="table table-striped">
                    <tr>
                            <th data-mdb-sort="false"> Código </th>
                            <th data-mdb-sort="false"> Nome </th>
                            <th data-mdb-sort="false"> Horário </th>
                            <th data-mdb-sort="false"> Email </th>
                            <th data-mdb-sort="false"> Código do Médico </th>
                    </tr>
                    <?php
                    
                     try {
                        $sql4 = <<<SQL
                        SELECT Codigo,Nome,Horário,Email,CodigoMedico
                        FROM AGENDA
                        SQL;
                
                        $stmt4 = $pdo->query($sql4);
                    
                    }
                    catch (Exception $e) {
                        exit('Ocorreu uma falha: '. $e->getMessage());
                    }

                    while($row = $stmt4->fetch()){

                        $codigo = htmlspecialchars($row['Codigo']);
                        $nome = htmlspecialchars($row['Nome']);
                        $horario = htmlspecialchars($row['Horário']);
                        $email = htmlspecialchars($row['Email']);
                        $codmed = htmlspecialchars($row['CodigoMedico']);
                    

                    echo <<<HTML
                        <tr>
                        <td> $codigo</td>
                        <td> $nome </td>
                        <td> $horario </td>
                        <td> $email </td>
                        <td> $codmed </td>
                        </tr>
                    
                    HTML;
                    
                    }
                            
                    ?>
                    </table>
                    </section>
                    <section>
                    <table class="table table-striped">
                    <tr>
                            <th data-mdb-sort="false"> Código </th>
                            <th data-mdb-sort="false"> Nome </th>
                            <th data-mdb-sort="false"> Horário </th>
                            <th data-mdb-sort="false"> Email </th>
                            <th data-mdb-sort="false"> Código do Médico </th>
                    </tr>
                    <?php
                    $usuario = $_SESSION['emailUsuario'];
                    try {
                        $sql5 = <<<SQL
                        SELECT AGENDA.Codigo,AGENDA.Nome,Horário,AGENDA.Email,CodigoMedico
                        FROM AGENDA INNER JOIN MEDICO ON MEDICO.CODIGO = AGENDA.CodigoMedico,PESSOA
                        WHERE PESSOA.email = ? AND PESSOA.codigo = MEDICO.CODIGO;
                        SQL;
                
                        $stmt5 = $pdo->prepare($sql5);
                        $stmt5->execute([$usuario]);
                        while($row = $stmt5->fetch()){

                            $codigo = htmlspecialchars($row['Codigo']);
                            $nome = htmlspecialchars($row['Nome']);
                            $horario = htmlspecialchars($row['Horário']);
                            $email = htmlspecialchars($row['Email']);
                            $codmed = htmlspecialchars($row['CodigoMedico']);

                            
                            echo <<<HTML
                            <tr>
                            <td> $codigo</td>
                            <td> $nome </td>
                            <td> $horario </td>
                            <td> $email </td>
                            <td> $codmed </td>
                            </tr>
                        
                        HTML;


                        
                    
                        }
                    }
                    catch(Exception $e) {
                        exit('Ocorreu uma falha: '. $e->getMessage());
                    }


                    ?>  
                    <table class="table table-striped">
                    </section>

                </div>
                
            </main>

        <script type = "text/javascript">
           

            window.onload = function () {
                
               
                buttons = document.querySelectorAll("nav button");  // Seleciona todos os botões dentro da barra de navegação
                for(let button of buttons) {                        
                    button.addEventListener("click",changeTab);  
                }
                openTab(0);
            }
            function changeTab(e){                                  // Tem como papel, encontrar a posição do item de lista dentro da lista
                const botaoAdicionado = e.target;                   // e. da acesso ao objeto que disparou o evento que levou a chamada da função changeTab
                const liDoBotao = botaoAdicionado.parentNode;       // Recebe o nó pai para depois acessarmos o filho dele
                const nodes = Array.from(liDoBotao.parentNode.children);
                const index = nodes.indexOf(liDoBotao);             // pega a posição de Li que queremos mostrar
                openTab(index);                                     // Abre a Tab da posição "index"
            }
            function openTab(i) {
                const tabActive = document.querySelector(".tabActive");     //Busca a Tab que esta ativo e a torna invisivel
                if(tabActive !== null)
                    tabActive.className = "";
                
                const  buttonActive = document.querySelector(".buttonActive"); //Busca o botão que esta ativo e a torna invisivel
                if(buttonActive !== null)
                    buttonActive.className = ""; 
                
                document.querySelectorAll(".tabs section")[i].className = "tabActive"; // ativa a Tab desejada
                document.querySelectorAll("nav button")[i].className = "buttonActive"; // ativa o botão desejado
            }
            function validaForm(e) {
                let form = e.target;                    
                let formValido = true;

                  //Acessa os spans que estão abaixo do input
                const spanSenha = form.senha.nextElementSibling;
                const spanEmail = form.email.nextElementSibling;

                  //Declaramos as variaveis para preencher os spans
                spanSenha.textContent = "";
                spanEmail.textContent = "";

                if(form.senha.value === ""){
                    spanSenha.textContent = 'A senha deve ser informada';
                    formValido = false;
                }
                if(form.email.value === ""){
                    spanEmail.textContent = 'O email deve ser informado';
                    formValido = false;
                }

                return formValido;          // retorna o formulario

            }
            function ehMedico(){
                var checkBox = document.getElementById("myCheck");
                var medForm = document.getElementById("medForm");
                 if (checkBox.checked == true){
                    medForm.style.display = "block";
                } else {
                    medForm.style.display = "none";
                }
            }
            function buscaEndereco(cep) {
            
            if (cep.length != 9) return;      
            let form = document.querySelector("form");
            
            fetch("AJAXEndereco.php?cep=" + cep)
                .then(response => {
                if (!response.ok) {
                    throw new Error(response.status);
                }
                return response.json();
                })
                .then(endereco => {
                form.logradouro.value = endereco.logradouro;
                form.cidade.value = endereco.cidade;
                form.estado.value = endereco.estado;
                })
                .catch(error => {
                form.reset();
                console.error('Falha inesperada: ' + error);
                });
                }
                function getCep() {
                const inputCep = document.querySelector("#InputCep");
                inputCep.onkeyup = () => buscaEndereco(inputCep.value);
                }    


        </script>
        </body>

</html>