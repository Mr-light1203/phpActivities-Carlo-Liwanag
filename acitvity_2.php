<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peys App</title>
</head>
<body>
    <h1>Peys App</h1>
    
    <form method="post">
        <label for="rangeSize">Select Photo Size: </label>
        <input type="range" name="rangeSize" id="rangeSize" min="10" max="100" value="60"><br> 
        
        <label for="slctColorBorder">Select Border Color:</label>
        <input type="color" name="slctColorBorder" id="slctColorBorder" value="#000000"><br><br> 

        <button type="submit" name="btnProcess">Process</button><br><br>
    </form>

    <?php 
    if (isset($_POST['btnProcess'])) { 
        $borderColor = $_POST['slctColorBorder'];
        $imgSize = $_POST['rangeSize'];
        ?>
        
        <!-- Display the image with selected border color and size -->
        <img src="liwanag.jpg" alt="Selected Image" width="<?php echo empty($imgSize) ? '10' : $imgSize; ?>%" 
             height="<?php echo empty($imgSize) ? '10' : $imgSize; ?>%" 
             style="border:5px solid <?php echo empty($borderColor) ? '#000000' : $borderColor; ?>;">
    <?php } ?>
</body>
</html>
