<?php
    require_once "config.php";
?>

<?php
// Initialize the session
session_start();
 
?>


<?php

$comment_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if(isset($_POST['comment-submit'])){
        if($_POST['star'] != 0)
        {
            $dcomment = $_POST['submitted_comment'];
            $dpid = $_POST['personid'];
            $dprid = $_POST['prid'];
            $drating = $_POST['star'];
            $sql_statement1 = "INSERT INTO comment 
                    (comment.pid, comment.prid, comment.com_text, comment.rating, comment.isVisible) 
                            VALUES
                    ('$dpid', '$dprid', '$dcomment', '$drating', 1);";
    
            $result1 = mysqli_query($db, $sql_statement1);
        }
    }
    else if(isset($_POST['comment-delete'])){
       
        $ccommentid = $_POST['commentid'];
         $sql_statement = "UPDATE comment SET comment.IsVisible = 0
                          WHERE comment.cid = '$ccommentid'";

        $result = mysqli_query($db, $sql_statement);
        $prid = $_POST['prid'];
        header("location: product-detail.php?id=$prid");
        exit;
    }
    else
    {

    }
 }
 $prid = $_POST['prid'];
 header("location: product-detail.php?id=$prid");
 exit;

?>