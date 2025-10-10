<?php
    session_start(); //On fait appel à une fonction native et prédéfinis pour démarrer la session. Cela permet aussi d'enregistrer les ajouts sur le serveur.
    require('fonction.php'); //On appelle le fichier fonction pour pouvoir utiliser la fonction de produits totaux dans le panier

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif des produits</title>
    <link rel="stylesheet" href="css/liste.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Ajout produits</a></li>
                <li><a href="recap.php">Liste produits</a></li>
                <li><svg class="basket" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M320 64C326.6 64 332.9 66.7 337.4 71.5L481.4 223.5L481.9 224L560 224C577.7 224 592 238.3 592 256C592 270.5 582.4 282.7 569.2 286.7L523.1 493.9C516.6 523.2 490.6 544 460.6 544L179.3 544C149.3 544 123.3 523.2 116.8 493.9L70.8 286.7C57.6 282.8 48 270.5 48 256C48 238.3 62.3 224 80 224L158.1 224L158.6 223.5L302.6 71.5C307.1 66.7 313.4 64 320 64zM320 122.9L224.2 224L415.8 224L320 122.9zM240 328C240 314.7 229.3 304 216 304C202.7 304 192 314.7 192 328L192 440C192 453.3 202.7 464 216 464C229.3 464 240 453.3 240 440L240 328zM320 304C306.7 304 296 314.7 296 328L296 440C296 453.3 306.7 464 320 464C333.3 464 344 453.3 344 440L344 328C344 314.7 333.3 304 320 304zM448 328C448 314.7 437.3 304 424 304C410.7 304 400 314.7 400 328L400 440C400 453.3 410.7 464 424 464C437.3 464 448 453.3 448 440L448 328z"/></svg>
                    <?php echo "<p class='basket_tt'>" . totalProducts() . "</p>" ?> <!-- On va afficher le résultat de la fonction totalProducts -->
                </li>
            </ul>
        </nav>
    </header>

    <main>
    <?php
        if(!isset($_SESSION['products']) || empty($_SESSION['products'])){ //On va donner la priorité à !isset, donc s'il n'y a pas encore de session demmarré OU que l'a session est vide
            echo "<p class='noproduct'>Aucun produit en session...</p>"; //ALORS on afffihce le message
        }
        else{ // SINON (si session déjà démarré et remplis) On affiche le tableau des produits
            echo "<table>",
                    "<thead>",
                        "<tr>",
                            "<th>Id</th>",
                            "<th>Nom</th>",
                            "<th>Prix</th>",
                            "<th colspan=3>Quantité</th>", //colspan va permettre que ce th prend la place de 3 cases de colonne sur la ligne table head, ICI on veut que le titre quantité soit égale aux boutons + et - et à la valeur quantité
                            "<th>Total</th>",
                        "</tr>",
                    "</thead>",
                    "<tbody>";
                    $totalGeneral = 0; //On met le totalGeneral à zero 
                    foreach($_SESSION['products'] as $index => $product){  //On va utiliser une boucle foreach donc dans le tableau products (tableau associatif) on crée une ligne pour chaque nouveau produit (valeur) ajouté avec un index propre à lui (key)
                        echo "<tr>",
                                "<td>".$index."</td>", //On définis la clé index
                                "<td>".$product['name']."</td>", //On définis le nom du produit
                                "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>", //On fait appel à une fonction prédéfinie number_format qui va permettre d'adapter le format du prix (on appele la [valeur prix] de $product) à arroundir à 2 chiffres après la décimale qui sera séparé par ',' et on permet l'affichage de l'unité "€"
                                "<td><a href='traitement.php?action=qtt-up&id=" . $index . "'>+</a></td>", //On va crée un "bouton" (il sera stylisé en CSS) + avec une balise html anchor pour relier l'action qtt-up de notre fonction SWITCH de la page traitement
                                "<td>".$product['qtt']."</td>", //On définis la variable quantité
                                "<td><a href='traitement.php?action=qtt-down&id=" . $index . "'>-</a></td>", //On va crée un bouton + avec une balise html anchor pour relier l'action qtt-down de notre fonction SWITCH de la page traitement
                                "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€</td>", //On fait appel à une fonction prédéfinie number_format qui va permettre d'adapter le format du prix total (on appele la [valeur total] de $product) à arroundir à 2 chiffres après la décimale qui sera séparé par ',' et on permet l'affichage de l'unité "€"
                                "<td><a href='traitement.php?action=delete&id=" . $index . "'>X</a></td>", //On va crée un "bouton" (il sera stylisé en CSS) X avec une balise html anchor pour relier l'action delete de notre fonction SWITCH de la page traitement
                            "</tr>";
                            $totalGeneral+= $product['total']; //Le totalGeneral va augmenter à chaque total qui sera crée pour le nouveau $product ajouté
                    }
                    echo "<tr>",
                            "<td colspan=4>Total général : </td>", // colspan=4 donc la case Total général : va prendre 4 case de column sur sa ligne (row) donc on fait fussionner les 4 case sur 6
                            "<td><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</td>", //On fait appel à une fonction prédéfinie number_format qui va permettre d'adapter le format du prix total du tableau (on appele la variable totalGeneral) à arroundir à 2 chiffres après la décimale qui sera séparé par ',' et on permet l'affichage de l'unité "€"
                            "<td><a href='traitement.php?action=clear'>C</a></td>", //On va crée un "bouton" (il sera stylisé en CSS) C avec une balise html anchor pour relier l'action clear de notre fonction SWITCH de la page traitement
                         "</tr>",
                    "</tbody>",
                    "</table>";
                    //On va ajouter la fonction message qui va permettre de créer une balise html p pour afficher notre message en cas d'utilisation du SWITCH case delete
                    if (isset($_SESSION['message'])) { //SI la variable du tableau message de la session est différente de null et définit 
                    echo "<p class='notification'>" . $_SESSION['message'] . "</p>"; //ALORS on affiche (echo) la balise p contenant le message 
                    unset($_SESSION['message']); //Puis on vide le tableau message si on rafraichit la page/ferme le navigateur ou qu'on supprime le cookie de la session
                    }
        }
    ?>

    </main>
</body>
</html>