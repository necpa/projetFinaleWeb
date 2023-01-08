    <a href="index.php?url=commentaires&id=<?php echo($product->getId())?>">
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="<?= "productimages/".$product->getImage(); ?>" class="img-fluid rounded-start" alt="...">

                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?= $product->getName(); ?></h5>
                        <p class="card-text"><?= $product->getDescription(); ?></p>
                        <p class="card-text"><small class="text-muted">Notre prix : <?= $product->getPrice(); ?> €</small></p>
                    </div>
                </div>
            </div>
        </div>
    </a>
    <h1>Commentaires :</h1>
    <?php foreach ($reviews as $review) : ?>

            <div class="commentaire">
                <div>
                    <img class="photoProfil ligne" src="productimages/<?php echo($review->getPhotoUser())?>">
                    <b><p class="ligne"><?= $review->getNameUser()?> :</p></b>
                    <p class="ligne"><?= $review->getTitle()?></p>

                    <?php for ($i=0; $i < $review->getStars(); $i++): ?>
                        <img class="etoile" src="productimages/review_star.png">
                    <?php endfor; ?>
                    <?php for ($i=5; $i > $review->getStars(); $i--): ?>
                        <img class="etoile" src="productimages/review_gray.png">
                    <?php endfor; ?>

                </div>

                <?= $review->getDescription()?>

            </div>
    <?php endforeach; ?>
    <div class="card w-50 mb-3">
        <div class="card-header ">
            Donnez votre avis sur ce produit :
        </div>
        <div class="card-body">
            <form method="get">
                <div class="row">
                    <div class="mb-3">
                        <div>
                            <input value="1" name=note type=radio required>
                            <label>1 <img class="photoProfil" src="productimages/review_star.png"></label>
                            <input value="2" name=note type=radio>
                            <label>2 <img class="photoProfil" src="productimages/review_star.png"></label>
                            <input value="3" name=note type=radio>
                            <label>3 <img class="photoProfil" src="productimages/review_star.png"></label>
                            <input value="4" name=note type=radio>
                            <label>4 <img class="photoProfil" src="productimages/review_star.png"></label>
                            <input value="5" name=note type=radio>
                            <label>5 <img class="photoProfil" src="productimages/review_star.png"></label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="col-12 col-lg-4 col-xl-4 col-md-4 col-sm-4 row">
                            <label class="form-label col">Prénom :</label>
                            <input type="text" name="prenom" class="form-control col" maxlength="10" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="mb-3">
                            <input type="radio" value="homme.jpg" name="genre" required>
                            <label>Homme</label>
                            <input type="radio" value="femme.png" name="genre" >
                            <label>Femme</label>
                        </div>
                        <div class="mb-3">
                            <div class="col-12 col-lg-3 col-xl-3 row">
                                <label class="form-label col">Titre :</label>
                                <input type="text" name="titre" class="form-control col" maxlength="10" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-12 col-lg-5 col-xl-5">
                                <label class="form-label">Commentaire :</label>
                                <textarea id="comments" name="commentaire" class="form-control" maxlength="140" required></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-lg-1 col-xl-1">
                            <button type="submit" name="submit" class="btn btn-primary">Commenter</button>
                        </div>
                    </div>
                    <input class="d-none" type="text" name="url" value="commentaires">
                    <input class="d-none" type="text" name="id" value="<?= $product->getId()?>">
            </form>
        </div>
    </div>
    <?php
        // Vérifier si le formulaire est soumis
        if ( isset( $_GET['submit'] ) ) {
             /*récupérer les données du formulaire en utilisant
               la valeur des attributs name comme clé*/

            $note = $_GET['note'];

            $prenom = $_GET['prenom'];
            $prenom = '"' . $prenom . '"';

            $genre = $_GET['genre'];
            $genre = '"' . $genre . '"';

            $titre = $_GET['titre'];
            $titre = '"' . $titre . '"';

            $commentaire = $_GET['commentaire'];
            $commentaire = '"' . $commentaire . '"';

            $url = $_GET['url']; //Pour conserver les atributs url/id dans le lien
            $id = $_GET['id']; // (à voir avec Robin)


            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "web4shop";

            // Créer une conexion
            $conn = new mysqli($servername, $username, $password, $dbname);
            // verifier la connexion
            if ($conn->connect_error) {
                die("La connexion a échouée: " . $conn->connect_error);
            }

            $sql = "INSERT INTO `reviews` VALUES($id, $prenom, $genre, $note, $titre, $commentaire)";

            if ($conn->query($sql) === TRUE) {
                echo "Votre commentaire a été publié avec succes";

            } else {
                echo "Erreur: " . $sql . "
" . $conn->error;
            }

            $conn->close();

        }
    ?>
