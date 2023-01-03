<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $t ?></title>
    <link href="/projet_finale/Code/style.css" rel="stylesheet">
    <link href="/projet_finale/Code/bootstrap-3.4.1-dist/css/bootstrap.css" rel="stylesheet">
</head>
<body>
<header class="main-header">
    <h1>I S I W E B 4 S H O P</h1>
</header>
<nav class="navbar top-navbar">
    <div class="navbar-nav">
      <a class="nav-item nav-link " href="#">Home</a>
      <a class="nav-item nav-link" href="#">Features</a>
      <a class="nav-item nav-link" href="#">Pricing</a>
      <a class="nav-item nav-link " href="#">Disabled</a>
    </div>
</nav>
    <main role="main">
        <div class="container">
            <?= $content ?>
        </div>
    </main>
</body>
<footer>
    <p>Créé par Nathan Dal Pian</p>
</footer>
<script src="/projet_finale/Code/code/bootstrap-3.4.1-dist/js/jquery-3.6.1.min.js" type="text/js"></script>
<script src="/projet_finale/Code/code/bootstrap-3.4.1-dist/js/bootstrap.min.js" type="text/js"></script>
</html>