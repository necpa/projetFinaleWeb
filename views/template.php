<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $t ?></title>
    <link href="/projetFinaleWeb/style.css" rel="stylesheet">
    <link href="/projetFinaleWeb/bootstrap-3.4.1-dist/css/bootstrap.css" rel="stylesheet">
</head>
<body>
<header class="main-header">
    <h1>I S I W E B 4 S H O P</h1>
</header>
<nav class="navbar navbar-default ">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand">Notre offre :</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="index.php?url=boissons">Boissons <span class="sr-only"></span></a></li>
        <li><a href="index.php?url=biscuits">Biscuits <span class="sr-only"></span></a></li>
        <li><a href="index.php?url=fruitssecs">Fruits Secs</a></li>
        
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Connexion</a></li>
        <li>
          <a href="#" aria-expanded="false">Panier</a>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
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
<script src="/projetFinaleWeb/bootstrap-3.4.1-dist/js/jquery-3.6.1.min.js" type="text/js"></script>
<script src="/projetFinaleWeb/bootstrap-3.4.1-dist/js/bootstrap.min.js" type="text/js"></script>
</html>