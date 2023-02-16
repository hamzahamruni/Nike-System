<!DOCTYPE html>
<html lang="ar" dir="rtl" >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Nike</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>
<?php
include_once("connection.php");
//session_unset();
session_start(  );

function Form()
{
	$_SESSION['Logout']=True;
	?>
	<div class="wrapper">
		
		<div class="container">
			<div class="row">
				<div class="module module-login span4 offset4">
					<form action="" method="post" class="form-vertical">
						<div class="module-head">
							<h3> تسجيل دخول  <img src="images/logo.jpg" width=30 height=30  /></h3>
						</div>
						<div class="module-body">
							<div class="control-group">
								<div class="controls row-fluid">
									<input class="span12" type="text" id="inputEmail" name="User_Name" placeholder="أسم المستخدم">
								</div>
							</div>
							<div class="control-group">
								<div class="controls row-fluid">
									<input class="span12" type="password" name="Password" id="inputPassword" placeholder="كلمة المرور">
								</div>
											<li><a href="">
												هل نسيت كلمة المرور ؟
											</a></li>
							</div>
						</div>
						
						<div class="module-foot">
							<div class="control-group">
								<div class="controls clearfix">
									<button type="submit" name="login" class="btn btn-primary pull-right">تسجيل دخول <i class="icon-signin"></i></button>
									
								</div>
								
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div><!--/.wrapper-->
<?php
}

//_____________________________________________________________________________________________
 function hashword($string,$salt)
{
	$string = crypt($string, '$1$' . $salt . '$');
	return $string;	
}
function check($conn)
{
	extract($_POST);

	
   try
   {
		$Test= $conn->query("SELECT * FROM users where User_Name='$User_Name'");
		if($Test1=$Test->fetch(PDO::FETCH_OBJ))	
		{
			
		
			$Test2= $conn->query("SELECT * FROM users where User_Name='$User_Name' AND Password='$Password' AND del='0' ");
			
			if($Test3=$Test2->fetch(PDO::FETCH_OBJ))
			{
				$_SESSION['Logout']=False;
				$_SESSION['id']=$Test3->id;
				$_SESSION['name']=$Test3->name;
				$_SESSION['user_name']=$Test3->User_Name;
				$_SESSION['Priv']=$Test3->Priv;
				
				
				$New_Date=date ("Y-m-d", time() + 2 * 3600);
				
				
				/*$Search_Date= $conn->query("SELECT * FROM Sales_Bills where Date>='$New_Date 00:00:00' And Date<='$New_Date 23:59:59'");
				if($N_Date=$Search_Date->fetch(PDO::FETCH_OBJ))	
				{
					header('Location: http://localhost/Nike Saraya/Control%20Panel.%7b21EC2020-3AEA-1069-A2DD-08002B30309D%7d/Home.php');
				}
				else IF($User->Priv==S)
				{
					$New_Date=date ("Y-m-d H:i:s", time() + 2 * 3600);
					
					$sql_insert_new_date="INSERT INTO Sales_Bills (Date,Total_Price) VALUES ('$New_Date','0')";
					$conn->exec($sql_insert_new_date);
					
					header('Location: http://localhost/Nike Saraya/Control%20Panel.%7b21EC2020-3AEA-1069-A2DD-08002B30309D%7d/Home.php');
					
				}*/
				header('Location: http://localhost/Nike/Home.php');
			}
			else
			{
				?>	
				<script type="text/javascript">
					alert("كلمة المرور غير صحيحه");
				</script>
				<?php
				Form();
			}
		}
		else
		{
			?>	
			
				<script type="text/javascript">
					alert("أرجو التاكد من أسم المستخدم ");
				</script>
			<?
			Form();
			
		}
		
		
	}
	catch(PDOException $e) 
   {
    echo "Error: " . $e->getMessage();
   }
}
?>
<body>


	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
                        <ul class="nav nav-icons"><br>
						<img src="images/logo.jpg" width=100 height=200  />
                        </ul>
						<ul class="nav nav-icons"><br>
						<img src="images/name.jpg" width=200 height=200  />
                        </ul>	
						<ul class="nav nav-icons">
						<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<i class="menu-icon icon-time"></i>&nbsp;<? echo gmdate(" h:i A Y-m-d l ", time() + 2 * 3600);?>	
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						
                        </ul>

				<div class="nav-collapse collapse navbar-inverse-collapse">
				
					<ul class="nav pull-right">
						<li><a href="https://www.facebook.com/hamza.hamroni.1/" target="_blank" >
							<b class="copyright">Nike System </b> is Programmed by Hamza Hamruni.
						</a></li>
					</ul>
				</div><!-- /.nav-collapse -->
			</div>
		</div><!-- /navbar-inner -->
	</div><!-- /navbar -->

	
		<?
	if(isset($_POST['login']))
	{
		check($conn);
		
	
	}
	else
	{
		Form();
	}
?>

	<div class="footer">
		<div class="container">
			 

          <b class="copyright">&copy; <? echo gmdate("Y", time() + 2 * 3600);?> Nike - Sales System </b> is Programmed by Hamza Hamruni.
		</div>
	</div>
	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>