<?php
$host = "localhost";  
$dbname = "meu_banco"; 
$username = "root"; 
$password = "";


$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $data_nascimento = $_POST["data_nascimento"];
    $senha = $_POST["senha"];
    $confirma_senha = $_POST["confirma_senha"];

    if ($senha === $confirma_senha) {
        $hashed_password = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO clientes (nome, sobrenome, email, telefone, data_nascimento, senha)
                VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $nome, $sobrenome, $email, $telefone, $data_nascimento, $hashed_password);

        if ($stmt->execute()) {
            echo "Cadastro realizado com sucesso!";
        } else {
            echo "Erro: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "As senhas não correspondem!";
    }
}

$conn->close();
?>
