<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LMG Streetwear</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
</head>
<body>
  <header>
    <a href="index.php" style="text-decoration: none; color: inherit;">
  <div class="logo">
    LMG
    <span>Streetwear</span>
  </div>
</a>
    <div class="search-login">
      <form method="get" action="pesquisa.php" style="display: flex; align-items: center;">
    <input type="text" name="publico" class="search-box" placeholder="Casual, Esportivo ou Skate" required />
    <button type="submit" class="btn">Buscar</button>
      </form>


      <?php if (!isset($_SESSION['usuario_id'])): ?>
        <a href="login.php" class="btn">Login</a>
        <a href="cadastro.php" class="btn">Cadastro</a>
      <?php else: ?>
        <a href="logout.php" class="btn">Sair</a>
      <?php endif; ?>
    </div>
  </header>

  <?php if (!isset($_SESSION['usuario_id'])): ?>
    <div class="user-nav">
      <strong>Bem-vindo!</strong> Faça login ou cadastre-se para ver recomendações personalizadas.
    </div>
  <?php endif; ?>

  <section class="main-content">
    <div class="card">
      <img src="img/skate1.jpeg" alt="Homem andando de skate" />
      <a href="saiba_mais.html" class="btn">Saiba mais</a>
    </div>
    <div class="card">
      <img src="img/tenis_lancamento.jpg" alt="Tênis streetwear lançamento" />
      <a href="promocao.php" class="btn">Lançamentos</a>
    </div>
  </section>

  <section style="padding: 0 2em;">
    <h2>Veja mais</h2>
    <div class="carousel">
      <a href="#"><img src="img/skate2.jpeg" alt="skate2" /></a>
      <a href="#"><img src="img/skate5.jpeg" alt="skate5" /></a>
      <a href="#"><img src="img/skate3.jpeg" alt="skate3" /></a>
      <a href="#"><img src="img/tenis2.jpg" alt="tenis2" /></a>
      <a href="#"><img src="img/esportivo1.jpeg" alt="tenis3" /></a>
      <a href="#"><img src="img/esportivo5.jpeg" alt="tenis5" /></a>
    </div>
  </section>

  <?php if (isset($_SESSION['usuario_id'])): ?>
    <section style="padding: 0 2em;">
      <h2>Especialmente para Você, <?php echo htmlspecialchars(explode(' ', $_SESSION['usuario_nome'])[0]); ?>!</h2>
      <div class="product-grid">
        <?php
        include 'conexao.php';
        $tipo_usuario = $_SESSION['tipo_usuario'];
        $sql = "SELECT nome, descricao, imagem FROM calcados WHERE publico_alvo = ? LIMIT 5";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "s", $tipo_usuario);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        while($calcado = mysqli_fetch_assoc($resultado)):
        ?>
          <div class="product-card">
            <img src="img/<?php echo htmlspecialchars($calcado['imagem']); ?>" alt="<?php echo htmlspecialchars($calcado['nome']); ?>">
            <h3><?php echo htmlspecialchars($calcado['nome']); ?></h3>
          </div>
        <?php endwhile;
        mysqli_stmt_close($stmt);
        mysqli_close($conexao);
        ?>
      </div>
    </section>
  <?php endif; ?>

  <div class="veja-mais">
    <a href="#">Veja mais produtos</a>
  </div>
</body>
</html>
