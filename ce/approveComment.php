<?php
require_once 'comment.php';

$objComment = new comment();

$commentID = $_GET["commentID"];

$objComment->ApproveComment($commentID);

header("Location: commentlist.php");
?>