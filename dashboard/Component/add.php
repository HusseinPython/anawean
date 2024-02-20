<?php

    if(isset($_GET['what']) and $_GET['what'] == 'user'){
        echo '
        <div class="title">add user</div>

        <form class="add-user" action="' .  $_SERVER["PHP_SELF"] . '?page=add&what=user&do=insert" method="POST">
            
            <div>
                <label>email</label>
                <input type="text" name="email" placeholder="Email" />
            </div>
            <div>
                <label>first name</label>
                <input type="text" name="first-name"  placeholder="First Name" />
            </div>
            <div>
                <label>Last Name</label>
                <input type="text" name="last-name"  placeholder="Last Name" />
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="pass"  placeholder="Password" />
            </div>
            <div>
                <label>Confirmate Password</label>
                <input type="password" name="conf-pass"  placeholder="Confirmate Password" />
            </div>
            <div>
                <label>Work</label>
                <select name="work" class="work">
                    <option value="0">Manager</option>
                    <option value="1">Writer</option>
                    <option value="2">Junior</option>
                </select>
            </div>
            <input type="submit" value="Add New User" />
        </form>
        
        ';
    }elseif(isset($_GET['what']) and $_GET['what'] == 'section'){
        echo '
        <div class="title">add section</div>

        <form class="add-user" action="' .  $_SERVER["PHP_SELF"] . '?page=add&what=section&do=insert" method="POST">
            
            <div>
                <label>Name</label>
                <input type="text" name="name"  placeholder="Name" />
            </div>
            <input type="submit" value="Add New Section" />
        </form>
        
        ';
    }elseif(isset($_GET['what']) and $_GET['what'] == 'news'){

        $stmt = $con->prepare('SELECT ID, Name FROM section');
        $stmt->execute();
        $sections = $stmt->fetchAll();

        echo '<div class="title">add News</div>';
        echo '
        <form class="add-user" action="' .  $_SERVER["PHP_SELF"] . '?page=add&what=news&do=insert" method="POST" enctype="multipart/form-data">
            <div>
                <label>Title</label>
                <input type="text" name="title"  placeholder="Title" />
            </div>
            <div>
                <label>Section</label>
                    <select name="section" class="work">
                    ';
                    foreach($sections as $section){
                        echo "<option value=". $section['ID'] .">". $section['Name'] ."</option>";
                    }
        echo '
                    </select>
            </div>
            <div>
                <label>Image</label>
                <input type="file" name="image" id="image" />
            </div>
            <input type="text" style="display:none;" name="content" id="content" />
            <div id="content"></div>
            <input type="submit" value="Add New News" />
            <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/inline/ckeditor.js"></script>

        </form>
        ';
    }
?>

        <script>
            InlineEditor
                .create( document.querySelector( '#editor' ) )
                .catch( error => {
                    console.error( error );
                } );
        </script>


<?php
    if(isset($_GET['do']) and $_GET['do'] == 'insert'){
            if($_GET['what'] == 'user'){
                $email = $_POST['email'];
                $fname = $_POST['first-name'];
                $lname = $_POST['last-name'];
                $pass = $_POST['pass'];
                $work = $_POST['work'];
                $cPass = $_POST['conf-pass'];
                if(empty($email)){
                    echo "<div class='error'>Email Feild is Empty Try Again</div>";
                }elseif(empty($fname)){
                    echo "<div class='error'>First Name Feild is Empty Try Again</div>";
                }elseif(empty($lname)){
                    echo "<div class='error'>Last Name Feild is Empty Try Again</div>";
                }elseif(empty($pass)){
                    echo "<div class='error'>Password Feild is Empty Try Again</div>";
                }elseif(empty($cPass)){
                    echo "<div class='error'>Confirmate Password Feild is Empty Try Again</div>";
                }elseif($pass != $cPass){
                    echo "<div class='error'>Password and Confirmate Password is Not Equail Try Again</div>";
                }else{
                    $stmt = $con->prepare('INSERT INTO 
                                            users
                                                (ID, Email, Password, FirstName, LastName, Work, Active)
                                            VALUES 
                                                (:zid, :zemail, :zpass, :zfname, :zlname, :zwork, :zactive)');
                    $stmt->execute(array(
                        'zid' => rand(),
                        'zemail' => $email,
                        'zpass' => sha1($pass),
                        'zfname' => $fname,
                        'zlname' => $lname,
                        'zwork' => $work,
                        'zactive' => 1,
                    ));
                    header('Location /anaween/dashboard/?page=add&what=user&do=insert');
                    exit();
                }
            }elseif($_GET['what'] == 'section'){
                $name = $_POST['name'];
                if(empty($name)){
                    echo "<div class='error'>Name Feild is Empty Try Again</div>";
                }else{
                    $stmt = $con->prepare('INSERT INTO 
                                            section
                                                (ID, Name, Active)
                                            VALUES 
                                                (:zid, :zname, :zactive)');
                    $stmt->execute(array(
                        'zid' => rand(),
                        'zname' => $name,
                        'zactive' => 1,
                    ));
                    header('Location /anaween/dashboard/?page=add&what=section&do=insert');
                    exit();
                }
            }elseif($_GET['what'] == 'news'){
                $title = $_POST['title'];
                $content = $_POST['content'];
                // $image = $_POST['image'];
                $file = $_FILES['image'];
                move_uploaded_file($file['tmp_name'], './layout/img/upload/'. $file['name']);
                $stmt = $con->prepare('INSERT INTO 
                                article
                                    (ID, Title, Content, Img, Writer, Section, Date, Active, view)
                                VALUES 
                                    (:zid, :ztitle, :zcontent, :zimg, :zwriter, :zsection, :zdate, :zactive, :zview)');
                $stmt->execute(array(
                    'zid' => rand(),
                    'ztitle' => $title,
                    'zcontent' => $content,
                    'zimg' => $file['name'],
                    'zwriter' => $_SESSION['id'],
                    'zsection' => $_POST['section'],
                    'zdate' => date('Y-m-d'),
                    'zactive' => 1,
                    'zview' => 0,
                ));
                header('Location /anaween/dashboard/?page=add&what=news');
                exit();
            }
        }

?>


<!-- echo "<div class='success'>a new user has been added successfully</div>"; -->