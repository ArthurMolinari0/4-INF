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
    $nome_usuario = $conn->real_escape_string($_POST["nome_usuario"]);
    $senha = $_POST["senha"];

    $sql = "SELECT * FROM clientes WHERE nome_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nome_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($senha, $row["senha"])) {
            if ($row["tipo_usuario"] == "ADM") {
                header("Location: adm.html");
            } else {
                header("Location: cliente.html");
            }
            exit();
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Usuário não encontrado!";
    }

    $stmt->close();
}

$conn->close();
?>
