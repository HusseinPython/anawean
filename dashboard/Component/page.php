<?php 


    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 'home';
    }

    if($page == 'home'){
        if($_SESSION['work'] != 0){
            header("Location /anaween/dashboard/?page=news");
            exit();
        }
        include './component/home.php';
    }elseif($page == 'users'  and $_SESSION['work'] == 0){
        include './component/users.php';
    }elseif($page == 'add' ){
        include './Component/add.php';
    }elseif($page == 'news'){
        include './Component/news.php';
    }elseif($page == 'section' and $_SESSION['work'] == 0){
        include './Component/section.php';
    }elseif($page == 'articles'){
        echo "articles";
    }elseif($page == 'view'){
        include './Component/view.php';
    }elseif($page == 'logout'){
        include './Component/logout.php';
    }elseif($page == 'edit'){
        include './Component/edit.php';
    }elseif($page == 'delete' and $_SESSION['work'] == 0){
        include './Component/delete.php';
    }else{
        header("Location /anaween/dashboard/?page=home");
        exit();
    }