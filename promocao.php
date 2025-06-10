<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Sapato Casual em Promoção</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background: #f4f4f4;
      color: #333;
    }

    header {
      background: #0b1a3d;
      color: white;
      padding: 1em;
      text-align: center;
    }

    .container {
      max-width: 800px;
      margin: 2em auto;
      background: white;
      padding: 2em;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .product {
      display: flex;
      flex-wrap: wrap;
      gap: 2em;
    }

    .product img {
      width: 100%;
      max-width: 350px;
      border-radius: 8px;
    }

    .product-details {
      flex: 1;
    }

    .product-details h1 {
      font-size: 2em;
      margin-bottom: 0.5em;
    }

    .price-original {
      text-decoration: line-through;
      color: #888;
      font-size: 1.2em;
    }

    .price-promo {
      color: #e60000;
      font-size: 1.8em;
      font-weight: bold;
    }

    .btn-comprar {
      display: inline-block;
      margin-top: 1em;
      padding: 0.7em 1.5em;
      background-color: #0b1a3d;
      color: white;
      border: none;
      border-radius: 5px;
      text-decoration: none;
      font-size: 1em;
      cursor: pointer;
      transition: background 0.3s;
    }

    .btn-comprar:hover {
      background-color: #1e2e5f;
    }
  </style>
</head>
<body>

  <header>
    <h2><a href="index.php" style="color: white; text-decoration: none;">LMG Streetwear</a></h2>
  </header>

  <div class="container">
    <div class="product">
      <img src="img/sapato_promocao.jpg" alt="Sapato Casual">
      <div class="product-details">
        <h1>Sapato Casual Masculino</h1>
        <p class="price-original">De: R$ 229,90</p>
        <p class="price-promo">Por: R$ 149,90</p>
        <p>Ideal para ocasiões casuais com muito estilo. Confortável, moderno e com acabamento de alta qualidade.</p>
        <a href="pagamento.php?produto=sapato_casual&valor=149.90" class="btn-comprar">Comprar agora</a>
      </div>
    </div>
  </div>

</body>
</html>
