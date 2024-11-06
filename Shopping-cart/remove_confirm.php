<?php
session_start();
include 'cart_helper.php';

// Get the cart count
$cart_count = get_cart_count();

// Check if item ID is provided
$item_id = isset($_GET['product_id']) ? (int)$_GET['product_id'] : null;
$item = null;

// Check if the item exists in the cart
if ($item_id && isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] == $item_id) {
            $item = $cart_item;
            break;
        }
    }
}

// Redirect back to cart if the item is not found in the cart
if (!$item) {
    header("Location: cart.php");
    exit;
}


function getItemDetails($id) {
    $products = [
        ["id" => 1, "name" => "Pink Dress", "price" => 650, "image" => "Shopping-cart/../imgs/Dress1.2.jpg", "image_hover" => "Shopping-cart/../imgs/Dress1.jpg", "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."],
        ["id" => 2, "name" => "Red Dress", "price" => 650, "image" => "Shopping-cart/../imgs/Dress2.jpg", "image_hover" => "Shopping-cart/../imgs/Dress2.2.jpg", "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."],
        ["id" => 3, "name" => "Black Dress", "price" => 750, "image" => "Shopping-cart/../imgs/Dress3.jpg", "image_hover" => "Shopping-cart/../imgs/Dress3.2.jpg", "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."],
        ["id" => 4, "name" => "Blue Dress", "price" => 800, "image" => "Shopping-cart/../imgs/Dress4.jpg", "image_hover" => "Shopping-cart/../imgs/Dress4.2.jpg", "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."],
        ["id" => 5, "name" => "Teal Dress", "price" => 800, "image" => "Shopping-cart/../imgs/Dress5.jpg", "image_hover" => "Shopping-cart/../imgs/Dress5.2.jpg", "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."],
        ["id" => 6, "name" => "White Dress", "price" => 800, "image" => "Shopping-cart/../imgs/Dress6.jpg", "image_hover" => "Shopping-cart/../imgs/Dress6.2.jpg", "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."],
        ["id" => 7, "name" => "Yellow Dress", "price" => 850, "image" => "Shopping-cart/../imgs/Dress7.jpg", "image_hover" => "Shopping-cart/../imgs/Dress7.2.jpg", "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."],
        ["id" => 8, "name" => "Brown Dress", "price" => 650, "image" => "Shopping-cart/../imgs/Dress8.jpg", "image_hover" => "Shopping-cart/../imgs/Dress8.2.jpg", "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."]
    ];

    foreach ($products as $product) {
        if ($product['id'] == $id) {
            return $product;
        }
    }
    return null;
}

// Get the detailed product information
$product_details = getItemDetails($item_id);

// Handle if product details are not found
if (!$product_details) {
    echo "<div class='alert alert-danger'>Product details not found. Please go back and try again.</div>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Confirmation - Dress to Impress</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
    <!-- Header with cart badge -->
    <header class="header  py-3 mb-4 shadow-sm">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h4 m-0">Dress to Impress</h1>
            <a href="cart.php" class="cart-badge">
                <i class="bi bi-cart"></i> Cart
                <span class="cart-count"><?php echo $cart_count; ?></span>
            </a>
        </div>
    </header>

    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="product-image-container">
                            <img src="<?php echo htmlspecialchars($product_details['image']); ?>" alt="<?php echo htmlspecialchars($product_details['name']); ?>" class="img-fluid rounded shadow-sm normal-image">
                            <img src="<?php echo htmlspecialchars($product_details['image_hover']); ?>" alt="<?php echo htmlspecialchars($product_details['name']); ?> (hover)" class="img-fluid rounded shadow-sm hover-image">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h3><?php echo htmlspecialchars($product_details['name']); ?> <span class="badge bg-warning">₱<?php echo number_format($product_details['price'], 2); ?></span></h3>
                        <p class="mt-3"><?php echo htmlspecialchars($product_details['description']); ?></p>
                        <p><strong>Size:</strong> <?php echo htmlspecialchars($item['size']); ?></p>
                        <p><strong>Quantity:</strong> <?php echo (int)$item['quantity']; ?></p>
                        <div class="mt-4">
                            <a href="remove_item.php?id=<?php echo $item['id']; ?>" class="btn btn-dark me-2">
                                <i class="bi bi-trash"></i> Confirm Product Removal
                            </a>
                            <a href="cart.php" class="btn btn-danger">
                                <i class="bi bi-x-circle"></i> Cancel/Go Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
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


        .product-image-container {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
        }
        .product-image-container img {
            width: 100%;
            height: auto;
            transition: opacity 0.5s ease-in-out;
        }
        .product-image-container .hover-image {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
        }
        .product-image-container:hover .normal-image {
            opacity: 0;
        }
        .product-image-container:hover .hover-image {
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
