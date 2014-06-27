<?php

require_once 'Database.php';

if (!$_GET['name'] || !$_GET['comment'])
{
    echo '{"result":"false"}';
    die();
}

    $name = $_GET['name'];
    $comment = $_GET['comment'];
    $blog_page = $_SERVER['HTTP_REFERER'];

        $db = Database::getDB();
        $q = "INSERT INTO blog_comments (name, comment, blog_page) VALUES "
                . "(:name, :comment, :blog_page)";
        $stm = $db->prepare($q);

        $stm->bindParam(':name', $name, PDO::PARAM_STR, 50); 
        $stm->bindParam(':comment', $comment, PDO::PARAM_STR, 200); 
        $stm->bindParam(':blog_page', $blog_page, PDO::PARAM_STR, 200);
        
        $row = $stm->execute();
        
    echo '{"result": true, "id":' . $db->lastInsertId() . '}';

?>