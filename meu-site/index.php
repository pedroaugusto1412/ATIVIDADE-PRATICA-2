<?php
session_start();

$erros = [];
$email = "";

// Processa login

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Dados fixos (exemplo)
    $email_correto = "admin@email.com";
    $senha_correta = "Admin123";


    // Email
    
    if (empty($_POST["email"])) {
        $erros[] = "O email é obrigatório.";
    } else {
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erros[] = "Email inválido.";
        }
    }

   
    // Senha
   
    if (empty($_POST["senha"])) {
        $erros[] = "A senha é obrigatória.";
    } else {
        $senha = $_POST["senha"];
    }

   
    // Verificação
    
    if (empty($erros)) {
        if ($email !== $email_correto || $senha !== $senha_correta) {
            $erros[] = "Email ou senha incorretos.";
        } else {
            // Login OK
            $_SESSION["logado"] = true;

            header("Location: feed.php"); 
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tela de login</title>
    <link rel="stylesheet" href="CSS\Untitled-2.css">
    <link rel="stylesheet" href="CSS\login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    <nav class="barra">
        <ul>
            <li><a href="a"><span><i class="bi bi-house-fill"></i></span></a></li>
            <li><a href="a"><span><i class="bi bi-search"></i></span></a></li>
            <li><a href="a"><span class="mais"><i class="bi bi-plus-circle-fill"></i></span></a></li>
            <li><a href="a"><span><i class="bi bi-person"></i></span></a></li>
        </ul>
    </nav>
    <div id="login">
        <div>
            
        <!-- Mostrar erros -->
        <?php if (!empty($erros)): ?>
            <div style="color:red;">
                <?php foreach ($erros as $erro): ?>
                    <p><?= $erro ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

            <form method="post">
                <h1>Login</h1><br>

                <input type="email" name="email" placeholder="Email" class="caixas" value="<?= htmlspecialchars($email) ?>" required>
                <br><br>
                <input type="password" name="senha" placeholder="Senha" class="caixas" required>
                <br><br>
                <button type="submit" class="botao-login">Entrar</button>
            </form>

        </div>
         
    </div>
   
</body>
</html>