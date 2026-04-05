<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tela de cadastro</title>
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
    <div class="cadastro">
<?php if (!empty($_SESSION["erros"])): ?>
        <div style="color:red;">
            <?php foreach ($_SESSION["erros"] as $erro): ?>
                <p><?= $erro ?></p>
            <?php endforeach; ?>
        </div>
        <?php unset($_SESSION["erros"]); ?>
    <?php endif; ?>

    <form action="processa.php" method="POST">
        <h1>Cadastro</h1>

        <input type="text" name="nome" placeholder="Nome" class="caixas"
        value="<?= $_SESSION['dados']['nome'] ?? '' ?>" required><br><br>

        <input type="text" name="usuario" placeholder="Nome de usuário" class="caixas"
        value="<?= $_SESSION['dados']['usuario'] ?? '' ?>" required><br><br>

        <input type="email" name="email" placeholder="Email" class="caixas"
        value="<?= $_SESSION['dados']['email'] ?? '' ?>" required><br><br>

        <input type="password" name="senha" placeholder="Senha" class="caixas" required><br><br>

        <input type="password" name="confirmar_senha" placeholder="Confirme a senha" class="caixas" required><br><br>

        <input type="date" name="data" class="caixas"
        value="<?= $_SESSION['dados']['data'] ?? '' ?>" required><br><br>

        <!-- Radio -->
        <label>
            <input type="radio" name="sexo" value="m"
            <?= (($_SESSION['dados']['sexo'] ?? '') == 'm') ? 'checked' : '' ?> required>
            Masculino
        </label>

        <label>
            <input type="radio" name="sexo" value="f"
            <?= (($_SESSION['dados']['sexo'] ?? '') == 'f') ? 'checked' : '' ?> required>
            Feminino
        </label>

        <br><br>

        <button type="submit" class="botao-login">Cadastrar</button>
    </form>
    </div>
    <?php unset($_SESSION["dados"]); ?>
</body>
</html>