<?php

require_once '../repositories/post_repository.php';

$post_repo = new post_repository($context);

$lastPost = $post_repo->getLastPost();

?><html>
<body>
<h1>Bienvenue sur mon super blog !</h1>

<?php if($lastPost != null){
    ?>
    <h2>Dernier post : </h2>
    <h4><?php echo $lastPost['title'];?></h4>
    <p><?php echo $lastPost['content']?></p>
<?php
} else {
?>
Il n'y a encore aucun post, <a href="?admin=1&f=post_create.php">créez en un ici</a> !
<?php
}
?>
</body>
</html>