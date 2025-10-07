<?php
    session_start();
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
            </ul>
        </nav>
    </header>

    <main>
    <?php 
        if(!isset($_SESSION['products']) || empty($_SESSION['products'])){ //On va donner la priorité à !isset, donc s'il n'y a pas encore de session demmarré OU que l'a session est vide
            echo "<p>Aucun produit en session...</p>"; //ALORS on afffihce le message
        }
        else{ // SINON (si session déjà démarré et remplis) On affiche le tableau des produits
            echo "<table>",
                    "<thead>",
                        "<tr>",
                            "<th>Id</th>",
                            "<th>Nom</th>",
                            "<th>Prix</th>",
                            "<th>Quantité</th>",
                            "<th>Total</th>",
                        "</tr>",
                    "</thead>",
                    "<tbody>";
                    $totalGeneral = 0; //On met le totalGeneral à zero 
                    foreach($_SESSION['products'] as $index => $product){
                        echo "<tr>",
                                "<td>".$index."</td>",
                                "<td>".$product['name']."</td>",
                                "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>", // on fait appel à une fonction prédéfinie number_format qui va permettre d'adapter le format du prix (on appele la [valeur prix] de $product) à arroundir à 2 chiffres après la décimale qui sera séparé par ',' et on permet l'affichage de l'unité "€"
                                "<td>".$product['qtt']."</td>",
                                "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                                "<td><button>X</button></td>", //On crée un boutton de suppression qui sera donc crée pour chaque produit (pour delete un product unique)
                            "</tr>";
                            $totalGeneral+= $product['total']; //Le totalGeneral va augmenter à chaque total qui sera crée pour le nouveau $product ajouté
                    }
                    echo "<tr>",
                            "<td colspan=4>Total général : </td>", // colspan=4 donc la case Total général : va prendre 4 case de column sur sa ligne (row) donc on fait fussionner les 4 case sur 6
                            "<td><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</td>", 
                         "</tr>",
                    "</tbody>",
                    "</table>";

        }
    ?>

    <div class="totalProducts">
        <?php echo "<p>Total de produits ajoutés : " . totalProducts() . "</p>" ?>
    </div>

    </main>
</body>
</html>