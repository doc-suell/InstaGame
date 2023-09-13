<?php 
 include_once "models/Post.php";
//  include_once "models/Comment.php" ;
 include_once "config/database.php" ;

 $db = new Database();


 $posts = Post::showPosts($db);


 var_dump($posts);









