<?php
session_start();

// Simulando usuário logado
$usuario = "Son Goku";
$username = "@sngoku25";
$foto = "IMG/WhatsApp Image 2026-02-26 at 09.48.50.jpeg";

// Inicializa posts
if (!isset($_SESSION["posts"])) {
    $_SESSION["posts"] = [];
}

$erro = "";


// Criar post

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["post"]))) {
        $erro = "O post não pode estar vazio.";
    } else {
        $novo_post = [
            "nome" => $usuario,
            "user" => $username,
            "foto" => $foto,
            "texto" => htmlspecialchars($_POST["post"]),
            "curtidas" => 0
        ];

        array_unshift($_SESSION["posts"], $novo_post);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed</title>
    <link rel="stylesheet" href="CSS/Untitled-2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>

<nav class="barra">
    <ul>
        <li><a href="#"><i class="bi bi-house-fill"></i></a></li>
        <li><a href="#"><i class="bi bi-search"></i></a></li>
        <li><a href="#"><i class="bi bi-plus-circle-fill"></i></a></li>
        <li><a href="#"><i class="bi bi-person"></i></a></li>
    </ul>
</nav>

<div class="box">

    <!-- Perfil -->
    <div class="texto">
        <div class="item1">
            <img src="<?= $foto ?>" width="60">
        </div>
        <div class="item2">
            <h3><?= $usuario ?></h3>
            <h5><?= $username ?></h5>
        </div>
    </div>

    <!-- Criar post -->
    <form method="POST">
        <textarea name="post" placeholder="Quais as novidades?" class="estilo"></textarea>
        <br>

        <?php if (!empty($erro)): ?>
            <p style="color:red;"><?= $erro ?></p>
        <?php endif; ?>

        <button type="submit" class="postar">Postar</button>
    </form>

    <hr>

    <!-- Lista de posts -->
    <?php foreach ($_SESSION["posts"] as $index => $post): ?>
        <div class="post2">

            <div class="n1">
                <img src="<?= $post["foto"] ?>" width="50">
                <div class="paragrafo">
                    <p><b><?= $post["nome"] ?></b></p>
                    <p><?= $post["user"] ?></p>
                </div>
            </div>

            <div class="n2">
                <p><?= $post["texto"] ?></p>
            </div>

            <div class="n3">
                <button onclick="curtir(<?= $index ?>)" class="bnt">
                    ❤️
                </button>
                <span id="like<?= $index ?>"><?= $post["curtidas"] ?></span> curtidas
            </div>

        </div>
    <?php endforeach; ?>

</div>
<script>
function curtir(id) {
    let elemento = document.getElementById("like" + id);
    let valor = parseInt(elemento.innerText);
    elemento.innerText = valor + 1;
}
</script>


</body>
</html>