<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nike Add user</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
		
<?php
include_once ("connection.php");
session_start(  );			
$_SESSION['Flag_Add_user']= -1;

?>		
		<script type="text/javascript">
function valid()
{
	var v=true;
	
	
	





		if(document.getElementById("type").value == "")
		{
			document.getElementById("ltype").style.color="red";
			v=false;
			alert("أرجو إدخال النوع المستخدم !!");
		}
		else
		{
		
				document.getElementById("ltype").style.color="black";
			
			
		}

		
		
		return v;
}
		
		
		
function valid1()
{
	var v=true;
	
	
	




		//_______________________________________________________________________________
//							PIRCE BUY

		//patnn2=/^[5-9]{1}$/;
		patnn=/^[0-9]{0,4}$/;
		if(document.getElementById("salary").value == "")
		{
			document.getElementById("lprice").style.color="red";
			document.getElementById("pricemsg").innerHTML=" أرجو إدخال راتب";
			v=false;
		
		}
		else
		{
			if(patnn.test(document.getElementById("salary").value) == false)
			{
				document.getElementById("lprice").style.color="red";
				document.getElementById("pricemsg").innerHTML="السعر غير صحيح أرجو إدخال قيمة رقمية";
				v=false;	
			}
			else
			{
				document.getElementById("lprice").style.color="black";
				document.getElementById("pricemsg").innerHTML=" ";
			}
			
			if(document.getElementById("salary").value <= 0)
			{
				document.getElementById("lprice").style.color="red";
				document.getElementById("pricemsg").innerHTML="السعر غير صحيح أرجو إدخال قيمة رقمية";
				v=false;	
			}
			else
			{
				document.getElementById("lprice").style.color="black";
				document.getElementById("pricemsg").innerHTML=" ";
			}
			
		}

       patnn=/[\u0600-\u06FF\u0750-\u077F]{2,15}( ){1}[0-9]{0,10}[\u0600-\u06FF\u0750-\u077F]{0,15}/;	
	
		if(document.getElementById("name").value.value  == "")
		{
			document.getElementById("lname").style.color="red";
			document.getElementById("namemsg").innerHTML="أرجو إدخال الأسم";
			v=false;
		
		}
		else{
			if(patnn.test(document.getElementById("name").value) == false)
			{
				document.getElementById("lname").style.color="red";
				document.getElementById("namemsg").innerHTML="الأسم غير صحيح الرجاء ادخال اسم و القب";
				v=false;
			}
			
			else
			{
			document.getElementById("lname").style.color="black";
			document.getElementById("namemsg").innerHTML=" ";
			}
		}
	

		patnn=/^[0-9]{10}$/;
		if(document.getElementById("phone1").value == "")
		{
			document.getElementById("lphone1").style.color="red";
			//document.getElementById("codemsg").innerHTML="The CODE OR COLOR Is Empty";
			v=false;
		
		}
		else{
			if(patnn.test(document.getElementById("phone1").value) == false)
			{
				document.getElementById("lphone1").style.color="red";
				//document.getElementById("codemsg").innerHTML="CODE OR COLOR is Wrong ";
				v=false;
			}
			
			else
			{
			document.getElementById("lphone1").style.color="black";
		//	document.getElementById("codemsg").innerHTML=" ";
			}
			
		}	

		
		
		return v;
}
function valid2()
{
	var v=true;
	
	
	




       patnn=/[\u0600-\u06FF\u0750-\u077F]{2,15}( ){1}[0-9]{0,10}[\u0600-\u06FF\u0750-\u077F]{0,15}/;	
	
		if(document.getElementById("name").value.value  == "")
		{
			document.getElementById("lname").style.color="red";
			document.getElementById("namemsg").innerHTML="أرجو إدخال الأسم";
			v=false;
		
		}
		else{
			if(patnn.test(document.getElementById("name").value) == false)
			{
				document.getElementById("lname").style.color="red";
				document.getElementById("namemsg").innerHTML="الأسم غير صحيح الرجاء ادخال اسم و القب";
				v=false;
			}
			
			else
			{
			document.getElementById("lname").style.color="black";
			document.getElementById("namemsg").innerHTML=" ";
			}
		}
	

		patnn=/^[0-9]{10}$/;
		if(document.getElementById("phone1").value == "")
		{
			document.getElementById("lphone1").style.color="red";
			//document.getElementById("codemsg").innerHTML="The CODE OR COLOR Is Empty";
			v=false;
		
		}
		else{
			if(patnn.test(document.getElementById("phone1").value) == false)
			{
				document.getElementById("lphone1").style.color="red";
				//document.getElementById("codemsg").innerHTML="CODE OR COLOR is Wrong ";
				v=false;
			}
			
			else
			{
			document.getElementById("lphone1").style.color="black";
		//	document.getElementById("codemsg").innerHTML=" ";
			}
			
		}	

		
		
		return v;
}
	
	</script>
    </head>
	<?

function Form_search($conn)
{
?>
						<div class="span9">
						<div class="content">
							<div class="module">
								<div class="module-head">
									<h3>إضافة مستخدم</h3>
									
								</div>
								<form action="" method="post" class="form-horizontal row-fluid" onsubmit="return valid();">
								
											
												
											
								
											<div class="control-group">
												<label class="control-label" id="ltype">النوع المستخدم</label>
												<div class="controls">
												
													<select tabindex="1" data-placeholder="Select here.." class="span5"  id ="type" name = "type" onchange="changeE(this)">
													
														<option value="">أختيار هنا...</option>
														<option value="SU">المورد</option>
														<option value="C">العميل</option>
														<option value="S">الموظف</option>
														
													</select>
												</div>
											</div>
											
												
											
											
										
								
									
										
										
										<div class="control-group">
											<div class="controls">
												<button type="submit" name="insert" class="btn btn-primary pull-center">إضافة <i class="icon-search"></i></button>
											</div>
										</div>
									</form>	
								<br>
							
							</div>
						</div>
					</div>
	<?
}

function insert($conn)
{
	extract($_POST);
	
	
	

		try
		{

			
		
				if($type=='S')
				{
							$sql1="INSERT INTO user_accounts (id_account,account_name,phone_number,salary,account_char,del) VALUES (null, '$Name','$phone','$salary', '$type', '0')";

				}
				else
				{
							$sql1="INSERT INTO user_accounts (id_account,account_name,phone_number,salary,account_char,del) VALUES (null, '$Name','$phone',null, '$type', '0')";

				}

				if($conn->exec($sql1))
				{

					$_SESSION['Flag_Add_user']= 1;
				}
				else
				{
					$_SESSION['Flag_Add_user']= -1;
				}

			
			
			
		
		}	
		catch(PDOException $e)
		{
			echo $sql , $e->getMessage();
		}
		$conn = null;
		header('Location: users.php');
		

}

function form($conn)
{
	extract($_POST);
	$typea=$type;
	if(isset($_POST['type'])!="" )
	{
			?>
			
				<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>إضافة المستخدم<i class="menu-icon icon-plus"></i></h3>
								<?
								if($type=='S')
								{
									
									echo "<h3> الموظف <i class='menu-icon icon-user'></i></h3>";

									
								}
								else
								{
									if($type=='SU')echo "<h3> المورد <i class='menu-icon icon-user'></i></h3>";
									else echo "<h3> العميل <i class='menu-icon icon-user'></i></h3>";
	

								}
									?>
						
							</div>
				
					<div class="module-body">
					
					<?
								if($type=='S')
								{
									?>
									<form action="" method="post" class="form-horizontal row-fluid" onsubmit="return valid1();">

									<?
								}
								else
								{
									?>
									<form action="" method="post" class="form-horizontal row-fluid" onsubmit="return valid2();">

									<?
								}
								?>
								
										<div class="control-group" >
											<label  class="control-label"  id="lname" >الأسم</label>
											<div class="controls" >
												<input type="text" id="name" name="Name" class="span4"><label id="namemsg"></label>
											</div>
										</div>
										
									
										<div class="control-group" >
											<label  class="control-label"  id="lphone1" >رقم الهاتف</label>
											<div class="controls" >
												<input type="text" id="phone1" name="phone" class="span4"><label id="phonemsg"></label>
											</div>
										</div>
								<?
								if($type=='S')
								{
									?>

									<div class="control-group">
										
										
										
										
											<label class="control-label" id="lprice">راتب</label>
											<div class="controls">
												<div class="input-append">
													<input type="text" name="salary" id="salary" maxlength=4 class="span4"><span class="add-on">دينار</span>
													<label id="pricemsg"></label>
													
												</div>
												
											
											</div>
											
											
										
										
										</div>
									<?
								}
								?>
						
							<center>	
										<br><hr>
										<div class="control-group">
											<div class="controls">
												<a href="Add.php" name="Cancel" class="btn btn-primary pull-right">إلغاء <i class="icon-remove"></i></button></a>
											</div>
											<div class="controls">
											<input hidden type="text" name="type" value="<?php echo $type	; ?>"/>

												<button type="submit" name="submit" class="btn btn-primary pull-right">إضافة <i class="icon-ok"></i></button>
											</div>
										</div>
										
									</form>
									
												</div>
											</div> </td>
										
										</div>
									</tr>
								
													
											
				
		
			  </tbody>
								</table>
							
				</div>	
							
						</div>	
					</div><!--/.content-->
				</div><!--/.span9-->
			
			
			
			<?
	
		
	}
	else
	{
		

		
	}



?>				
				
			
	
			<?
}
if(!$_SESSION['Logout'])
{
?>
 <body>

        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">

                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        <ul class="nav nav-icons"><br>
						<img src="images/logo.jpg" width=110 height=110  />
                        </ul>
						<ul class="nav nav-icons"><br>
						<img src="images/name.jpg" width=200 height=200  />
                        </ul>	
						<ul class="nav nav-icons">
						<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<i class="menu-icon icon-time"></i>&nbsp;<? echo gmdate(" h:i A Y-m-d l ", time() + 2 * 3600);?>	
						<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<i class="menu-icon icon-phone"></i>&nbsp; 091xxxxxxx 
                        </ul>

                        <ul class="nav pull-right">
                    
                            <li><br>
				<h4><? echo $_SESSION['user_name']; ?></h4>
							</li>
                            <li class="nav-user dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="images/jordan.jpg" class="nav-avatar" />
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="Change_Password.php">تغير كلمة المرور</a></li>
                                    <li class="divider"></li>
               									
								
										<form action="Print_Bill_Day.php"  method="post" >
										<li>
											<button type="submit" name="Logout" class="btn btn-primary pull-center">تسجيل الخروج <i class="icon-signout"></i> طباعة فاتورة اليوم <i class="icon-print"></i></button>
										</li>
										</li>
										</form>
							
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
                              <li class="active"><a href="Home.php"><i class="menu-icon icon-home"></i>الصفحة الرئسية
                                </a></li>
								
                                <li><a class="collapsed" data-toggle="collapse" href="#print"><i class="menu-icon icon-paste">
                                </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i>تقرير إردات </a>
                                    <ul id="print" class="collapse unstyled">
                                        <li><a href="Bill_Day.php"><i class="icon-print"></i> إردات اليومية</a></li>
                                        <li><a href="Bill_Month.php"><i class="icon-print"></i> إردات الشهرية </a></li>
                                        <li><a href="Bill_Year.php"><i class="icon-print"></i> إردات السنوية </a></li>
                                    </ul>
                                </li>
                                
                           
                                <li><a href=""><i class="menu-icon icon-bullhorn"></i>ملاحظات </a>
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
                                 </i>المزيد</a>
                                    <ul id="togglePages" class="collapse unstyled">
                                        <li><a href="Change_Password.php"><i class="icon-key"></i> تغير كلمة المرور</a></li>
                                        <li><a href="other-user-listing.html"><i class="icon-group"></i> العملاء </a></li>
                                    </ul>
                                </li>
                                <li><a href="index.php"><i class="menu-icon icon-signout"></i>تسجيل خروج</a></li>
                            </ul>
                        </div>
                        <!--/.sidebar-->
                    </div>
                    <!--/.span3-->




<?
global $typea;
if(isset($_POST['submit']))
{
	insert($conn);
}
else
{ 
	if(isset($_POST['insert']))
	{
		Form_search($conn);
		form($conn);
	}
	else
	{
		

		Form_search($conn);
	}
}
	
?>
				</div>
			</div><!--/.container-->
		</div><!--/.wrapper-->
	<div class="footer">
		<div class="container">
			 

                <b class="copyright">&copy; <? echo gmdate("Y", time() + 2 * 3600);?> Nike - Sales System </b> is Programmed by Hamza Hamruni.
		</div>
	</div>

	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script  src="js/index.js"></script>
</body>
<?
}
else
{
		header('Location: index.php');

}