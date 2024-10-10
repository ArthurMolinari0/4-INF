<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "../ClasS/Crud.php";


$id = 1;
$nome = $_POST['nome'] ?? '';
$sobrenome = $_POST['sobrenome'] ?? '';
$email = $_POST['email'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$data_nascimento = $_POST['data_nascimento'] ?? '';
$password = $_POST['password'] ?? '';

$crud = new Crud();

$resultado = $crud->insertDB(
    'cliente',
    '?,?,?,?,?,?,?',
    array(
        $id,
        $nome, 
        $sobrenome,
        $email,
        $telefone,
        $data_nascimento,
        $password
    )
);
