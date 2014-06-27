<!DOCTYPE html>
<?php
require_once 'comment.php';

$objComment = new comment();

$comments = $objComment->GetAllComments();

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../css/main.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
            <h2>Comment list</h2>
            <table>
                <tr>
                    <th>Blog Page</th>
                    <th>Name</th>
                    <th>Comment</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($comments as $comment) { ?>
                <tr>
                    <td><?php echo $comment["blog_page"]; ?></td>
                    <td><?php echo $comment["name"]; ?></td>
                    <td><?php echo $comment["comment"]; ?></td>
                    <td>
                        <?php if ($comment["approved"]=='N') { ?>
                        <a href="approveComment.php?commentID=<?php echo $comment["commentID"] ?>">Approve</a>
                        <?php } ?>
                    </td>
                    <td><a href="deleteComment.php?commentID=<?php echo $comment["commentID"] ?>">Delete</a></td>
                </tr>
                <?php } ?>
            </table>
    </body>
</html>
