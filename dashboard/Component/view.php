<?php

    $stmt = $con->prepare('SELECT * FROM article WHERE article.ID = ?');
    $stmt->execute(array($_GET['id']));
    $data = $stmt->fetchAll()[0];
?>

<div class='news'>
    <div class="new-title"><?php echo $data['Title']; ?></div>
    <div class="img">
        <img src="./layout/img/upload/<?php echo $data['Img']; ?>" />
    </div>
    <div class="new-content"><?php echo $data['Content']; ?></div>
</div>