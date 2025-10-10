    <?php
function totalProducts() { //Cette fonction personnalisé permet d'afficher le compteur des quantités de produits totaux
    if (empty($_SESSION['products']) || !is_array($_SESSION['products'])) { // SI la session est vide OU que la session n'est pas sous forme de tableau 
        return 0; //ALORS on retourne 0
    }

    $tt = 0; //On met la variable total à zero
    foreach ($_SESSION['products'] as $product) { //POUR chaque produit du tableau products de la session
        if (isset($product['qtt'])) { //SI la variable product est déclarée et différente de null (isset)
            $tt += $product['qtt']; //ALORS la variable tt ajoutera la valeur quantité de chaque produit qui s'ajoute
        }
    }
    return $tt; //On retourne la nouvelle valeur des quantités de produits totaux (On met à jour)
}

