<?php
session_start();

if (isset($_POST['quantity'])) {
    foreach ($_POST['quantity'] as $id => $quantity) {
        foreach ($_SESSION['cart'] as &$cart_item) {
            if ($cart_item['id'] == $id) {
                // Cap the quantity at 100 and ensure it's at least 1
                $cart_item['quantity'] = min(100, max(1, (int)$quantity));
            }
        }
    }
}

header("Location: cart.php");
exit;