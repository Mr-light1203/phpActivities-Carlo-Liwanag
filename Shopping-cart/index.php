<?php
session_start();
include 'cart_helper.php';
// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// List of items
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

// Calculate total item count in the cart (sum of quantities)
$cart_count = 0;
foreach ($_SESSION['cart'] as $cart_item) {
    $cart_count += $cart_item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dress to Impress</title>
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

<main class="container mt-4">
    <div class="row g-4">
        <?php foreach ($items as $item): ?>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card product-card shadow-sm border-0" onclick="window.location.href='details.php?id=<?php echo $item['id']; ?>'">
                <div class="card-img-top position-relative">
                    <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" class="img-fluid normal">
                    <img src="<?php echo $item['image_hover']; ?>" alt="<?php echo $item['name']; ?>" class="img-fluid hover position-absolute top-0 start-0">
                </div>
                    <div class="card-body">
                        <p class="card-title fw-bold"><?php echo $item['name']; ?></p>
                        <p class="card-text text-muted mb-4 price-highlight">₱<span><?php echo number_format($item['price'], 2); ?></span></p>
                        <div class="add-to-cart-overlay">
                            <i class="bi bi-cart"></i> Add to Cart
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<style>
    /* General body background */
    body {
        background-color: #fef6e4; /* Warm beige */
        color: #5a5a5a; /* Neutral text color */
    }

    /* Header styling */
    .header {
        background-color: #ffcad4; /* Soft pink */
        color: #4a4a4a;
    }

    .header h1 {
        color: #4a4a4a; /* Darker text for contrast */
    }

    /* Cart badge */
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

    .cart-count {
        background-color: #ffe4b5; /* Pastel orange */
        color: #4a4a4a;
        border-radius: 50%;
        font-size: 0.9rem;
        padding: 2px 7px;
        margin-left: 5px;
    }
    .cart-badge:hover {
        background-color: #0056b3;
    }

    /* Product card */
    .product-card {
        position: relative;
        overflow: hidden;
        border: 1px solid #d1e8e4; /* Light border */
        border-radius: 5px;
        cursor: pointer;
        transition: transform 0.2s ease;
        background-color: #e8f8f5; /* Light mint */
    }

    .product-card:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .product-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: opacity 0.5s ease;
    }

    .product-card img.hover {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
    }

    .product-card:hover img.normal {
        opacity: 0;
    }

    .product-card:hover img.hover {
        opacity: 1;
    }

    /* Price text */
    .price-highlight span {
        font-size: 1.2rem;
        font-weight: bold;
        color: #ff6f61; /* Coral */
    }

    /* Add to cart overlay */
    .add-to-cart-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(0, 128, 255, 0.8); /* Pastel blue */
        color: white;
        text-align: center;
        padding: 10px;
        font-size: 16px;
        transform: translateY(100%);
        transition: transform 0.3s ease;
        cursor: pointer;
    }

    .product-card:hover .add-to-cart-overlay {
        transform: translateY(0); 
    }

    .card-body {
        text-align: center;
    }

    .card-title {
        margin: 0;
        padding: 5px 0;
        font-size: 1.1rem;
    }

    .card-text {
        margin: 0;
        padding: 5px 0;
    }
</style>

</body>
</html>
