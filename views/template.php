<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $t ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="style.css?v=<?=rand(1,100000000)?>" rel="stylesheet" >
</head>
<body>

    <header class="main-header">
        <a href="index.php?url=acceuil">
            <h1>I S I W E B 4 S H O P</h1>
        </a>
    </header>

    <nav class="navbar navbar-expand-lg bg-light mb-4">
        <div class="container">
            <a class="navbar-brand">Notre offre :</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <?php
                        $categoryManager = new CategoryManager();
                        $categories = $categoryManager->getCategories();
                    ?>
                    <?php foreach ($categories as $category) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?url=produits&cat=<?= $category->getId(); ?>"><?= ucfirst($category->getName()); ?></a>
                        </li>
                    <?php endforeach;?>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?url=connexion">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Panier</a>
                    </li>
                </ul>
            </div>
      </div><!-- /.container-fluid -->
    </nav>
        <main role="main">
            <div class="container">
                <?= $content ?>
            </div>
        </main>
</body>
<footer class="d-none">
    <p>Créé par Nathan Dal Pian et Mano Raichon</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</html>