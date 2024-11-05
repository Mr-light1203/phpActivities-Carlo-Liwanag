<!DOCTYPE html>
<html lang="en">
<head>
  <title>Static Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="/css/styles.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    .notification {
      max-width: 350px;
      margin: 20px auto 0;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <?php
        
        $userLists = [
            'Admin' => [
                'Admin' => 'Pass1234',
                'Carlo' => 'Pogi1234'
            ],
            'Content Manager' => [
                'Michelle' => 'delacruz',
                'Shane' => 'castillo'
            ],
            'System User' => [
                'Abigail' => 'sunday'
            ]
        ];

        
        $notificationMessage = '';
        $notificationClass = '';

        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-signin'])) {
            $selectedType = $_POST['slctUserType'];
            $inputUsername = $_POST['inputUsername'];
            $inputPassword = $_POST['inputPassword'];
            
            
            $isValidUser = isset($userLists[$selectedType][$inputUsername]) && $userLists[$selectedType][$inputUsername] === $inputPassword;

            
            if ($isValidUser) {
                $notificationMessage = "Welcome to the system, " . htmlspecialchars($inputUsername) . "!";
                $notificationClass = 'alert-success';
            } else {
                $notificationMessage = "Invalid Username or Password.";
                $notificationClass = 'alert-danger';
            }

            
            header("Location: " . $_SERVER['PHP_SELF'] . "?notification=" . urlencode($notificationMessage) . "&class=" . urlencode($notificationClass));
            exit;
        }

        
        if (isset($_GET['notification']) && isset($_GET['class'])): ?>
            <div class="alert <?php echo htmlspecialchars($_GET['class']); ?> alert-dismissible fade show notification" role="alert">
                <?php echo htmlspecialchars($_GET['notification']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif;
    ?>

    <div class="login-box">
      <h2>Login</h2>
      <form method="post">
      <div class="user-box">
  <select name="slctUserType" required>
    <option value="Admin">Admin</option>
    <option value="Content Manager">Content Manager</option>
    <option value="System User">System User</option>
  </select>
</div>
        <div class="user-box">
          <input type="text" name="inputUsername" required>
          <label>Username</label>
        </div>
        <div class="user-box">
          <input type="password" name="inputPassword" required>
          <label>Password</label>
        </div>
        <button type="submit" name="btn-signin" class="btn-signin">
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  Sign in
</button>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
