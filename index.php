<?php 
    require('fonction.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout produit</title>
    <link rel="stylesheet" href="css/ajout.css">
</head>
<body>
<!--La page index va être la première page qui sera affiché et qui aura le formulaire pour ajouter un produit-->
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Ajout produits</a></li>
                <li><a href="recap.php">Liste produits</a></li>
                <li><svg class="basket" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M320 64C326.6 64 332.9 66.7 337.4 71.5L481.4 223.5L481.9 224L560 224C577.7 224 592 238.3 592 256C592 270.5 582.4 282.7 569.2 286.7L523.1 493.9C516.6 523.2 490.6 544 460.6 544L179.3 544C149.3 544 123.3 523.2 116.8 493.9L70.8 286.7C57.6 282.8 48 270.5 48 256C48 238.3 62.3 224 80 224L158.1 224L158.6 223.5L302.6 71.5C307.1 66.7 313.4 64 320 64zM320 122.9L224.2 224L415.8 224L320 122.9zM240 328C240 314.7 229.3 304 216 304C202.7 304 192 314.7 192 328L192 440C192 453.3 202.7 464 216 464C229.3 464 240 453.3 240 440L240 328zM320 304C306.7 304 296 314.7 296 328L296 440C296 453.3 306.7 464 320 464C333.3 464 344 453.3 344 440L344 328C344 314.7 333.3 304 320 304zM448 328C448 314.7 437.3 304 424 304C410.7 304 400 314.7 400 328L400 440C400 453.3 410.7 464 424 464C437.3 464 448 453.3 448 440L448 328z"/></svg>
                    <?php echo "<p class='basket_tt'>" . totalProducts() . "</p>" ?> <!--On va afficher le total des produits (la quantité total) enregistré sur la session en faisant appelle à la fonction qui le calcul-->
                </li>
            </ul>
        </nav>
    </header>

    <main>
    <div class="form">
        <h1>Ajouter un produit</h1>
        <form action="traitement.php" method="post"> <!--action permet d'indiquer le chemin à prendre lorsque l'on interagit avec le formulaire (method = post)-->
            <p>
                <label>
                    Nom du produit :
                    <input type="text" name="name">
                </label>
            </p>
            <p>
                <label>
                    Prix du produit :
                    <input type="number" step="any" name="price">
                </label>
            </p>
            <p>
                <label>
                    Quantité désirée :
                    <input type="number" name="qtt" value="1">
                </label>
            </p>
            <p>
                <input class="submit" type="submit" name="submit" value="Ajouter le produit"> <!--Le bouton submit va permettre de d'envoyer les réponses des champs pour être traité ensuite-->
            </p>
        </form>
    </div>

    </main>

</body>
</html>