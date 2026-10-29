<?php
require_once 'config/config.php';

if(isset($_SESSION['user_id'])){
    header('Location ' . BASE_URL . '/app/' . $_SESSION['user_role'] . '/index.php');
    exit;
}

$error='';

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    requireCsrfToken();

    $login = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';

    $error = 'Invalid login credentials';

    if($login==='' || $password===''){
        // Log incomplete login attempt
        logActivity($pdo,null,$login,'login','failed');

    } else {

    $result = loginUser($pdo,$login,$password);

    if($result===true){ 
        // Log complete login attempt
        logActivity(
            $pdo,$_SESSION['user_id'],
            $_SESSION['user_email'],
            'login',
            'success'
        );

       
        header('Location: ' . BASE_URL . '/app/' . $_SESSION['user_role'] . '/index.php');
        exit;
    } else if($result=== 'active_session'){

        $error = 'This account is already logged in on another device';
    } else {
        $error = 'Invalid login credentials';
    }
}
}

 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    
<form method="POST" action="<?= BASE_URL ?>/index.php">
    <label>Username or Email:</label>

    <input type="hidden"  name="csrf_token" 
    value="<?= htmlspecialchars(generateCsrfToken()) ?>">

    <input type="text" 
           name="login" 
           required>
    <br>
    <br>
    <label>Password:</label>
    <input type="password" 
           name="password" 
           required>
    <br><br>
    <button type="submit">Sign In</button>
</form>

<?php if ($error !== ''): ?>
    <p style="color: red;">
        <?= htmlspecialchars($error) ?>
    </p>
<?php endif; ?>

 
  <?php if(isset($_GET['timeout'])): ?>
    <p style="color:red;">Your session has timed out due to inactivity. Please log in again.</p>
<?php endif; ?>

</body>
</html>