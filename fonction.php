    <?php
if (session_status() === PHP_SESSION_NONE) { //SI le statut de la session est strictement égale à pas de session existante
    session_start(); //ALORS on démarre une session (Comme index ne démarre pas la session, il n'accède pas au tableau products quand ile st crée, du coup il affichera toujours 0 puisqu'il n'y a pas de tableau pour lui)
}

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

