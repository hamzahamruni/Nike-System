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


?>
<script type="text/javascript">	
function Cancel_Bill() {
    var Sale;
    var r = confirm("هل متاكد من إلغاء فاتورة ؟");
    if (r == true) {
        Sale=true;
    } else {
        Sale=false;
    }
    return Sale;
}
function End_Bill() {
    var Sale;
    var r = confirm("هل متاكد من البيع فاتورة ؟");
    if (r == true) {
        Sale=true;

    } else {
        Sale=false;
    }
    return Sale;
}
function valid()
{
	var v=true;
	
	if(document.getElementById("barcode").value == "" && document.getElementById("code").value == "" && document.getElementById("color").value == "")
	{
		alert("أرجو إدخال باركود أو أسم الصنف !!");
		v=false;
	}
	else
	{
 //_______________________________________________________________________________
//							BARCODE		
		
		if(document.getElementById("barcode").value != "")
		{
			patnn=/^[0-9]{13}$/;
			if(patnn.test(document.getElementById("barcode").value) == false )
			{
				document.getElementById("lbarcode").style.color="red";
				v=false;
			}
			else
			{
				document.getElementById("lbarcode").style.color="black";
			}
			
		}
		else
		{
				patnn=/^[0-9]{6}$/;
			if(document.getElementById("code").value == "")
			{
				document.getElementById("lcode").style.color="red";
				document.getElementById("codemsg").innerHTML="The CODE OR COLOR Is Empty";
				v=false;
			
			}
			else{
					if(patnn.test(document.getElementById("code").value) == false)
					{
						document.getElementById("lcode").style.color="red";
						document.getElementById("codemsg").innerHTML="CODE OR COLOR is Wrong ";
						v=false;
					}
					else
					{
						document.getElementById("lcode").style.color="black";
						document.getElementById("codemsg").innerHTML=" ";
						patnn=/^[0-9]{3}$/;
						if(document.getElementById("color").value == "")
						{
							document.getElementById("lcode").style.color="red";
							document.getElementById("codemsg").innerHTML="The CODE OR COLOR Is Empty";
							v=false;
						
						}
						else{
							if(patnn.test(document.getElementById("color").value) == false)
							{
								document.getElementById("lcode").style.color="red";
								document.getElementById("codemsg").innerHTML="CODE OR COLOR is Wrong ";
								v=false;
							}	
							else
							{
							document.getElementById("lcode").style.color="black";
							document.getElementById("codemsg").innerHTML=" ";
							}
							
							}
					}
					
				}	
			
				
		}
		

	}
	
	return v;
}
	
</script>
	</head>
<?

function Form()
{
?>
						<div class="span9">
						<div class="content">
							<div class="module">
								<div class="module-head">
									<h3>بحت الصنف </h3>
									<hr>
								</div>
								<form action="" method="post" class="form-horizontal row-fluid" onsubmit="return valid();">
								
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
													<input type="text" name="N_Code"  id="code"  maxlength=6 size=6 class="span3"  placeholder="Code">
													<span class="add-on"><h4>-</h4></span>
													<input type="text" name="N_Color" id="color" maxlength=3        class="span2"  placeholder="Color"><label id="codemsg"></label>
												</div>
											</div>
										</div>
										
										<div class="control-group">
											<label class="control-label" id="lcode">الكمية</label>
											<div class="controls">
												<div class="input-prepend">
													<input type="number" name="qty"     class="span4"  value="1">
												</div>
											</div>
										</div>
										
										<div class="control-group">
											<div class="controls">
												<button type="submit" name="Search" class="btn btn-primary pull-center">عرض <i class="icon-search"></i></button>
											</div>
										</div>
										
								</form><br>
							
							</div>
						</div>
					</div>
	<?
}
function search_view($conn)
{
	extract($_POST);

///////////////////////////////////////////////////
//					search


			if($Barcode!="")
			{
				$sql1="SELECT * FROM Class a,purchases p 
				WHERE
				p.id_class=a.Id_class
				AND
				a.barcode='$Barcode' 
				AND
				p.qty_store > '0' AND p.qty_store>='$qty'
				AND a.del='0' AND p.del='0'
				";
				
			}
			else
			{
					if($N_Code!="" AND $N_Color!="")
					{
					$sql1="SELECT * FROM Class a,purchases p 
					WHERE
					p.id_class=a.Id_class
					AND
					a.Code='$N_Code' AND a.Color='$N_Color'
					AND
						p.qty_store > '0' AND p.qty_store>='$qty'
					AND a.del='0' AND p.del='0'
					";	
					}
			
			}
			
			
			$Search_Class=$conn->query($sql1);
			if($Sale_Class=$Search_Class->fetch(PDO::FETCH_OBJ))
			{
				$sql2="SELECT * FROM portfolio  	
					WHERE
					id_portfolio='$Sale_Class->Id_class'
					AND qty_por <  '$Sale_Class->qty_store' AND qty_por+'$qty'<='$Sale_Class->qty_store'
					";
				
				$Search_pro=$conn->query($sql2);
				if($Sale_pro=$Search_pro->fetch(PDO::FETCH_OBJ))
				{
					$sql3="UPDATE portfolio SET qty_por=qty_por+'$qty' WHERE id_portfolio='$Sale_Class->Id_class'";
					echo $sql3;
					$conn->exec($sql3);
				}
				else
				{
					
					$sql4="SELECT * FROM Class a,purchases p 
					WHERE
					p.id_class=a.Id_class
					AND
					a.Id_class='$Sale_Class->Id_class'
					AND
					p.id_class NOT IN 
					(
					SELECT id_portfolio FROM portfolio
					)
					";
					
				
					$Search_pro2=$conn->query($sql4);
					if($Sale_pro2=$Search_pro2->fetch(PDO::FETCH_OBJ))
					{
							$sql2="INSERT INTO portfolio (id_portfolio,qty_por,price) VALUES ('$Sale_Class->Id_class','$qty','$Sale_Class->Price')";
							if($conn->exec($sql2))
							{
										
										
							}
							else
							{
								?>	
						
							<script type="text/javascript">
								alert("الصنف غير موجود !! ");
							</script>
							<?
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
	
	
	
	
//////////////////////////////////////////////////////////////////
//									View_Class

	$sql_total="SELECT SUM(`price`*`qty_por`) AS total_price  FROM portfolio";
	$total=$conn->query($sql_total);			
		$total_price=$total->fetch(PDO::FETCH_OBJ);
	

/////////////////////////////////////////////////////////////////////////	
	
			
	
?>
					<div class="span9">
						<div class="content">
							<div class="module">
								<div class="module-head"><ul class="widget widget-menu unstyled">
								
									<h2><center>فاتورة البيع<hr></h2></center>
									<form action="" method="post" onsubmit="return Cancel_Bill();">
									<button type="submit"   name="Cancel" class="btn btn-primary pull-right">إلغاء <i class="icon-remove"></i></button>
									</form>
									
									<form action="Print_sale.php"  method="post"  onsubmit="return End_Bill();">

											<button type="submit" name="Cash_Sale" id="Print" class="btn btn-primary pull-right"><i class="icon-money"></i> بيع و طباعة </button>
										
									
									
									<li><center><h2 class="price_class" > أجمالي السعر : <? echo $total_price->total_price; ?> د.ل  </h2>

									</center>
								</div>						
							<div class="module-body">
								<table class="table">
								  <thead>
									<tr>
									
									  <th>الصورة</th>
									  <th>باركود</th>
									  <th>الأسم</th>
									   <th>الكمية</th>

									  <th><i class='icon-money'></i> سعر القطعة </th>
									  <th><i class='icon-money'></i> الإجمالي </th>
									</tr>
								  </thead>
								  <tbody>
								<?
								$n=0;
								$sql3="SELECT * FROM portfolio,Class  WHERE id_portfolio=Id_class AND  del='0'";
								$View_Classes=$conn->query($sql3);	
								while($View_Class=$View_Classes->fetch(PDO::FETCH_OBJ))
								{
									$n++;
										
										
								?>
									<tr>
									  
									  <?
									  if($View_Class->Img!="")
									  {
										  ?>
										  <td><img src="images/shoses/<? echo "$View_Class->Img"; ?>" height="120" width="120" /></td>
									  <?
									  }
									  else
									  {
										  ?>
										  <td><img src="images/shoses/class.jpg" height="120" width="120" /></td>
										  <?
										  
									  }
									  ?>
									  
									  <td><? echo ("$View_Class->barcode"); ?></td>
									  <td><? echo "$View_Class->Name"; ?></td>
									   <td><? echo "$View_Class->qty_por"; ?></td>
									  <td><? echo $View_Class->Price; ?> د.ل </td>
									   <td><? echo $View_Class->Price*$View_Class->qty_por; ?> د.ل </td>
									</tr>
								<?
								}
								?>
								  </tbody>
								</table>
								</form>
							</div>
							</div>
						</div>
					</div>
			
<?	

//______________________________________________________________________________


}
//_______________________________________________________________________________________________________
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
											<button type="submit" name="Logout" class="btn btn-primary pull-center">تسجيل الخروج <i class="icon-signout"></i>  طباعة فاتورة اليوم  <i class="icon-print"></i></button>
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

if(isset($_POST['Cancel']))
{
	$conn->exec("DELETE FROM `nike`.`portfolio`");
	Form();
}

else if(isset($_POST['Search']))
{ 
	Form();
	Search_View($conn);
}
else
{
	$conn->exec("DELETE FROM `nike`.`portfolio`");
	Form();

}
?>					
				 </div><!--/.content-->
			</div>
		</div>

			

	<div class="footer">
		<div class="container">
			 

          <b class="copyright">&copy; <? echo gmdate("Y", time() + 2 * 3600);?> Nike - Sales System </b> is Programmed by Hamza Hamruni.
		</div>
	</div>

	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
		

</body>
<?
}
else
{
	header('Location: http://localhost/Nike/index.php');
}