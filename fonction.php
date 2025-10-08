    <?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function totalProducts(): int {
    if (empty($_SESSION['products']) || !is_array($_SESSION['products'])) {
        return 0;
    }

    $tt = 0;
    foreach ($_SESSION['products'] as $product) {
        if (isset($product['qtt'])) {
            $tt += (int) $product['qtt'];
        }
    }
    return $tt;
}

/*
    if(!isset($_SESSION)) { //Pour que l'index puisse accéder correctement à la session active on va lui dire de créer une nouvelle session pour relier à la session active
        session_start();
        function totalProducts(){
        $tt = 0;
        foreach($_SESSION['products'] as $product){
        $tt += $product['qtt'];
        }
        return $tt;
        }
    }
    else { //Sinon on execute simplement la fonction
        function totalProducts(){
        $tt = 0;
        foreach($_SESSION['products'] as $product){
        $tt += $product['qtt'];
        };
        return $tt;
        }
    }
*/

