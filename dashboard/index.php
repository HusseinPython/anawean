<?php
session_start();

if(!isset($_SESSION['username'])){
    header('Location: /anaween/login');
    exit();
}
include './../inclued/connect.php';
include './Component/header.php';

include './Component/nav.php';
?>
<div class="page">
    <?php include './Component/page.php'; ?>
</div>
<?php
include './Component/footer.php';
?>