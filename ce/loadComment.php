<?php

require_once 'Database.php';
    $blog_page = $_SERVER['HTTP_REFERER'];
    
    $db = Database::getDB();

    $q = "SELECT * FROM blog_comments WHERE blog_page = :blog_page AND approved = 'Y' ORDER BY date DESC";
    $stm = $db->prepare($q);

    
    $stm->bindParam(':blog_page', $blog_page, PDO::PARAM_STR, 200); 
    
    $stm->execute();    

    $comments = $stm->fetchAll(PDO::FETCH_ASSOC);    
    
    if ($stm->rowCount() > 0)
    {
        echo json_encode($comments);
    }

?>