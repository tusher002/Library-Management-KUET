<?php
  session_start();

if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) 
{
    
		  $_SESSION['login_user']=$_COOKIE['username'];

		  $_SESSION['login_password']=$_COOKIE['password'];
	      header('Location: user.php');   
} 
    if (isset($_SESSION['login_user'])) {
    	 header('Location: user.php'); 
    }

   
    $_SESSION['error']="";
    if (isset($_POST['submit']))
    {
            $username=$_POST['username'];
            $password=$_POST['password'];
            $connection = mysql_connect("localhost", "root", "");
            $username = stripslashes($username);
            $password = stripslashes($password);
            $username = mysql_real_escape_string($username);
            $password = mysql_real_escape_string($password);

            $db = mysql_select_db("rental_library", $connection);
            $query = mysql_query("select * from student where Password='$password' AND Roll='$username'", $connection);
            $rows = mysql_num_rows($query);

            if ($rows == 1) 
            {
                $_SESSION['login_user']=$username;
                $_SESSION['login_password']=$password;
                $_SESSION['username']=$rows['Name'];

		                if (isset($_POST['remember'])) 
		                {
				            setcookie('username', $username, time()+3600);
				            setcookie('password', $password, time()+3600);
		                 } 
             
                header("location:user.php");
            }
            
            elseif ($username=="admin" && $password=='1') {
                $_SESSION['login_user']=$username; 
                header("location:admin.php");
            }

            else 
            {
                $_SESSION['error']="Error";
                header("location:login.php");
            }
            mysql_close($connection);
    }
?>

<html>
<head>
    <title>about library | Rental Library | KUET</title>
    <link rel="icon" href="images/cse-logo.png" type="image/png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="libs/normalize/normalize.css">
    <link rel="stylesheet" href="libs/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/layout.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script>
var myVar=setInterval(function(){myTimer()},1000);

function myTimer() {
    var d = new Date();
    document.getElementById("demo").innerHTML = d.toLocaleTimeString();
}
</script>
</head>
<body>
    <div class="header">
        <div class="banar">
            <img id="cse" src="images/logo_vmatura200x200.png"></img><img id="kuet" src="images/kuet-logo.png"></img>
             <h3 id="demo" style="float:right;color:#F90F48;font-weight:bold;"></h3>
            <h5><font color="orange">Dept. of Computer Science & Engineering<font></h5>
            <h1><font color="black">Rental Library Management System<font></h1>
        </div>
        <div class="menu">
            <ul>
                <li> <a href="index.php"> <i class="glyphicon glyphicon-home"></i>  Home </a> </li>
                <li> <a href="about_library.php"><i class="glyphicon glyphicon-book"></i> About Library </a> </li> 
                <li> <a href="#signIn" data-toggle="modal" data-target="#signIn"> <i class="glyphicon glyphicon-lock"></i> Sign In</a> </li> 
            </ul>
        </div>
    </div>
    <div class="content">
        <div class="left_side">
            <ul>
               <li> <a href="glance.php">  Library at Glance  </a> </li>
                <li> <a href="library_com.php"> Library Committee </a> </li> 
                <li> <a href="contact.php"> Contact Us </a>  
            </ul>
        </div>
       <div style="width:850px;float:left;padding-left:10px;padding-top:100px;">
              <div>
                              <p>The Khulna University of Engineering and Technology, Khulna widely known in its abbreviated name KUET, is the second oldest University of Engineering and Technology in Bangladesh. The history of KUET Central Library dates back to the days of Khulna Engineering College which was established in 1964. In this connection, KUET Central Library was established in 1965 during Khulna Engineering College as General Library.</P>

                              <p>The KUET Central Library is established in 2003 and situated at the middle of the KUET campus. It is a multipurpose two-storied modern building. With the several facilities of printed materials there are more additional facilitiessuch as Internet, Wi-Fi and e-resources. To promote education and research the KUET Central Library is one of the members of INSAP-PERI and UGC Digital Library Consortium for e-resources. In Consistent with the academic curricula the contents to KUET central Library are being updated consistently to keep up with modern technological trends.</p>
             </div>

       

   <!-- Sign in Modal -->
        <div class="modal fade" id="signIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Sign In</h4>
                </div>
                <div class="modal-body">
                    <form action="index.php" method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="Enter username">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" value="1"> Remember me
                            </label>
                        </div>

                        <div class="form-group ">
                            <input type="submit" name="submit" class="btn btn-primary pull-right" style="margin-left: 10px" value="Sign in">
                            &nbsp;&nbsp;
                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>               
                        </div>
                    </form>             
                </div>
            </div>
        </div>
    </div>

    <script src="libs/jquery/jquery.min.js"></script>
    <script src="libs/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>