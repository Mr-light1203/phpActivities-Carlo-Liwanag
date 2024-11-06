<?php
session_start();
include 'cart_helper.php'; 

// Fetch the total cart count
$cart_count = get_cart_count();

$items = [
    ["id" => 1, "name" => "Pink Dress", "price" => 650, "image" => "Shopping-cart/../imgs/Dress1.2.jpg", "image_hover" => "Shopping-cart/../imgs/Dress1.jpg"],
    ["id" => 2, "name" => "Red Dress", "price" => 650, "image" => "Shopping-cart/../imgs/Dress2.jpg", "image_hover" => "Shopping-cart/../imgs/Dress2.2.jpg"],
    ["id" => 3, "name" => "Black Dress", "price" => 750, "image" => "Shopping-cart/../imgs/Dress3.jpg", "image_hover" => "Shopping-cart/../imgs/Dress3.2.jpg"],
    ["id" => 4, "name" => "Blue Dress", "price" => 800, "image" => "Shopping-cart/../imgs/Dress4.jpg", "image_hover" => "Shopping-cart/../imgs/Dress4.2.jpg"],
    ["id" => 5, "name" => "Teal Dress", "price" => 800, "image" => "Shopping-cart/../imgs/Dress5.jpg", "image_hover" => "Shopping-cart/../imgs/Dress5.2.jpg"],
    ["id" => 6, "name" => "White Dress", "price" => 800, "image" => "Shopping-cart/../imgs/Dress6.jpg", "image_hover" => "Shopping-cart/../imgs/Dress6.2.jpg"],
    ["id" => 7, "name" => "Yellow Dress", "price" => 850, "image" => "Shopping-cart/../imgs/Dress7.jpg", "image_hover" => "Shopping-cart/../imgs/Dress7.2.jpg"],
    ["id" => 8, "name" => "Brown Dress", "price" => 650, "image" => "Shopping-cart/../imgs/Dress8.jpg", "image_hover" => "Shopping-cart/../imgs/Dress8.2.jpg"]
];

// Function to get cart item details
function get_cart_item_details($item_id) {
    global $items;
    foreach ($items as $item) {
        if ($item['id'] === $item_id) {
            return $item;
        }
    }
    return null;
}

// Calculate cart total
$total_price = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Dress to Impress</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fef6e4; /* Warm beige */
            color: #5a5a5a; /* Neutral text color */
        }
        .header {
            background-color: #ffcad4; /* Soft pink */
            color: #4a4a4a;
        }
        .header h1 {
            color: #4a4a4a; /* Darker text for contrast */
        }
        .cart-badge {
            font-size: 1.2rem;
            color: #fff;
            background-color: #f4a3b8; /* Soft pink */
            padding: 0.5rem 1rem;
            border-radius: 20px;
            text-decoration: none;
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        .cart-badge:hover {
            background-color: #0056b3;
        }
        .cart-count {
            background-color: #ffe4b5; /* Pastel orange */
            color: #4a4a4a;
            border-radius: 50%;
            font-size: 0.9rem;
            padding: 2px 7px;
            margin-left: 5px;
        }
        .cart-table th, .cart-table td {
            vertical-align: middle;
        }
        .cart-image {
            width: 60px;
            height: auto;
            border-radius: 5px;
        }
        .alert {
            border: 1px solid #c6c6c6;
            background-color: #f8f9fa;
        }
        .total-price {
            margin-left: -30px; /* Adjust this value for alignment */
        }
    </style>
</head>
<body>
    <header class="header py-3 mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h4 m-0">Dress to Impress</h1>
            <a href="cart.php" class="cart-badge">
                <i class="bi bi-cart"></i> Cart
                <span class="cart-count"><?php echo $cart_count; ?></span>
            </a>
        </div>
    </header>
    <div class="container">
        <h2 class="mb-4">Your Shopping Cart</h2>
        
        <?php if (empty($_SESSION['cart'])): ?>
            <div class="alert alert-secondary text-center py-4" role="alert">
                Your cart is currently empty.
            </div>
            <div class="text-center">
                <a href="index.php" class="btn btn-primary btn-lg"><i class="bi bi-arrow-left"></i> Continue Shopping</a>
            </div>
        <?php else: ?>
            <form action="update_cart.php" method="POST">
                <table class="table table-hover table-bordered cart-table">
                    <thead class="table-secondary">
                        <tr>
                            <th>Product</th>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['cart'] as $cart_item): ?>
                            <?php
                                $item_details = get_cart_item_details($cart_item['id']);
                                if ($item_details):
                                    $item_total = $item_details['price'] * $cart_item['quantity'];
                                    $total_price += $item_total;
                            ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo $item_details['image']; ?>" class="cart-image me-3 rounded shadow-sm" alt="<?php echo $item_details['name']; ?>">
                                        <span><?php echo $item_details['name']; ?></span>
                                    </div>
                                </td>
                                <td class="text-center"><?php echo isset($cart_item['size']) ? $cart_item['size'] : 'N/A'; ?></td>
                                <td class="text-center">
                                    <input type="number" name="quantity[<?php echo $cart_item['id']; ?>]" 
                                        value="<?php echo $cart_item['quantity']; ?>" 
                                        min="1" max="100" 
                                        class="form-control d-inline-block text-center" 
                                        style="width: 70px;">
                                </td>
                                <td>₱<?php echo number_format($item_details['price'], 2); ?></td>
                                <td>₱<?php echo number_format($item_total, 2); ?></td>
                                <td class="text-center">
                                    <a href="remove_confirm.php?product_id=<?php echo $cart_item['id']; ?>" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <a href="index.php" class="btn btn-outline-primary"><i class="bi bi-arrow-left"></i> Continue Shopping</a>
                        <button type="submit" class="btn btn-success"><i class="bi bi-arrow-repeat"></i> Update Cart</button>
                        <a href="success.php" class="btn btn-primary"><i class="bi bi-credit-card"></i> Checkout</a>
                    </div>
                    <h4 class="total-price">Total: <span class="text-success">₱<?php echo number_format($total_price, 2); ?></span></h4>
                </div>
            </form>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
