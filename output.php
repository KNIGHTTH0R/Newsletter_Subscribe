
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="./css/style.css">
<?php

session_start();
$db_host = 'localhost'; // Server Name
$db_user = 'root'; // Username
$db_pass = ''; // Password
$db_name = 'formsignup'; // Database Name

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
    die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$sql = 'SELECT * FROM users ORDER BY DATE DESC';

$query = mysqli_query($conn, $sql);

if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}
?>

<html>
<head>
    <title>Display Data</title>
</head>

<body>
<div class="body content">
    <div class="welcome">
        <?php

        if((isset($_SESSION['username'])) and $_SESSION['username']!=""){
            echo "
            <div class=\"welcome\">
             <div class=\"alert alert-success\">Registration Successful<br>"."
               Welcome <span class=\"user\">".$_SESSION["username"]."</span>
                  <div class=\"user\">Username:".$_SESSION["username"]."</div>
                  <div class=\"user\">Email:".$_SESSION["email"]."</div>
             </div>
            </div>";
            echo "
                <div class=\"container\">
                 <h1>Display Data from User's Table</h1>
                    <table class=\"table table-bordered\">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>USERNAME</th>
                            <th>EMAIL</th>
                            <th>DATE</th>
                        </tr>
                        </thead>
                            <tbody>";
            while ($row =  mysqli_fetch_assoc($query)) {
                echo '
                            <tr>
                            <td>' . $row['id'] . '</td>
                            <td>' . $row['username'] . '</td>
                            <td>' . $row['email'] . '</td>
                            <td>' . $row['date'] . '</td>';
            }
            echo "
                      </tbody>
                    </table>
                </div>";

                session_unset('username');
                session_unset('email');
        }
        else{
            echo "
                <div class=\"container\">
                 <h1>Display Data from User's Table</h1>
                    <table class=\"table table-bordered\">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>USERNAME</th>
                            <th>EMAIL</th>
                            <th>DATE</th>
                        </tr>
                        </thead>
                            <tbody>";
                        while ($row =  mysqli_fetch_assoc($query)) {
                            echo '
                            <tr>
                            <td>' . $row['id'] . '</td>
                            <td>' . $row['username'] . '</td>
                            <td>' . $row['email'] . '</td>
                            <td>' . $row['date'] . '</td>';
                        }
            echo "
                      </tbody>
                    </table>
                </div>";
            }
        ?>

    </div>

</div>

</body>
</html>


