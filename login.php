<?php
session_start();
require 'conexao.php';
$mensagem = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if ($usuario = mysqli_fetch_assoc($resultado)) {
        if (password_verify($senha, $usuario['senha'])) {
            session_regenerate_id(true); // Prevenção contra fixação de sessão
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
            header("Location: index.php");
            exit();
        } else {
            $mensagem = "Senha incorreta.";
        }
    } else {
        $mensagem = "Usuário não encontrado.";
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conexao);
?>
<!DOCTYPE html>
<html lang="pt-br">


<header>
    <a href="index.php" style="text-decoration: none; color: inherit;">
  <div class="logo">
    LMG
    <span>Streetwear</span>
  </div>
</a>
  </header>
    <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      background-color: #f4f4f4;
      color: #000;
    }

    header {
      background-color: #0b1a3d;
      padding: 1em;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }

    .logo {
      font-size: 2em;
      font-weight: bold;
    }

    .logo span {
      display: block;
      text-align: center;
      font-size: 0.6em;
      color: #ccc;
    }

    .search-login {
      display: flex;
      align-items: center;
    }

    .search-box {
      padding: 0.5em;
      border: none;
      border-radius: 4px;
      margin-right: 1em;
    }

    .btn {
      background-color: #fff;
      color: #0b1a3d;
      padding: 0.5em 1em;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s;
      text-decoration: none;
      margin: 0.5em 0.5em 0 0;
    }

    .btn:hover {
      background-color: #d0d0d0;
    }

    .main-content {
      padding: 2em;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 2em;
      text-align: center;
    }

    .card {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      transition: transform 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .carousel {
      display: flex;
      overflow-x: auto;
      gap: 1em;
      margin: 2em 0;
      padding-bottom: 1em;
    }

    .carousel img {
      height: 200px;
      border-radius: 10px;
      cursor: pointer;
    }

    .user-nav {
      text-align: center;
      margin: 1em 0;
      background-color: #eee;
      padding: 15px;
      border-radius: 5px;
    }

    .product-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
      gap: 1em;
      padding: 2em;
    }

    .product-card {
      background: white;
      border-radius: 10px;
      padding: 1em;
      text-align: center;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }

    .product-card:hover {
      transform: translateY(-5px);
    }

    .product-card img {
      width: 100%;
      height: 160px;
      object-fit: cover;
      border-radius: 8px;
    }

    .veja-mais {
      text-align: center;
      margin: 2em;
    }

    .veja-mais a {
      color: #0b1a3d;
      text-decoration: underline;
    }
  </style>
  <head>
    <title>Login - IMG Streetwear</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="container">
        <div class="form-container">
            <h2 class="section-title">Acesse sua Conta</h2>
            <?php if(!empty($mensagem)): ?><p style="color:red; text-align:center;"><?php echo $mensagem; ?></p><?php endif; ?>
            <?php if(isset($_GET['status']) && $_GET['status'] == 'sucesso'): ?><p style="color:green; text-align:center;">Cadastro realizado! Faça o login.</p><?php endif; ?>
            <form method="POST" action="login.php">
                <input type="email" name="email" placeholder="E-mail" required>
                <input type="password" name="senha" placeholder="Senha" required>
                <button type="submit" class="btn" style="width:100%;">Entrar</button>
            </form>
            <p style="text-align:center; margin-top:20px;">Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
        </div>
    </main>
</body>
</html>