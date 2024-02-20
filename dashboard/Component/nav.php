<nav>
    <div class="logo">
        anawean
    </div>
    <ul class="link">

        <?php
            if($_SESSION['work'] == 0){
                ?>
                    <li><a href=<?php echo $_SERVER['PHP_SELF'] . "?page=home" ?>><i class="fa fa-home"></i> Home</a></li>
                <?php
                echo "<li><a href='" . $_SERVER['PHP_SELF'] . "?page=users'> <i class='fa fa-users'></i> users</a></li>";
                echo '<li><a href="'. $_SERVER['PHP_SELF'] . '?page=section"> <i class="fa fa-th"></i> section</a></li>';
            }
        ?>

        <li><a href=<?php echo $_SERVER['PHP_SELF'] . "?page=news" ?>><i class="fa fa-file-text"></i> News</a></li>
    </ul>
    <ul class="user">
        <li class="username"><?php echo $_SESSION['username']; ?></li>
        <li><a href=<?php echo $_SERVER['PHP_SELF'] . "?page=logout" ?>><i class="fa fa-sign-out"></i> Logout</a></li>
        <!-- <div class="btn-nav"><img src="./layout/icon/more-horizontal.svg" /></div> -->
    </ul>
</nav>