<?php
    require_once "config.php";
?>

<?php
// Initialize the session
session_start();
 
?>


<?php
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

$comment_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if(isset($_POST['comment-submit'])){
        if(isset($_POST['star']))
        {
            if($_POST['star'] == 1 ||$_POST['star'] == 2 ||$_POST['star'] == 3 ||$_POST['star'] == 4 ||$_POST['star'] == 5)
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
        else
        { 
            if($_POST['submitted_comment'] != NULL)
            {
                $line = $_POST['submitted_comment'];
                $drating = 1.0;
                $pieces = explode(" ", $line);
                $line_word_count = count($pieces);
                for($i=0; $i<$line_word_count; $i++) {
                    if($pieces[$i] == "inanılmaz"||$pieces[$i] == "harika")
                    {
                        $drating +=  2.1;
                    } 
                    if($pieces[$i] == "seviyorum"|| $pieces[$i] == "sevdiğim" || $pieces[$i] == "seviyorum" ||$pieces[$i] == "iyi")
                    {
                        $drating +=  1.2;
                    } 
                    if($pieces[$i] == "vasat"|| $pieces[$i] == "idare")
                    {
                        $drating +=  0.6;
                    }
                }
                if($drating > 4 )
                {
                    $drating = 5;
                }
                else if($drating > 3){$drating = 4;}
                else if($drating > 2){$drating = 3;}
                else if($drating > 1){$drating = 2;}
                else{$drating = 1;}
                $dcomment = $_POST['submitted_comment'];
                $dpid = $_POST['personid'];
                $dprid = $_POST['prid'];
                $sql_statement1 = "INSERT INTO comment 
                        (comment.pid, comment.prid, comment.com_text, comment.rating, comment.isVisible) 
                                VALUES
                        ('$dpid', '$dprid', '$dcomment', '$drating', 1);";
        
                $result1 = mysqli_query($db, $sql_statement1);
            }
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