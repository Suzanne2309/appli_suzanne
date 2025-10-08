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

