<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nike</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
		
<?php
include_once ("connection.php");
session_start(  );			
$_SESSION['Flag_Add_Calss']= -1;

?>		
		<script type="text/javascript">
function valid()
{
	var v=true;
	
	
	




		//_______________________________________________________________________________
//							PIRCE BUY

		//patnn2=/^[5-9]{1}$/;
		patnn=/^[0-9]{0,4}$/;
		if(document.getElementById("price").value == "")
		{
			document.getElementById("lprice").style.color="red";
			document.getElementById("pricemsg").innerHTML=" أرجوإدخال السعر الشراء";
			v=false;
		
		}
		else
		{
			if(patnn.test(document.getElementById("price").value) == false)
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
			
			if(document.getElementById("price").value <= 0)
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


	
	//_______________________________________________________________________________
//							NUMBER QTY

		if(document.getElementById("qty").value == "" || document.getElementById("qty").value <= 0 )
		{
			document.getElementById("lqty").style.color="red";
			v=false;
		
		}
		else
		{
				document.getElementById("lqty").style.color="black";		
		
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
									<h3>بحت الصنف </h3>
									
								</div>
								<form action="" method="post" class="form-horizontal row-fluid" onsubmit="return valid();">
								
											
												
												<?
												
											
												if(!isset($_POST['Search']))
												{
													$conn->exec("DELETE FROM `nike`.`buffer_purchases`");
											?>	
								
											<div class="control-group">
												<label class="control-label" id="account">أسم المورد</label>
												<div class="controls">
												<?
												$Search_account=$conn->query("SELECT * FROM `user_accounts` WHERE account_char='SU' AND del='0' order by account_char ASC ");
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
											<?
												}
														?>
												
											
											
										<div class="control-group">
											<label class="control-label" id="lbarcode">باركود</label>
											<div class="controls">
												<div class="input-prepend">
				
													<span class="add-on"><h4><i class="menu-icon icon-barcode"></i></h4></span>
													<input type="text" name="Barcode" maxlength=13 id="barcode"  class="span9">
									
												</div>	
											</div>	
										</div>
								
									
										
										<div class="control-group">
											<label class="control-label" id="lcode">كود-لون</label>
											<div class="controls">
												<div class="input-prepend">
													<input type="text" name="code"  id="code"  maxlength=6 size=6 class="span3"  placeholder="Code">
													<span class="add-on"><h4>-</h4></span>
													<input type="text" name="color" id="color" maxlength=3        class="span2"  placeholder="Color"><label id="codemsg"></label>
												</div>
											</div>
										</div>
										
										<div class="control-group">
											<div class="controls">
												<button type="submit" name="Search" class="btn btn-primary pull-center">عرض <i class="icon-search"></i></button>
											</div>
										</div>
										
								<br>
							
							</div>
						</div>
					</div>
	<?
}

function insert($conn)
{
	extract($_POST);
			$Search_id=$conn->query("SELECT MAX(id) AS id FROM buffer_purchases");
		$id=$Search_id->fetch(PDO::FETCH_OBJ);
		//$ID_res_table=mysqli_insert_id($conn);
		$sql2="UPDATE `nike`.`buffer_purchases` SET `qty_buffer` = '$qty', `price_buffer` = '$price' 
				WHERE id='$id->id'
			   ";
	if($conn->exec($sql2))
	

		try
		{

			
			$Search_buffer=$conn->query("SELECT * FROM `buffer_purchases`");
			
			while($view_buffer=$Search_buffer->fetch(PDO::FETCH_OBJ))
			{	
					$id_class=$view_buffer->id_class_buffer;
					
					
					$id_account=$view_buffer->id_client;
					
				$sql1="INSERT INTO `nike`.`purchases` (`id_pur`, `id_class`, `qty`, `qty_store`, `price_buy`, `date_pur`, `id_client`, `del`) VALUES ('null', '$id_class', '$view_buffer->qty_buffer', '$view_buffer->qty_buffer', '$view_buffer->price_buffer', CURRENT_TIMESTAMP, '$id_account', '0')";

				if($conn->exec($sql1))
				{

					$_SESSION['Flag_Add_Calss']= 1;
				}
				else
				{
					$_SESSION['Flag_Add_Calss']= -1;
				}

			}
			
			
		
		}	
		catch(PDOException $e)
		{
			echo $sql , $e->getMessage();
		}
		$conn = null;
		header('Location: http://localhost/Nike//purchases.php');
		

}

function form($conn)
{
	extract($_POST);
	
	if(isset($_POST['qty']) AND isset($_POST['price'])  )
	{
			
	
		$Search_id=$conn->query("SELECT MAX(id) AS id FROM buffer_purchases");
		$id=$Search_id->fetch(PDO::FETCH_OBJ);
		//$ID_res_table=mysqli_insert_id($conn);
		$sql2="UPDATE `nike`.`buffer_purchases` SET `qty_buffer` = '$qty', `price_buffer` = '$price' 
				WHERE id='$id->id'
			   ";
			if($conn->exec($sql2))
			{

				
			}
			$qty=0;
		$price=0;
	}
	else
	{
		$qty=0;
		$price=0;

		
	}
							

///////////////////////////////////////////////////
//					search


			if($Barcode!="")
			{
				$sql1="SELECT * FROM Class  WHERE  barcode='$Barcode' 
				AND 
					Id_class  NOT
					IN 
					(
					SELECT id_class_buffer
					FROM `buffer_purchases` 
					)
					";	
			}
			else
			{
				if($code!="")
				{
					$sql1="SELECT * FROM Class WHERE  Code='$code' AND Color='$color' 
					AND 
					Id_class  NOT
					IN 
					(
					SELECT id_class_buffer
					FROM `buffer_purchases` 
					)
					";	
				}
			
			}
		
				$sql1="SELECT * FROM Class  WHERE  barcode='$Barcode' 
				AND 
					Id_class  NOT
					IN 
					(
					SELECT id_class_buffer
					FROM `buffer_purchases` 
					)
					";
			$Search_Class=$conn->query($sql1);
			
			
			if($View_Class=$Search_Class->fetch(PDO::FETCH_OBJ))
			{
				
					try
					{

						$sql2="INSERT INTO `nike`.`buffer_purchases` (`id`,`id_class_buffer`, `qty_buffer`, `price_buffer` , `id_client`)  VALUES ('null','$View_Class->Id_class', '0','0','0')";
						
					//	echo $sql2;
			
							if($conn->exec($sql2))
							{

								
							}
						
						
					}	
					catch(PDOException $e)
					{
						echo $sql , $e->getMessage();
						$conn = null;
					
					}
					
					
			}
			else
			{
				?>	
			
				<script type="text/javascript">
					alert("الصنف غير موجود !! ");
				</script>
				<?
			}
			
			
			
				
			
//					view class


?>				
				
				<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>إضافة مشتريات<i class="menu-icon icon-plus"></i></h3>
								
						
							</div>
				
					<div class="module-body">
								<table class="table">
								  <thead>
									<tr>
									
									  <th>الصورة</th>
									  <th>باركود</th>
									  <th>الأسم</th>
									  <th>السعر <i class='icon-money'></i></th>
									</tr>
								  </thead>
								  <tbody>
							
									<tr>
									  <?
			$Search_Class_buffer=$conn->query("SELECT * FROM `buffer_purchases`,class WHERE id_class_buffer=Id_class order by id DESC ");

			while($View_Class_buffer=$Search_Class_buffer->fetch(PDO::FETCH_OBJ))
			{
									if($View_Class_buffer->Img!="")
									  {
										  ?>
										  
										 <td><img src="images/shoses/<? echo "$View_Class_buffer->Img"; ?>" height="120" width="120" /></td>
									  <?
									  }
									  else
									  {
										  ?>
										 <td><img src="images/shoses/class.jpg" height="120" width="120" /></td>
										  <?
										  
									  }
									  ?>
									  
									  <td><? echo ("$View_Class_buffer->barcode"); ?></td>
									  <td><? echo "$View_Class_buffer->Name"; ?></td>
									  <td><? echo $View_Class_buffer->Price; ?> د.ل </td>
									</tr>
									

									<tr>
									<div class="control-group">
										

											 <td><label class="control-label" id="lprice"  >سعر الشراء</label>
											<div class="controls">
												<div class="input-append">
												<?
												if(isset($_POST['price']))
												{
													?>
													<input type="text" name="price" id="price" value="<? echo $View_Class_buffer->price_buffer	;?>"  maxlength=4 class="span2"><span class="add-on">دينار</span>
													<?
												}
												else
												{
													?>
													<input type="text" name="price" id="price" maxlength=4 class="span2"><span class="add-on">دينار</span>
													<?
												}
												?>
													<label id="pricemsg"></label>	
												</div>
											</div> </td>
											
											
											 <td><label class="control-label" id="lqty">الكمية</label>
											<div class="controls">
												<div class="input-append">
													<?
													
												if(isset($_POST['qty']))
												{
													?>
													<input type="number" name="qty" id="qty" value="<? echo $View_Class_buffer->qty_buffer;?>" maxlength=4 class="span2"><span class="add-on"></span>
													<?
												}
												else
												{
													?>
													<input type="number" name="qty" id="qty"  maxlength=4 class="span2"><span class="add-on"></span>
													<?
												}
												?>
													<label id="pricemsg"></label>	
												</div>
											</div> </td>
										
										</div>
									</tr>
								
														
				
		<?

			}
			?>
			  </tbody>
								</table>
								<div class="module-body">
								<div class="control-group">
											<div class="controls">
												<a href="purchases.php" name="Cancel" class="btn btn-primary pull-right">إلغاء <i class="icon-remove"></i></button></a>
											</div>
											<div class="controls">
												<button type="submit" name="add_pur" class="btn btn-primary pull-right">حفظ الفاتورة <i class="icon-ok"></i></button>
											</div>
										</div>
										
									</form>
							</div>
							</div>
							</div>
						</div>
					</div>
							
						</div>	
					</div><!--/.content-->
				</div><!--/.span9-->
	
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
if(isset($_POST['add_pur']))
{
	insert($conn);
}
else
{ 
	if(isset($_POST['Search']))
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