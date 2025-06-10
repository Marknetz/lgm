<?php
require 'conexao.php';
$mensagem = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $tipo_usuario = mysqli_real_escape_string($conexao, $_POST['tipo_usuario']);

    $sql = "INSERT INTO usuarios (nome, email, senha, tipo_usuario) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $nome, $email, $senha, $tipo_usuario);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: login.php?status=sucesso");
        exit();
    } else {
        $mensagem = "Erro: Este e-mail já pode estar cadastrado.";
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conexao);
?>
<!DOCTYPE html>
<html lang="pt-br">

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
    
    <header>
    <a href="index.php" style="text-decoration: none; color: inherit;">
  <div class="logo">
    LMG
    <span>Streetwear</span>
  </div>
</a>
  </header>
<head>
    <title>Cadastro - IMG Streetwear</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="container">
        <div class="form-container">
            <h2 class="section-title">Crie sua Conta</h2>
            <?php if(!empty($mensagem)): ?><p style="color:red; text-align:center;"><?php echo $mensagem; ?></p><?php endif; ?>
            <form method="POST" action="cadastro.php">
                <input type="text" name="nome" placeholder="Nome Completo" required>
                <input type="email" name="email" placeholder="E-mail" required>
                <input type="password" name="senha" placeholder="Senha" required>
                <select name="tipo_usuario" required>
                    <option value="" disabled selected>Qual seu estilo?</option>
                    <option value="skatista">Skatista</option>
                    <option value="casual">Casual</option>
                    <option value="esportivo">Esportivo</option>
                </select>
                <button type="submit" class="btn" style="width:100%;">Cadastrar</button>
            </form>
            <p style="text-align:center; margin-top:20px;">Já tem uma conta? <a href="login.php">Faça login</a></p>
        </div>
    </main>
</body>
</html>