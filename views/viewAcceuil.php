<?php   $this->_t = 'Mon Blog';
foreach ($products as $product) : ?>
<div class="row">
    <div class="col-md-2">
        <img class="image-product" src=<?= "productimages/".$product->getImage(); ?>>
    </div>
    <div class ="col-md-8">
        <h1><?= $product->getName(); ?></h1>
        <p><?= $product->getDescription(); ?></p>
        <h3>Notre prix : <?= $product->getPrice(); ?> €</h3>
    </div>
</div>
<?php endforeach; ?>