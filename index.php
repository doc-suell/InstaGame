<?php 


 include_once "models/Post.php";
 include_once "models/Comment.php" ;
 include_once "config/database.php" ;

$db = new Database();

 $comment = new Comment(
    null,
    15,
    13,
    "lol",
    null
 );

 $comment::createComment($comment);

