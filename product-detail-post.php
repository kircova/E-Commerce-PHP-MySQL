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
    // $comment_err = "deneme1";
    // function_alert("post a girdi"); 
    // if(isset($_POST['submitted_comment'])) {

    //     $comment_err = "deneme2";

    //     function_alert($comment_err); 
    //     if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
    //      {
    //         $comment_err = "deneme3";

    //         if(empty($_POST["submitted_comment"])){
    //             $comment_err = "Review can not be blank.";

    //         } elseif(strlen(trim($_POST["submitted_comment"])) < 15){
    //             $comment_err = "Review must have at least 15 characters.";

    //         } else{

    //             $prid = $_POST['prid'];
    //             $submitted_comment = trim($_POST["submitted_comment"]);
    //             $userid = $_SESSION["pid"];
    //             $time = date(format,timestamp);

    //             $sql_statement = "SELECT m.pid,od.prid
    //             FROM `makes` m ,order_table o , orderdetails od
    //             WHERE o.oid = m.oid and o.oid = od.oid and m.pid = '$userid' and od.prid = '$prid'";
    //             $check = mysqli_query($db, $sql_statement);

    //             if( mysqli_num_rows($check)==0 ){
    //                 $comment_err = "You must have ordered this product to submit a review.";
    //             }
    //             else {
    //                 $sql_statement = "INSERT INTO comment (pid, prid,com_text,isVisible,time) VALUES ($userid, $prid,$submitted_comment,0,$time)";
    //                 $check = mysqli_query($db, $sql_statement);
    //             }

    //         }


    //         }
    //         $prid = $_POST['prid'];
    //         header("location: product-detail.php?id=$prid");
    //         exit;

    //     }
 }
 $prid = $_POST['prid'];
 header("location: product-detail.php?id=$prid");
 exit;

?>