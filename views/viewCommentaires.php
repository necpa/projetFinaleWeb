<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $t ?></title>
    <link href="/projetFinaleWeb/bootstrap-3.4.1-dist/css/bootstrap.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <h1>Commentaires :</h1>
    <?php foreach ($reviews as $review) : ?>
        <?php if ($review->getIdProduct() == $_GET['id']) : ?>
            <div>
                <img class="photoProfil ligne" src="productimages/<?php echo($review->getPhotoUser())?>">
                <b><p class="ligne color-white"><?= $review->getNameUser()?> :</p></b>
                <p class="ligne"><?= $review->getTitle()?></p>
                <?php if ($review->getStars() == 5) :?>
                    <img class="etoile" src="productimages/review_star.png">
                    <img class="etoile" src="productimages/review_star.png">
                    <img class="etoile" src="productimages/review_star.png">
                    <img class="etoile" src="productimages/review_star.png">
                    <img class="etoile" src="productimages/review_star.png">
                <?php endif; ?>
                <?php if ($review->getStars() == 4) :?>
                    <img class="etoile" src="productimages/review_star.png">
                    <img class="etoile" src="productimages/review_star.png">
                    <img class="etoile" src="productimages/review_star.png">
                    <img class="etoile" src="productimages/review_star.png">
                    <img class="etoile" src="productimages/review_gray.png">
                <?php endif; ?>
                <?php if ($review->getStars() == 3) :?>
                    <img class="etoile" src="productimages/review_star.png">
                    <img class="etoile" src="productimages/review_star.png">
                    <img class="etoile" src="productimages/review_star.png">
                    <img class="etoile" src="productimages/review_gray.png">
                    <img class="etoile" src="productimages/review_gray.png">
                <?php endif; ?>
                <?php if ($review->getStars() == 2) :?>
                    <img class="etoile" src="productimages/review_star.png">
                    <img class="etoile" src="productimages/review_star.png">
                    <img class="etoile" src="productimages/review_gray.png">
                    <img class="etoile" src="productimages/review_gray.png">
                    <img class="etoile" src="productimages/review_gray.png">
                <?php endif; ?>
                <?php if ($review->getStars() == 1) :?>
                    <img class="etoile" src="productimages/review_star.png">
                    <img class="etoile" src="productimages/review_gray.png">
                    <img class="etoile" src="productimages/review_gray.png">
                    <img class="etoile" src="productimages/review_gray.png">
                    <img class="etoile" src="productimages/review_gray.png">
                <?php endif; ?>
                <?php if ($review->getStars() == 0) :?>
                    <img class="etoile" src="productimages/review_gray.png">
                    <img class="etoile" src="productimages/review_gray.png">
                    <img class="etoile" src="productimages/review_gray.png">
                    <img class="etoile" src="productimages/review_gray.png">
                    <img class="etoile" src="productimages/review_gray.png">
                <?php endif; ?>


            </div>
            <?= $review->getDescription()?>
            <br><br>



        <?php endif; ?>
    <?php endforeach; ?>


</body>