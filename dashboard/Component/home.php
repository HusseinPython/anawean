<?php

    echo "<div class='title'>dashboard</div>";

    if($_SESSION['work'] == 0){
        $stmt = $con->prepare("SELECT * FROM `users` WHERE users.Work != 0");
        $stmt->execute();
        $users = $stmt->rowCount();

        $stmt = $con->prepare("SELECT * FROM `section`");
        $stmt->execute();
        $section = $stmt->rowCount();

        $stmt = $con->prepare("SELECT * FROM `article`");
        $stmt->execute();
        $article = $stmt->rowCount();
        ?>
            <div class="bar">
                <div class="bar-user">
                    <div class='title-bar'>User</div>
                    <div class="icon"><i class='fa fa-users'></i></div>
                    <div class="bar-num"><?php echo $users; ?></div>
                </div>
                <div class="bar-section">
                    <div class='title-bar'>Section</div>
                    <div class="icon"><i class='fa fa-th'></i></div>
                    <div class="bar-num"><?php echo $section; ?></div>
                </div>
                <div class="bar-article">
                    <div class='title-bar'>Article</div>
                    <div class="icon"><i class='fa fa-file-text'></i></div>
                    <div class="bar-num"><?php echo $article; ?></div>
                </div>
            </div>
        <?php
    }else{
        header("Location /anaween/dashboard/index.php?page=news");
        exit();
    }

    echo strval(date('Y-m-d'));

    $stmt = $con->prepare(' SELECT * FROM article WHERE Date = ? ');
    $stmt->execute(array(strval(date('Y-m-d'))));

    $data = $stmt->fetchAll();

    if(!empty($data)){
        echo "
            <table>
                <thead>
                    <td>ID</td>
                    <td>Title</td>
                    <td>Writer</td>
                    <td>View</td>
                    <td>Active</td>
                </thead>
            <tbody>
        ";
        foreach($data as $article ){
            function writer($con, $id) {
                $stmt = $con->prepare('SELECT FirstName, LastName FROM `news`.`users` WHERE `ID` = ?');
                $stmt->execute(array($id));
                $data = $stmt->fetchAll()[0];
                echo "<td>" . $data['FirstName']. ' ' . $data['LastName'] . "</td>";
            }
            echo "<tr>";
                echo "<td>" . $article['ID'] . "</td>";
                echo "<td>" . $article['Title'] . "</td>";
                writer($con, $article['Writer']);
                echo "<td>" . $article['view'] . "</td>";

                if($article['Active'] == 1){
                    echo '<td class="active-bar"> <div class="on"></div> </td>';
                }else{
                    echo "<td class='active-bar'> <div class='off'></div> </td>";
                }
            echo "</tr>";
        }   
        echo "</tbody>";
        echo "</table>";
    }else{
        echo "<div class='no-data'>There are no News Today</div>";
    }