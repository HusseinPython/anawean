<div class='title'>
    Users page 
    <span class="btn-add">
        <a href=<?php echo $_SERVER['PHP_SELF'] . "?page=add&what=user"; ?>>
            <i class="fa fa-user-plus"></i> Add User
        </a>
    </span>
</div>

<?php

    $stmt = $con->prepare(' SELECT * FROM users WHERE Work != 0 ');
    $stmt->execute();

    $data = $stmt->fetchAll();

?>

        <?php
            if(!empty($data)){
                echo "
                    <table>
                        <thead>
                            <td>ID</td>
                            <td>Email</td>
                            <td>Name</td>
                            <td>Work</td>
                            <td>Active</td>
                            <td>Option</td>
                        </thead>
                    <tbody>
                ";
                foreach($data as $user ){
                    echo "<tr>";
                        echo "<td>" . $user['ID'] . "</td>";
                        echo "<td>" . $user['Email'] . "</td>";
                        echo "<td>" . $user['FirstName'] . " " . $user['LastName'] . "</td>";
                        if($user['Work'] == 1){
                            echo "<td>Writer</td>";
                        }elseif($user['Work'] == 2){
                            echo "<td>Junior</td>";
                        }
    
                        if($user['Active'] == 1){
                            echo '<td class="active-bar"> <div class="on"></div> </td>';
                        }else{
                            echo "<td class='active-bar'> <div class='off'></div> </td>";
                        }
                        echo'<td class="option">';
                            echo '<a href="?page=edit&what=users&do=active&active='.$user['Active'].'&id='. $user['ID'] .'"><div class="active"><i class="fa fa-power-off"></i></div></a>';
                            echo '<a href="?page=delete&what=users&id='. $user['ID'] .'"><div class="delete"><i class="fa fa-trash-alt"></i></div></a>';
                        echo'</td>';
                    echo "</tr>";
                }   
                echo "</tbody>";
                echo "</table>";
            }else{
                echo "<div class='no-data'>There are no users</div>";
            }

        ?>