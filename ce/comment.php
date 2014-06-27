<?php

require_once 'Database.php';

class comment {
    public function GetCommentsByBlogID($blogID)
    {
        $db = Database::getDB();
        $q = "SELECT * FROM blog_comments WHERE blogID = :blogID AND approved = 'Y'";
        $stm = $db->prepare($q);
        $stm->bindParam(':blogID', $blogID, PDO::PARAM_INT);
        $stm->execute();    
        
        $comments = $stm->fetchAll();
        
        return $comments;        
    }

    public function GetAllComments()
    {
        $db = Database::getDB();
        $q = "SELECT * FROM blog_comments";
        $stm = $db->prepare($q);
        $stm->execute();    
        
        $comments = $stm->fetchAll();
        
        return $comments;        
    }    
    
    public function AddComment($blogID, $name, $email, $comment)
    {
        $db = Database::getDB();
        $q = "INSERT INTO blog_comments (blogID, name, email, comment) VALUES "
                . "(:blogID, :name, :email, :comment)";
        $stm = $db->prepare($q);

        $stm->bindParam(':blogID', $blogID, PDO::PARAM_INT); 
        $stm->bindParam(':name', $name, PDO::PARAM_STR, 50); 
        $stm->bindParam(':email', $email, PDO::PARAM_STR, 50); 
        $stm->bindParam(':comment', $comment, PDO::PARAM_STR); 
        
        $row = $stm->execute();
        if ($row == 1){
            return true;            
        }
        else {
            return false;
        }            
    }
    
    public function ApproveComment($commentID)
    {
        $db = Database::getDB();
        $q = "UPDATE blog_comments SET approved = 'Y' WHERE commentID = :commentID";
        $stm = $db->prepare($q);

        $stm->bindParam(':commentID', $commentID, PDO::PARAM_INT); 
        
        $row = $stm->execute();
        if ($row == 1){
            return true;            
        }
        else {
            return false;
        }            
    }

    public function DeleteComment($commentID)
    {
        $db = Database::getDB();
        $q = "DELETE FROM blog_comments WHERE commentID = :commentID";
        $stm = $db->prepare($q);

        $stm->bindParam(':commentID', $commentID, PDO::PARAM_INT); 
        
        $row = $stm->execute();
        if ($row == 1){
            return true;            
        }
        else {
            return false;
        }            
    }    
    
}
