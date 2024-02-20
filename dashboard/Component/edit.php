<?php

    $do = $_GET['do'];
    $id = $_GET['id'];

    if($do == 'active'){
        $active = $_GET['active'];
        if($active == 1){
            $ac = 0;
        }else{
            $ac = 1;
        }
        if($_GET['what'] == 'users'){
            $stmt = $con->prepare('UPDATE `users` SET `Active` = ? WHERE `users`.`ID` = ?;');
            $stmt->execute(array($ac, $id));
            header('Location: /anaween/dashboard/index.php?page=users');
            exit();
        }elseif($_GET['what'] == 'section'){
            $stmt = $con->prepare('UPDATE `section` SET `Active` = ? WHERE `section`.`ID` = ?;');
            $stmt->execute(array($ac, $id));
            header('Location: /anaween/dashboard/index.php?page=section');
            exit();
        }elseif($_GET['what'] == 'news'){
            $stmt = $con->prepare('UPDATE `article` SET `Active` = ? WHERE `article`.`ID` = ?;');
            $stmt->execute(array($ac, $id));
            header('Location: /anaween/dashboard/index.php?page=news');
            exit();
        }
    }

    if($do == "edit"){
        
        $stmt = $con->prepare('SELECT ID, Name FROM section');
        $stmt->execute();
        $sections = $stmt->fetchAll();

        $stmt = $con->prepare('SELECT *FROM article WHERE ID = ?');
        $stmt->execute(array($id));
        $article = $stmt->fetchAll()[0];

        echo '<div class="title">add News</div>';
        echo '
        <form class="add-user" action="' .  $_SERVER["PHP_SELF"] . '?page=edit&id='.$id.'&what=news&do=update" method="POST" enctype="multipart/form-data">
            <div>
                <label>Title</label>
                <input type="text" name="title" value=" '. $article['Title'] .' "  placeholder="Title" />
            </div>
            <div>
                <label>Section</label>
                    <select value=" '. $article['Section'] .' " name="section" class="work">
                    ';
                    foreach($sections as $section){
                        if($article['Section'] == $section['ID']){
                            $select = "selected";
                        }else{
                            $select = "";
                        }
                        echo "<option ". $select ." value=". $section['ID'] .">". $section['Name'] ."</option>";
                    }
        echo '
                    </select>
            </div>
            <div>
                <label>Image</label>
                <input value="' . $article['Img'] . '" type="file" name="image" id="image" />
            </div>
            <input type="text" value='.$article['Content'].' style="" name="content" id="content" />
            <div id="editor" name="content"></div>
            <input type="submit" value="Add New News" />
        </form>

        ';

    }

    if($_GET['do'] == 'update'){
        echo $_POST['title'];
        echo $_POST['section'];
        print_r($_FILES['image']);
    }