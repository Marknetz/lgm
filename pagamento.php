<?php
session_start();

$produto = $_GET['produto'] ?? 'Produto não informado';
$valor = $_GET['valor'] ?? '0.00';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Pagamento - LMG Streetwear</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      background-color: #f4f4f4;
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

    .logo a {
      text-decoration: none;
      color: white;
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

    .container {
      max-width: 600px;
      margin: 3em auto;
      background: white;
      padding: 2em;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    h1 {
      text-align: center;
      margin-bottom: 1em;
      color: #0b1a3d;
    }

    .resumo {
      background-color: #f0f0f0;
      padding: 1em;
      border-radius: 8px;
      margin-bottom: 2em;
    }

    label {
      display: block;
      margin-top: 1em;
    }

    input {
      width: 100%;
      padding: 0.7em;
      margin-top: 0.5em;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .btn-finalizar {
      background-color: #0b1a3d;
      color: white;
      padding: 1em;
      width: 100%;
      border: none;
      border-radius: 5px;
      font-size: 1em;
      margin-top: 2em;
      cursor: pointer;
      transition: background 0.3s;
    }

    .btn-finalizar:hover {
      background-color: #1e2e5f;
    }
  </style>
</head>
<body>

  <header>
    <div class="logo">
      <a href="index.php">LMG</a>
      <span>Streetwear</span>
    </div>
    <div class="search-login">
      <input type="text" class="search-box" placeholder="Buscar tênis..." />
      <?php if (!isset($_SESSION['usuario_id'])): ?>
        <a href="login.php" class="btn">Login</a>
        <a href="cadastro.php" class="btn">Cadastro</a>
      <?php else: ?>
        <a href="logout.php" class="btn">Sair</a>
      <?php endif; ?>
    </div>
  </header>

  <div class="container">
    <h1>Pagamento</h1>

    <div class="resumo">
      <p><strong>Produto:</strong> <?php echo htmlspecialchars($produto); ?></p>
      <p><strong>Valor:</strong> R$ <?php echo number_format((float)$valor, 2, ',', '.'); ?></p>
      <p><strong>Frete:</strong> R$ 20,00</p>
      <p><strong>Total:</strong> R$ <?php echo number_format((float)$valor + 20, 2, ',', '.'); ?></p>
    </div>

    <form action="confirmar_pagamento.php" method="POST">
      <input type="hidden" name="produto" value="<?php echo htmlspecialchars($produto); ?>">
      <input type="hidden" name="valor" value="<?php echo htmlspecialchars($valor); ?>">

      <label>Nome completo:</label>
      <input type="text" name="nome" required>

      <label>Endereço:</label>
      <input type="text" name="endereco" required>

      <label>CEP:</label>
      <input type="text" name="cep" required>

      <label>Forma de pagamento:</label>
      <input type="text" name="pagamento" placeholder="Cartão de crédito, boleto..." required>

      <button type="submit" class="btn-finalizar">Finalizar Compra</button>
    </form>
  </div>

</body>
</html>
