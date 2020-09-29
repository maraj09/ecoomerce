<?php
    include "../classes/adminlogin.php";
    include "../lib/session.php";
    session::checkLogin();
    include "../lib/database.php";
    include "../helpers/format.php";
?>
<?php
    $al = new adminLogin();
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $adminUser = $_POST['username'];
        $adminPass =( $_POST['userpwd']);

        $loginchk = $al->adminLogin($adminUser,$adminPass);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
</head>
<body>
    
    <div class="header">
        <h2>Welcome !</h2>
    </div>
    <br>
    <h3>Admin's Login Page</h3>
    <br>
    <div class="body" >
        <form action="login.php" method="POST">
            <input type="text" name="username" placeholder="Username" class="username" required="required"><br><br>
            <input type="password" name="userpwd" placeholder="Password" class="password" required="required"><br><br>
            <input type="Submit" name="" value="Login" class="login">
        </form>
        <p style="color: red; font-size:18px;">
            <?php
                if (isset($loginchk)) {
                    echo $loginchk;
                }
            ?>
        </p>
    </div>
    <br>
    <div class="footer">
        <p>Copyright&copy;2020</p>
    </div>
    
</body>
</html>