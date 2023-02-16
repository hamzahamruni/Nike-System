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
	
	
	





		if(document.getElementById("account_name").value == "")
		{
			document.getElementById("laccount_name").style.color="red";
			v=false;
			alert("أرجو إدخال النوع المستخدم !!");
		}
		else
		{
		
				document.getElementById("laccount_name").style.color="black";
			
			
		}

		
		
		return v;
}
		
		
		
function valid1()
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
	


		
		
		return v;
}
function valid2()
{
	var v=true;
	

      	if(document.getElementById("paid").value > (document.getElementById("total_price").value*1) || document.getElementById("paid").value <= 0 || document.getElementById("paid").value == "" )
		{
			
			
				document.getElementById("lpaid").style.color="red";
				v=false;
				alert("أرجو إدخال القيمة المدفوعة أقل أو تساوي السعر الكلي !!");
		
			
			
		}
		else
		{
			document.getElementById("lpaid").style.color="black";
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
												<label class="control-label" id="laccount_name">أسم العميل</label>
												<div class="controls">
												<?
												$Search_account=$conn->query("SELECT distinct(u.id_account),u.account_name FROM user_accounts u,sale s WHERE u.id_account=s.id_account AND u.account_char='C' AND u.del='0' order by u.account_char ASC ");
												?>
													<select tabindex="1" data-placeholder="Select here.." class="span5"  id ="account_name" name = "id_account" onchange="changeE(this)">
													
														<option value="">أختيار هنا...</option>
														<?
															while($view_account=$Search_account->fetch(PDO::FETCH_OBJ))
															{
																?><option value="<?echo $view_account->id_account;?>" ><?echo $view_account->account_name;?></option>;
															<?
															}
														?>
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

			
		
				
				$sql1="INSERT INTO account_operations (id_account,id_operation,date_operations,amount) VALUES ('$id_account', null,CURRENT_TIMESTAMP,'$paid')";

				

				if($conn->exec($sql1))
				{
							$sql_update="UPDATE sale SET paid=paid+'$paid' WHERE id_account='$id_account' AND paid<total_price ";
							if($conn->exec($sql_update))
							{
									echo " is ok ";
							}
							else
							{
								
							}
					
				}
				else
				{
				}

			
			
			
		
		}	
		catch(PDOException $e)
		{
			echo $sql , $e->getMessage();
		}
		$conn = null;
		//header('Location: http://localhost/Nike//users.php');
		

}

function form($conn)
{
	extract($_POST);
	
	if(isset($_POST['id_account'])!="" )
	{
		$sql_acc=
		"SELECT u.id_account,account_name,SUM(s.paid) as tpaid,SUM(s.total_price) as tprice FROM user_accounts u,sale s 
		WHERE 
		s.id_account='$id_account' AND s.id_account=u.id_account 
		AND u.del='0' AND s.del='0'  ";
		//echo $sql_acc;	
		$Search_account=$conn->query($sql_acc);
										
		$view_account=$Search_account->fetch(PDO::FETCH_OBJ);
		
		
			?>
			
				<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>إيصال قبض<i class="menu-icon icon-plus"></i></h3>
								
						
							</div>
				
					<div class="module-body">
					
								<center>
								
									<form action="" method="post" class="form-horizontal row-fluid" onsubmit="return valid2();">

										<h3> <? echo $view_account->account_name; ?> <i class='menu-icon icon-user'></i></h3>
										
										<h3 id="lpaid"> <i class='menu-icon icon-money'></i> القيمة المتبقية  
										<br>د.ل   <? echo $view_account->tprice-$view_account->tpaid; ?> 
</h3>
								
										<?
										if(($view_account->tprice-$view_account->tpaid)!='0')
										{
										?>
											
											<center>
												<div class="input-prepend">

													<span class="add-on"><h4> دينار </h4></span>
												<input type="number" name="paid"  id="paid" placeholder="القمية المدفوعة " class="span9">
												
												</div>	
										
											</center>

										
										<?
										}
										?>
									
										
								
								

									<div class="control-group">
								
						
								
										<br><hr>
										<div class="control-group">
											<div class="controls">
												<a href="Add.php" name="Cancel" class="btn btn-primary pull-right">إلغاء <i class="icon-remove"></i></button></a>
											</div>
											<div class="controls">
<?
										if(($view_account->tprice-$view_account->tpaid)!='0')
										{
										?>
												<input hidden type="text" name="id_account" value="<? echo $view_account->id_account;?>" >
												<input hidden type="number"  id="total_price" name="total_price" value="<? echo  $view_account->tprice-$view_account->tpaid;?>" >

												<button type="submit" name="submit" class="btn btn-primary pull-right">قبض <i class="icon-ok"></i></button>
<?
										}
?>										
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
		header('Location: http://localhost/Nike/index.php');

}