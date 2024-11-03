<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendo Machine</title>
</head>
<body>

    <?php 
        $drinks = array(
            'Coke' => 15,
            'Sprite' => 20,
            'Royal' => 20,
            'Pepsi' => 15,
            'Mountain Dew' => 20
        );
        $sizes = array(
            'Regular' => 0,
            'Up-Size' => 5,
            'Jumbo' => 10
        );
    ?>
    <form method="post">
        <h1>Vendo Machine</h1>

        <fieldset>
            <legend>Products: </legend>
            <?php
                if(isset($drinks)) { 
                    foreach($drinks as $key => $value) {
                        echo '<input type="checkbox" name="chkDrinks[]" id="chkDrink' . $key . '" value="' . $key .'">';
                        echo '<label for="chkDrink' . $key . '"> ' . $key . ' - ₱' . $value . '</label><br>';
                    }
                }
            ?>
        </fieldset>

        <fieldset>
            <legend>Options: </legend>
            <label for="drpSizes">Size</label>
            <select name="drpSizes" id="drpSizes">
                <?php 
                    foreach ($sizes as $key => $value) {
                        if ($key != 'Regular') {
                            echo '<option value="' . $key . '">' . $key . ' (add ₱' . $value . ')</option>';
                        } else {
                            echo '<option value="' . $key . '">' . $key . '</option>';
                        }
                    }
                ?>
            </select>

            <label for="noQuantity">Quantity</label>
            <input type="number" name="noQuantity" id="noQuantity" min="1" value="1">
            <button type="submit" name="btnCheck">Check out</button>
        </fieldset>
    </form>

    <?php
        if (isset($_POST['btnCheck'])) {
            if (empty($_POST['chkDrinks'])) {
                echo "<h1>No Selected Item, Try Again.</h1>";
            } else {
                $drinksChoosen = $_POST['chkDrinks'];
                $size = $_POST['drpSizes'];
                $quantity = $_POST['noQuantity'];
                $total = 0;
                $quantities = 0;
                ?>
                <hr>
                <h1>Purchase Summary: </h1>
                <ul>
                    <?php foreach ($drinksChoosen as $value) { ?>
                        <?php 
                            $cost = ($drinks[$value] + $sizes[$size]) * $quantity;
                            $total += $cost;
                            $quantities += $quantity;
                        ?>
                        <li>
                            <?php echo $quantity . ' ' . ($quantity > 1 ? 'pieces' : 'piece') . ' of ' . $size . ' ' . $value . ' amounting to ₱' . $cost; ?>
                        </li>
                    <?php } ?>
                </ul>
                <b>Total Number of Items: <?php echo $quantities; ?></b><br>
                <b>Total Amount: ₱<?php echo $total; ?></b>
            <?php
            }
        }
    ?>

</body>
</html>
