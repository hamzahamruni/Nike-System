<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nike Saraya</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
  	


	</head>
<?php
include_once("connection.php");
	session_start();
?>	
<script type="text/javascript">

function valid()
{
		var v=true;
		var patnn=/^[a-zA-Z][a-zA-Z0-9\._-]{7,18}$/i;
//___________________________________________________________________________________________________
//									Old Password
		
		if(document.getElementById("Old_pass").value != document.getElementById("Old_pass2").value)
		{
			document.getElementById("l_Old_pass").style.color="red";
			document.getElementById("Old_pmsg").innerHTML="The Password Is Empty";
			v=false;
		
		}
		else
		{
	
			document.getElementById("l_Old_pass").style.color="black";
			document.getElementById("Old_pmsg").innerHTML=" ";
			
			
		}

//___________________________________________________________________________________________________
//									New Password1	
	
		patnn=/^[a-zA-Z][a-zA-Z0-9\._-]{7,18}$/i;
		if(document.getElementById("pass").value == "")
		{
			document.getElementById("lpass").style.color="red";
			document.getElementById("pmsg").innerHTML="The Password Is Empty";
			v=false;
		
		}
		else{
			if(patnn.test(document.getElementById("pass").value) == false)
			{
				document.getElementById("lpass").style.color="red";
				document.getElementById("pmsg").innerHTML="Password So Easy";
				v=false;
			}
			
			else
			{
			document.getElementById("lpass").style.color="black";
			document.getElementById("pmsg").innerHTML=" ";
			}
			
		}		
//___________________________________________________________________________________________________
//							New Password 2
		if(document.getElementById("pass2").value != document.getElementById("pass").value)
		{
			document.getElementById("lpass2").style.color="red";
			document.getElementById("p2msg").innerHTML="The Password Dose Not Match";
			v=false;
		
		}
		else
		{
	
			document.getElementById("lpass2").style.color="black";
			document.getElementById("p2msg").innerHTML=" ";
			
			
		}

		return v;
}

</script>
 <?
function Form()
{
?>
						<div class="span9">
						<div class="content">
							<div class="module">
								<div class="module-head">
									<h3>Change Password <i class="menu-icon icon-key"></i></h3>
									<hr>
								</div>
					<form  action="" method="post" onsubmit="return valid();">
	
						<input type="hidden" id="Old_pass2" name="Old_pass2" value="<? echo $_SESSION['Password']; ?>">
						<div class="module-body">
							<div class="control-group">
							    <div class="controls row-fluid">
									<label class="control-label" for="basicinput" id="l_Old_pass">Old Password</label>
										<input  class="apan12" type="password" id="Old_pass" name="Password"><label id="Old_pmsg"></label>
								</div>
							</div>	
							<div class="control-group">
							    <div class="controls row-fluid">
									<label class="control-label" for="basicinput" id="lpass">New Password</label>
										<input  class="apan12" type="password" id="pass" name="New_Password"><label id="pmsg"></label>
								</div>
							</div>		
										
							<div class="control-group">
							    <div class="controls row-fluid">
									<label class="control-label" for="basicinput" id="lpass2">Re-Type Password</label>
										<input  class="apan12" type="password" id="pass2" name="New_Password"><label id="p2msg"></label>
								</div>
							</div>	
							
						</div>
						<div class="module-foot">
							<div class="control-group">
								<div class="controls clearfix">
									<button type="submit"  name="submit" class="btn btn-primary pull-left">Save Changes <i class="icon-save"></i></button>

								</div>
							</div>
						</div>
					</form><br>
							
							</div>
						</div>
					</div>
					
					
	<?
}
//_____________________________________________________________________________________________
 function hashword($string,$salt)
{
	$string = crypt($string, '$1$' . $salt . '$');
	return $string;	
}

function Update($conn)
{
	extract($_POST);
	$User_Name=$_SESSION['User_Name'];
	$salt=uniqid(mt_rand(),true);	
	$Hash=hashword($New_Password,$salt);
	
	try
	{
		
		$sql="UPDATE users SET Password='$Hash',Salt='$salt' WHERE User_Name='$User_Name'";
        $conn->exec($sql);
		$_SESSION['Password']=$New_Password;
		?>
		<script type="text/javascript">		
				alert("Password Changed Successfully");
		</script>
		<?
		header('Location: http://localhost/Nike Saraya/Control%20Panel.%7b21EC2020-3AEA-1069-A2DD-08002B30309D%7d/Home.php');


	}	
	catch(PDOException $e)
	{
		echo $sql , $e->getMessage();
	}
	$conn = null;

		

}

//_______________________________________________________________________________________________________
if($_SESSION['Logout']==False)
{
?>
    <body>

        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">

                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        <ul class="nav nav-icons"><br>
						<img src="images/Nike.jpg" width=110 height=110  />
                        </ul>
						<ul class="nav nav-icons"><br>
						
						<img src="images/nike_saraya1.jpg" width=200 height=200  />
                        </ul>	
						<ul class="nav nav-icons">
						<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<i class="menu-icon icon-time"></i>&nbsp;<? echo gmdate(" h:i A Y-m-d l ", time() + 2 * 3600);?>	
						<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<i class="menu-icon icon-phone"></i>&nbsp; 0213341226 
                        </ul>

                        <ul class="nav pull-right">
                    
                            <li><br>
								<? 
								if($_SESSION['Priv']=='M')
								{
									?>
										<h4>MANAGER</h4>
									<?
								}
								else
								{
									?>
										<h4>STAFF</h4>
									<?
								}
								?>
							</li>
                            <li class="nav-user dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="images/jordan.jpg" class="nav-avatar" />
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="">Your Profile</a></li>
                                    <li><a href="">Change Password</a></li>
                                    <li class="divider"></li>
               									<?
									if($_SESSION['Priv']=='S')
									{
									?>
										<form action="Print_Bill_Day.php"  method="post" >
										<li>
											<button type="submit" name="Logout" class="btn btn-primary pull-center">Logout <i class="icon-signout"></i> Print Bill Today <i class="icon-print"></i></button>
										</li>
										</form>
									<?
									}
									else
									{
									?>
										<li><a href="index.php">Logout</a></li>
									<?
									}
									?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /.nav-collapse -->
                </div>
            </div>
            <!-- /navbar-inner -->
        </div>
        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="span3">
                        <div class="sidebar">
                            <ul class="widget widget-menu unstyled">
                                <li class="active"><a href="Home.php"><i class="menu-icon icon-home"></i>Home
                                </a></li>
								
                                <li><a class="collapsed" data-toggle="collapse" href="#print"><i class="menu-icon icon-paste">
                                </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i>Print Invoice </a>
                                    <ul id="print" class="collapse unstyled">
                                        <li><a href="Bill_Day.php"><i class="icon-print"></i> Day </a></li>
                                        <li><a href="Bill_Month.php"><i class="icon-print"></i> Month </a></li>
                                        <li><a href="Bill_Year.php"><i class="icon-print"></i> Year </a></li>
                                    </ul>
                                </li>
                                
                           
                                <li><a href=""><i class="menu-icon icon-bullhorn"></i>Notes </a>
                                </li>
								<li><a href="https://www.nike.com" target="_blank"><i class="menu-icon icon-ok"></i>Nike.com </a>
                                </li>

                            </ul>
                            <!--/.widget-nav-->
                            
                            
                            <ul class="widget widget-menu unstyled">
							    <li><a href="https://www.facebook.com/NikeSaraya/?ref=settings" target="_blank"><i class="menu-icon icon-facebook"></i>Facebook <b class="label green pull-right">
                                    8</b> </a></li>
                                <li><a href="https://www.instagram.com/nike.saraya" target="_blank"><i class="menu-icon icon-camera shaded"></i>instgram <b class="label orange pull-right">
                                    3</b> </a></li>
                                <li><a href="https://www.facebook.com/NikeSaraya/messages/" target="_blank"><i class="menu-icon icon-envelope"></i>Messenger 
								</a></li>
                            </ul>
                            <!--/.widget-nav-->
                            <ul class="widget widget-menu unstyled">
                                <li><a class="collapsed" data-toggle="collapse" href="#togglePages"><i class="menu-icon icon-cog">
                                </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i>More Pages </a>
                                    <ul id="togglePages" class="collapse unstyled">
                                        <li><a href=""><i class="icon-key"></i> Change Password </a></li>
                                        <li><a href=""><i class="icon-group"></i> All Users </a></li>
                                    </ul>
                                </li>
                                <li><a href="index.php"><i class="menu-icon icon-signout"></i>Logout </a></li>
                            </ul>
                        </div>
                        <!--/.sidebar-->
                    </div>
                    <!--/.span3-->
    



<?

	if(isset($_POST['submit']))
	{
		Update($conn);
	}
	else
	{
		Form();
	}
?>			 </div><!--/.content-->
			</div>
		</div>

			

	<div class="footer">
		<div class="container">
			 

			<b class="copyright">&copy; 2018 Nike Saraya - Sales System </b> is Programmed by Abdullah Mazen.
		</div>
	</div>

	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
		

</body>
<?
}