<?php
session_start();
include 'cart_helper.php';

// List of items
$items = [
    ["id" => 1, "name" => "Pink Dress", "price" => 650, "image" => "Shopping-cart/../imgs/Dress1.2.jpg", "image_hover" => "Shopping-cart/../imgs/Dress1.jpg", "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."],
    ["id" => 2, "name" => "Red Dress", "price" => 650, "image" => "Shopping-cart/../imgs/Dress2.jpg", "image_hover" => "Shopping-cart/../imgs/Dress2.2.jpg", "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."],
    ["id" => 3, "name" => "Black Dress", "price" => 750, "image" => "Shopping-cart/../imgs/Dress3.jpg", "image_hover" => "Shopping-cart/../imgs/Dress3.2.jpg", "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."],
    ["id" => 4, "name" => "Blue Dress", "price" => 800, "image" => "Shopping-cart/../imgs/Dress4.jpg", "image_hover" => "Shopping-cart/../imgs/Dress4.2.jpg", "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."],
    ["id" => 5, "name" => "Teal Dress", "price" => 800, "image" => "Shopping-cart/../imgs/Dress5.jpg", "image_hover" => "Shopping-cart/../imgs/Dress5.2.jpg", "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."],
    ["id" => 6, "name" => "White Dress", "price" => 800, "image" => "Shopping-cart/../imgs/Dress6.jpg", "image_hover" => "Shopping-cart/../imgs/Dress6.2.jpg", "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."],
    ["id" => 7, "name" => "Yellow Dress", "price" => 850, "image" => "Shopping-cart/../imgs/Dress7.jpg", "image_hover" => "Shopping-cart/../imgs/Dress7.2.jpg", "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."],
    ["id" => 8, "name" => "Brown Dress", "price" => 650, "image" => "Shopping-cart/../imgs/Dress8.jpg", "image_hover" => "Shopping-cart/../imgs/Dress8.2.jpg", "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."]
];

// Get item ID from URL
$item_id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$item = null;

// Find item by ID
foreach ($items as $product) {
    if ($product['id'] === $item_id) {
        $item = $product;
        break;
    }
}

// If item not found, redirect to main page
if (!$item) {
    header("Location: index.php");
    exit;
}

// Calculate total item count in the cart (sum of quantities)
$cart_count = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $cart_item) {
        $cart_count += $cart_item['quantity'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $item['name']; ?> - Dress to Impress</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
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

<!-- Product Details Section -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-5">
            <div class="product-image mb-4">
                <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" class="normal shadow-sm rounded">
                <img src="<?php echo $item['image_hover']; ?>" alt="<?php echo $item['name']; ?>" class="hover shadow-sm rounded">
            </div>
        </div>
        <div class="col-md-7">
            <h2 class="fw-bold"><?php echo $item['name']; ?> <span class="badge bg-warning">₱<?php echo number_format($item['price'], 2); ?></span></h2>
            <p class="text-muted mt-3"><?php echo $item['description']; ?></p>

            <form action="confirm.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                
                <h4 class="mt-4">Select Size:</h4>
                <div class="mb-3">
                    <label class="form-check-label me-2"><input type="radio" name="size" value="XS" checked> XS</label>
                    <label class="form-check-label me-2"><input type="radio" name="size" value="S"> S</label>
                    <label class="form-check-label me-2"><input type="radio" name="size" value="M"> M</label>
                    <label class="form-check-label me-2"><input type="radio" name="size" value="L"> L</label>
                    <label class="form-check-label"><input type="radio" name="size" value="XL"> XL</label>
                </div>

                <h4>Enter Quantity:</h4>
                <input type="number" class="form-control w-25 mb-3" name="quantity" value="1" min="1" max="100">


                <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Confirm Product Purchase</button>
                <a href="index.php" class="btn btn-outline-secondary ms-2"><i class="bi bi-arrow-left"></i> Cancel/Go Back</a>
            </form>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #fef6e4; 
        color: #5a5a5a; 
    }
    .header {
        background-color: #ffcad4; /* Soft pink */
        color: #4a4a4a;
    }
    .header h1 {
        color: #4a4a4a; /* Darker text for contrast */
    }



    .product-image {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        cursor: pointer;
        height: 450px;
        width: 100%;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: opacity 0.5s ease, transform 0.3s ease;
    }

    .product-image img.hover {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
    }

    .product-image:hover img.normal {
        opacity: 0;
    }

    .product-image:hover img.hover {
        opacity: 1;
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
</style>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
