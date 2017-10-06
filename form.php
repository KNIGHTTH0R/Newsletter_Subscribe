<!--
<?php
/*/**
 * Created by PhpStorm.
 * User: SMITDOSHI
 * Date: 9/28/17
 * Time: 9:54 PM
 */

//    session_start();
//    $_SESSION['message']='';
//
//    // Connect to mysql database
//    $mysqli = new mysqli('localhost','root','','formsignup');
//
//    // Let's check form is getting submitted
//    if($_SERVER['REQUEST_METHOD']=='POST'){
//
//        // Escapes Whitespace and Special characters
//        $username = $mysqli->real_escape_string($_POST['username']);
//        $email = $mysqli->real_escape_string($_POST['email']);
//
//        // Now we will set all the session variables
//        $_SESSION['username']=$username;
//
//        // Now we will insert the values to our database
//        $sql = "INSERT INTO users (username,email)"
//                ."VALUES('$username','$email')";
//
//        // We will check if the query is executable
//
//        // If the query is successful, redirect to welcome.php page
//        if($mysqli->query($sql)===true){
//            $_SESSION['message'] = "Registration Successful! Added $username to the database!";
//            // Redirect to the welcome page using header
//            header("location: welcome.php");
//        }
//        // Else statement if the query is not executed
//        else{
//            $_SESSION['message']='User could not be added to the database!';
//        }
//
//    }

?>
-->

<?php
// A form class that will perform
class formConnection{

    // Global Variable
    public $connection;
    // We will create a constructor who job is just make connection with the database
    function __construct()
    {
        // Connection to our database
        $this->connection= mysqli_connect('localhost','root','','formsignup') or die("Databse connection failed" .mysqli_error());

        mysqli_select_db($this->connection,"formsignup");
    }

    // function accepting two parameters

    function insert_table($username,$email){
        $username = mysqli_real_escape_string($this->connection,$username);
        $email = mysqli_real_escape_string($this->connection,$email);
        $query = mysqli_query($this->connection,"INSERT INTO users (username,email) VALUES ('".$username."','".$email."')");
        // this function will return the query;
        return $query;
    }
}

?>

<!-- Calling above PHP class on Submit button pressed-->

<?php

$bool1 = FALSE;
$bool2 = FALSE;
$username_err = " ";
$email_err = " ";
// Create object of the class
$conn = new formConnection();
if(isset($_POST["register"]))
{
//    echo '<pre>';
//    print_r($_POST);
//    echo '</pre>';
//    die("ok");
    $username = $email = " ";

    // Username Validation

    if(empty($_POST["username"])){
        $username_err = "username is required";
        $bool1 = FALSE;

    }else{
        $username = $_POST["username"];
        $bool1 = TRUE;
    }

    // Email Validation

    if(empty($_POST["email"])){
        $email_err = "Email is required";
        $bool2=FALSE;
    }
    else{
        $email_valid = $_POST["email"];
        if(!filter_var($email_valid,FILTER_VALIDATE_EMAIL)){
            $email_err = "Email is invalid";
            $bool2 =FALSE;
        }else{
            $email = $_POST["email"];
            $bool2=TRUE;
        }
    }

    // When abov conditions are true then insert
    if(($bool1=TRUE) && ($bool2==TRUE)){
        $conn ->insert_table($username,$email);
    }

}
?>


<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="./css/style.css" type="text/css">
<script type="text/javascript" src="javascript/formvalidate.js">

</script>
<div class="body-content">
    <div class="module">
        <h1>Create an account</h1>
        <form class="form" action="form.php" method="post" enctype="multipart/form-data" autocomplete="off", name="newsform"
              >
            <!--      <div class="alert alert-error">--><?//=$_SESSION['message']?><!--</div>-->
            <input type="text" placeholder="User Name" name="username"  id="username" value="<?php echo isset($_POST["username"]) ? $_POST["username"]:''?>"/>

<!--            --><?php //if(empty($_POST["username"])){
//                echo '<div class="alert alert-error">'.$username_err.'</div>';
//            }?>
            <?php if($bool1===TRUE){
                echo '<div class="alert alert-error">'.$username_err.'</div>';
            }?>

            <input type="text" placeholder="Email" name="email" id="email" />
            <?php if($bool2===TRUE) {
                echo '<div class="alert alert-error">'.$email_err.'</div>';
            }?>

            <input type="submit" value="Register" name="register" class="btn btn-block btn-primary" />
        </form>
    </div>
</div>


