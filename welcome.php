
<link rel="stylesheet" href="./css/style.css">

<?php session_start();?>
<div class="body content">
    <div class="welcome">
        <div class="alert alert-success"><?=$_SESSION['message']?><br>
            Welcome<span class="user"><?=$_SESSION['username']?></span>
        </div>
    </div>
</div>
