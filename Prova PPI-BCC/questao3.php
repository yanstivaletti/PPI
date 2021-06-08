<?php

class Veiculo
{
  public $tipo;
  public $marca;
  public $modelo;

  function __construct($tipo, $marca, $modelo)
  {
    $this->tipo = $tipo;
    $this->marca = $marca; 
    $this->modelo = $modelo;
  }
}

$veiculo1 = new Veiculo('Automovel', 'MarcaA', 'AutoXYZ');
$veiculo2 = new Veiculo('Caminhao', 'MarcaB', 'CamXYZ');
$veiculo3 = new Veiculo('Trator', 'MarcaC', 'TratorXYZ');

$veiculos = array(
  '1' => $veiculo1,
  '2' => $veiculo2,
  '3' => $veiculo3
);

$id = $_GET['id'] ?? '';
  
$veiculo = array_key_exists($id, $veiculos) ? $veiculos[$id] : new Veiculo('', '', '');
  
echo json_encode($veiculo);