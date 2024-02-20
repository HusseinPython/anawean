<div class='title'>
    Section page 
    <span class="btn-add">
        <a href=<?php echo $_SERVER['PHP_SELF'] . "?page=add&what=section"; ?>>
            <i class="fa fa-plus"></i> Add Section
        </a>
    </span>
</div>

<?php

    $stmt = $con->prepare(' SELECT * FROM section');
    $stmt->execute();

    $data = $stmt->fetchAll();

?>

        <?php
            if(!empty($data)){
                echo "
                    <table>
                        <thead>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Article</td>
                            <td>Active</td>
                            <td>Option</td>
                        </thead>
                    <tbody>
                ";
                foreach($data as $user ){
                    echo "<tr>";
                        echo "<td>" . $user['ID'] . "</td>";
                        echo "<td>" . $user['Name'] . "</td>";
                        $stmt = $con->prepare('SELECT * FROM `article` WHERE Section = ?;');
                        $stmt->execute(array($user['ID']));
                        $count = $stmt->rowCount();
                        echo "<td>" . $count . "</td>";
                        if($user['Active'] == 1){
                            echo '<td class="active-bar"> <div class="on"></div> </td>';
                        }else{
                            echo "<td class='active-bar'> <div class='off'></div> </td>";
                        }
                        echo'<td class="option">';
                            echo '<a href="?page=edit&what=section&do=active&active='.$user['Active'].'&id='. $user['ID'] .'"><div class="active"><i class="fa fa-power-off"></i></div></a>';
                            echo '<a href="?page=delete&what=section&id='. $user['ID'] .'"><div class="delete"><i class="fa fa-trash-alt"></i></div></a>';
                        echo'</td>';
                    echo "</tr>";
                }   
                echo "</tbody>";
                echo "</table>";
            }else{
                echo "<div class='no-data'>There are no Sections</div>";
            }

        ?>
