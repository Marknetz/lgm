<?php
include 'conexao.php';

$publico = strtolower(trim($_GET['publico'] ?? ''));
$validos = ['casual', 'esportivo', 'skate'];

if (!in_array($publico, $validos)) {
  echo "<h2 style='text-align:center;'>Categoria inválida. Use: casual, esportivo ou skate.</h2>";
  exit;
}

$sql = "SELECT nome, descricao, imagem FROM calcados WHERE publico_alvo = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "s", $publico);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html lang="pt-BR">
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
  <meta charset="UTF-8">
  <title>Calçados - <?= ucfirst($publico) ?></title>
  <style>
    body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 2em; }
    h1 { text-align: center; color: #0b1a3d; }
    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1.5em;
      margin-top: 2em;
    }
    .item {
      background: white;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      padding: 1em;
      text-align: center;
    }
    .item img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 1em;
    }
    .item h3 {
      margin-bottom: 0.5em;
      color: #0b1a3d;
    }
    .item p {
      font-size: 0.95em;
      color: #333;
    }
  </style>
</head>
<body>
  <h1>Calçados - Público: <?= ucfirst($publico) ?></h1>
  <div class="grid">
    <?php while($item = mysqli_fetch_assoc($resultado)): ?>
      <div class="item">
        <img src="img/<?= htmlspecialchars($item['imagem']) ?>" alt="<?= htmlspecialchars($item['nome']) ?>">
        <h3><?= htmlspecialchars($item['nome']) ?></h3>
        <p><?= htmlspecialchars($item['descricao']) ?></p>
      </div>
    <?php endwhile; ?>
  </div>
</body>
</html>
<?php
mysqli_stmt_close($stmt);
mysqli_close($conexao);
?>
