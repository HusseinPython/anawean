<div class='title'>
    News page 
    <span class="btn-add">
        <a href=<?php echo $_SERVER['PHP_SELF'] . "?page=add&what=news"; ?>>
            <i class="fa fa-user-plus"></i> Add News
        </a>
    </span>
</div>

<?php
    if($_SESSION['work'] == 0){
        $stmt = $con->prepare(' SELECT * FROM article ');
        $stmt->execute();
        $data = $stmt->fetchAll();
    }else{
        $stmt = $con->prepare(' SELECT * FROM article WHERE article.Writer = ?');
        $stmt->execute(array($_SESSION['id']));
        $data = $stmt->fetchAll();
    }


    function writer($con, $id) {
        $stmt = $con->prepare('SELECT FirstName, LastName FROM `news`.`users` WHERE `ID` = ?');
        $stmt->execute(array($id));
        $data = $stmt->fetchAll()[0];
        echo "<td>" . $data['FirstName']. ' ' . $data['LastName'] . "</td>";
    }

    function section($con, $id) {
        $stmt = $con->prepare('SELECT Name FROM `news`.`section` WHERE `ID` = ?');
        $stmt->execute(array($id));
        $data = $stmt->fetchAll()[0];
        echo "<td>" . $data['Name'] ."</td>";
    }
?>

        <?php
            if(!empty($data)){
                echo "
                    <table>
                        <thead>
                            <td>ID</td>
                            <td>Title</td>
                            <td>Writer</td>
                            <td>Section</td>
                            <td>Date</td>
                            <td>Visitor</td>
                            <td>Active</td>
                            <td>Option</td>
                        </thead>
                    <tbody>
                ";
                foreach($data as $article ){
                    echo "<tr>";
                        echo "<td>" . $article['ID'] . "</td>";
                        echo "<td>" . $article['Title'] . "</td>";
                        writer($con, $article['Writer']);
                        section($con, $article['Section']);
                        echo "<td>" . $article['Date'] . "</td>";
                        echo "<td>" . $article['view'] . "</td>";
                        if($article['Active'] == 1){
                            echo '<td class="active-bar"> <div class="on"></div> </td>';
                        }else{
                            echo "<td class='active-bar'> <div class='off'></div> </td>";
                        }
                        echo'<td class="option">';
                            echo '<a href="?page=view&what=news&id='. $article['ID'] .'"><div class="view"><i class="fa fa-eye"></i></div></a>';
                            if($_SESSION['work'] == 0){
                                echo '<a href="?page=edit&what=news&do=active&active='.$article['Active'].'&id='. $article['ID'] .'"><div class="active"><i class="fa fa-power-off"></i></div></a>';
                                echo '<a href="?page=delete&what=news&id='. $article['ID'] .'"><div class="delete"><i class="fa fa-trash-alt"></i></div></a>';
                            }else{
                                echo '<a href="?page=edit&what=news&do=edit&id='. $article['ID'] .'"><div class="active"><i class="fa fa-power-off"></i></div></a>';
                            }
                        echo'</td>';
                    echo "</tr>";
                }   
                echo "</tbody>";
                echo "</table>";
            }else{
                echo "<div class='no-data'>There are no News</div>";
            }

        ?>