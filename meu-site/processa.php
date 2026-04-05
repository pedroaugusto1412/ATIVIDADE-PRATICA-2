<?php
session_start();

// Função para limpar dados
function limpar($dado) {
    return htmlspecialchars(trim($dado));
}

$erros = [];
$dados = [];

// Verifica se veio via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    // Nome
    
    if (empty($_POST["nome"])) {
        $erros[] = "O nome é obrigatório.";
    } else {
        $dados["nome"] = limpar($_POST["nome"]);
    }

    
    // Usuário
    
    if (empty($_POST["usuario"])) {
        $erros[] = "O usuário é obrigatório.";
    } else {
        $dados["usuario"] = limpar($_POST["usuario"]);
    }

    
    // Email
    
    if (empty($_POST["email"])) {
        $erros[] = "O email é obrigatório.";
    } else {
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erros[] = "Email inválido.";
        } else {
            $dados["email"] = $email;
        }
    }

    
    // Senha
    
    if (empty($_POST["senha"])) {
        $erros[] = "A senha é obrigatória.";
    } else {
        $senha = $_POST["senha"];

        if (strlen($senha) < 6) {
            $erros[] = "A senha deve ter pelo menos 6 caracteres.";
        }

        if (!preg_match('/[A-Z]/', $senha)) {
            $erros[] = "A senha deve conter pelo menos 1 letra maiúscula.";
        }

        if (!preg_match('/[0-9]/', $senha)) {
            $erros[] = "A senha deve conter pelo menos 1 número.";
        }

        $dados["senha"] = $senha;
    }

    
    // Confirmar senha
   
    if (empty($_POST["confirmar_senha"])) {
        $erros[] = "Confirme a senha.";
    } else {
        if ($_POST["senha"] !== $_POST["confirmar_senha"]) {
            $erros[] = "As senhas não coincidem.";
        }
    }

   
    // Data de nascimento
    
    if (empty($_POST["data"])) {
        $erros[] = "A data é obrigatória.";
    } else {
        $data = $_POST["data"];

        if (!strtotime($data)) {
            $erros[] = "Data inválida.";
        } else {
            $dados["data"] = $data;
        }
    }

    
    // Sexo
    
    if (empty($_POST["sexo"])) {
        $erros[] = "Selecione um gênero.";
    } else {
        $sexo = $_POST["sexo"];

        if ($sexo !== "m" && $sexo !== "f") {
            $erros[] = "Gênero inválido.";
        } else {
            $dados["sexo"] = $sexo;
        }
    }

   
    // Resultado
    
    if (!empty($erros)) {
        // Salva erros e dados na sessão
        $_SESSION["erros"] = $erros;
        $_SESSION["dados"] = $_POST;

        // Volta para o formulário
        header("Location: cadastro.php");
        exit;
    } else {
        // Aqui você pode salvar no banco depois

        // Redireciona para login ou feed
        header("Location: index.php");
        exit;
    }
}
?>
