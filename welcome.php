
<?php
// Session Start
session_start();
$_SESSION['message']='';
// A form class that will perform
class Form
{

    // Global Variable
    public $connection;
    protected $jsvalidation=TRUE;
    public $formmethod;
    public $formaction;

    // We will create a constructor who job is just make connection with the database
    public function __construct($param1 = 'post',$param2 ='welcome.php')
    {
        $this->formmethod=$param1;
        $this->formaction=$param2;
//
//        print_r($param1);
//        echo "<br>";
        // Storing the Value form $param variable

//        $this->username = $param1['username'];
//        $this->email = $param1['email'];

        //TESTing the Value

////        foreach ($param1 as $key => $value) {
////            $this->username= $value;
////            $this->email=$value;
////        }
//        echo "username:" .$this->username;
//        echo "<br>";
//        echo "email:" .$this->email;
//        echo "<br>";
        // Connection to our database

        $this->connection = mysqli_connect('localhost', 'root', '', 'formsignup') or die("Database connection failed" . mysqli_error());

        mysqli_select_db($this->connection, "formsignup");
    }
        // Javascript Run Function

//    public function validateForm()
//    {
//        print_r("Validate Form");
//        echo "<script language=javascript>
//            function jsvalidateform() {
//                var bool1=0;
//                var bool2=0;
//                // Username Validation
//                var alphaExp = /^[a-zA-Z]+$/;
//                var username_valid = document.forms[\"newsform\"][\"username\"].value;
//                if(username_valid.match(alphaExp)){
//                    bool1=1;
//                }
//                else {
//                    alert(\"Not a valid username\");
//                    boo1=0;
//                    }
//
//            // Email Validation
//            var email_valid = document.forms[\"newsform\"][\"email\"].value;
//            var atpos = email_valid.indexOf(\"@\");
//            var dotpos = email_valid.lastIndexOf(\".\");
//                if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email_valid.length) {
//                    alert(\"Not a valid e-mail address\");
//                    bool2=0;
//            }
//            else{
//                    bool2=1;
//             }
//            if((bool1 ===1) && (bool2 ===1)){
//                return true;
//            }else{
//                    return false;
//                }
//
//              }
//        jsvalidateform();</script>";
//    }

    public function jsvalidateForm(){
        if($this->jsvalidation===TRUE){
            echo "onsubmit='return validateform();'";
        } else {
            echo '';
        }
    }

    // function accepting two parameters

    function insert_table($username,$email){
        $username = mysqli_real_escape_string($this->connection,$username);
        $email = mysqli_real_escape_string($this->connection,$email);
        $query = mysqli_query($this->connection,"INSERT INTO users (username,email) VALUES ('".$username."','".$email."')");
        // this function will return the query;
        return $query;
    }


    // Function that outputs from the field Form
//    function __toString()
//    {
//
//        return "<div class=\"body content\">
//        <div class=\"welcome\">
//        <div class=\"alert alert-success\">Registration Successful<br>"."
//            Welcome <span class=\"user\">".$_POST["username"]."</span>
//            <div class=\"user\">Username:".$_POST["username"]."</div>
//            <div class=\"user\">Email:".$_POST["email"]."</div>
//        </div>
//        </div>
//        </div>";
//
//    }


}

?>

<!-- Calling above PHP class on Submit button pressed-->

<?php

$bool1 = FALSE;
$bool2 = FALSE;
$username_err = " ";
$email_err = " ";

// Create object of the class
$obj1 = new Form("post", "welcome.php");

if(isset($_POST["register"])){
    //    echo '<pre>';
//    print_r($_POST);
//    echo '</pre>';
//    die("ok");
    $username = " ";
    $email=" ";

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

    // When above conditions are true then insert
    if(($bool1===TRUE) && ($bool2===TRUE)){

        $obj1 ->insert_table($username,$email);
        $_SESSION['username']=$username;
        $_SESSION['email']=$email;
        header("location: output.php");
        //Output the Form page after instantiated
        //echo $obj1;
    }

}


//    echo '<pre>';
//    print_r($_POST);
//    echo '</pre>';
//    die("ok");

?>


<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="./css/style.css" type="text/css">
<script type="text/javascript" src="javascript/formvalidate.js"></script>
<div class="body-content">
    <div class="module">
        <h1>Subscribe Newsletter</h1>
        <form class="form" action="<?php echo $obj1->formaction; ?>" method="<?php echo $obj1->formmethod;?>"
              enctype="multipart/form-data" autocomplete="off", name="newsform" <?php echo $obj1->jsvalidateForm(); ?>
        >

            <!--      <div class="alert alert-error">--><?//=$_SESSION['message']?><!--</div>-->
            <input type="text" placeholder="Name" name="username"  id="username" value="<?php echo isset($_POST["username"]) ? $_POST["username"]:''?>"/>
            <div class="alert-error"><?=$username_err?></div>
            <input type="text" placeholder="Email" name="email" id="email" />
            <div class="alert-error"><?= $email_err?></div>
            <input type="submit" value="Register" name="register" class="btn btn-block btn-primary"/>
        </form>
    </div>
</div>


