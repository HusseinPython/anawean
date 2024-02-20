<div class="alert">
    <div class="message">
        <div class="title">Do you really want to delete this <?php echo $_GET['what']; ?></div>
        <div class="answer">
            <a href=<?php echo $_SERVER['PHP_SELF']."?page=delete&what=". $_GET['what'] ."&do=delete&delete=yes&id=".$_GET['id']; ?>><div>Yes</div></a>
            <a href="?page=<?php echo $_GET['what']; ?>"><div>No</div></a>
        </div>
    </div>
</div> 


<?php

    if(isset($_GET['do'])){
        if($_GET['what'] == 'users'){
            $stmt = $con->prepare("
                DELETE FROM `users` WHERE `users`.`ID` = ?
            ");
            $stmt->execute(array($_GET['id']));
            header('Location: /anaween/dashboard/index.php?page=users');
            exit();
        }elseif($_GET['what'] == 'section'){
            $stmt = $con->prepare("
                DELETE FROM `section` WHERE `section`.`ID` = ?
            ");
            $stmt->execute(array($_GET['id']));
            header('Location: /anaween/dashboard/index.php?page=section');
            exit();
        }elseif($_GET['what'] == 'news'){
            $stmt = $con->prepare("
                DELETE FROM `article` WHERE `article`.`ID` = ?
            ");
            $stmt->execute(array($_GET['id']));
            header('Location: /anaween/dashboard/index.php?page=news');
            exit();
        }else{
            header('Location /anaween/dashboard');
            exit();
        }
    }