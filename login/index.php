<?php include './../inclued/connect.php'; 
    session_start();
    if(isset($_SESSION['username'])){
        header('Location: /anaween/dashboard');
    }
    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $username = $_POST['user'];
        $password = $_POST['pass'];
        $hashPass = sha1($password);
        if($username == "" and $password == ""){
            echo "<div class='error'>your Email and your password is empty</div>";
        }elseif($username == ""){
            echo "<div class='error'>your Email is empty</div>";
        }elseif($password == ""){
            echo "<div class='error'>your password is empty</div>";
        }else{
            $stmt = $con->prepare('SELECT ID, Email, Password, FirstName, LastName, Work FROM users WHERE Email = ? and Password = ? and active = 1 LIMIT 1 ');
            $stmt->execute(array($username, $hashPass));
            $data = $stmt->fetch();
            print_r($data['Email']);
            $login = $stmt->rowCount();
            if($login > 0){
                $_SESSION['id'] = $data['ID'];
                $_SESSION['email'] = $data['Email'];
                $_SESSION['work'] = $data['Work'];
                $_SESSION['username'] = $data['FirstName'] . " " . $data['LastName'];
                header('Location: /anaween/dashboard');
                exit();
            }else{
                echo "<div class='error'>your email or your password is Wrong try again</div>";
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
    <link rel="stylesheet" href="./../layout/css/normalize.css" />
    <link rel="stylesheet" href="./../layout/css/master.css" />
    <link rel="stylesheet" href="./layout/css/style.css" />
</head>
<body>
    <div class="login-page">
        <div class="login-box">
            <div class="login">
                <div class="title">log in</div>
                <div class="webname"><span>ana</span>ween</div>
                <form method="POST" action=<?php echo $_SERVER['PHP_SELF'] ?> >
                    <label>username</label>
                    <input type="text" name="user" autocompelete=none />
                    <label>Password</label>
                    <input type="password" name="pass" autocompelete=none />
                    <input type="submit" value="login"/>
                </form>
            </div>
        </div>
        <div class="login-back"></div>
    </div>
</body>
</html>