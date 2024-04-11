
<?php
// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se os campos de usuário e senha foram preenchidos
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        // Supondo que você tenha um banco de dados onde os dados de login são armazenados
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Conectar ao banco de dados (substitua as credenciais e o nome do banco de dados conforme necessário)
        $servername = "localhost";
        $db_username = "seu_usuario";
        $db_password = "sua_senha";
        $dbname = "seu_banco_de_dados";

        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        // Verificar a conexão
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        // Consulta SQL para verificar se o usuário e senha são válidos
        $sql = "SELECT * FROM usuarios WHERE username='$username' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            // Autenticação bem-sucedida, redirecionar para a página inicial, por exemplo
            header("Location: index.php");
            exit;
        } else {
            // Autenticação falhou, exibir uma mensagem de erro
            echo "Usuário ou senha inválidos.";
        }

        $conn->close();
    }
}
?>


