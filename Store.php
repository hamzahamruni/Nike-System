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
    </head>
<?
include_once ("connection.php");
session_start(  );	


function Form()
{
	?>
						<div class="span9">
						<div class="content">
							<div class="module">
								<div class="module-head">
									<h3>المخزن</h3>
									<hr>
								</div>
								<form action="" method="post" class="form-horizontal row-fluid" onsubmit="return valid();">
										
										<div class="control-group">
											<label class="control-label" id="lbarcode">باركود</label>
											<div class="controls">
												<div class="input-prepend">
													<span class="add-on"><h4><i class="menu-icon icon-barcode"></i></h4></span>
													<input type="text" name="barcode" id="barcode" maxlength=13      class="span9"  placeholder="Barcode"><label id="codemsg"></label>
												</div>
											</div>
										</div>
										
										<div class="control-group" >
											<label  class="control-label"  id="lname" >الأسم</label>
											<div class="controls" >
												<input type="text" id="name" name="N_Name" class="span5"><label id="namemsg"></label>
											</div>
										</div>
										
										<div class="control-group">
												<label class="control-label" id="account">النوع</label>
												<div class="controls">
												
													<select tabindex="1" class="span5" name = "type" onchange="changeE(this)">
													
														<option value="">كل الأنواع</option>
														
															<option value="S" >أحدية</option>
															<option value="C" >ملابس</option>
															<option value="A" >أكسسوارات</option>
														
													</select>
												</div>
										</div>
										
							
										
										<div class="control-group">
											<div class="controls">
												<button type="submit" name="View" class="btn btn-primary pull-center">عرض <i class="icon-search"></i></button>
											</div>
										</div>
										
								</form><br>
							
							</div>
						</div>
					</div>
	<?
}
function Search_View($conn)
{
	extract($_POST);
	if((isset($_POST['View'])))
	{
		$T=true;
		
			if($_POST['barcode']!="")
			{
				$sql_search_class="SELECT * FROM class as c,purchases as p WHERE c.Id_class=p.id_class  AND  c.barcode='$barcode' AND  p.qty_store>'0' AND AND  c.type LIKE '%$type%' c.del='0' ORDER BY c.type DESC ";
				
			}
			else
			{
				$sql_search_class="SELECT * FROM class as c,purchases as p WHERE c.Id_class=p.id_class  AND  c.Name LIKE '%$N_Name%' AND  c.type LIKE '%$type%' AND  p.qty_store>'0' AND  c.del='0' ORDER BY c.type DESC ";
				
			}
		
		
		

	}
	else
	{
		
			
			$sql_search_class="SELECT * FROM class as c,purchases as p WHERE c.Id_class=p.id_class  AND  p.qty_store>'0' AND  c.del='0' ORDER BY c.type DESC ";
		
	}
	
	$Test= $conn->query($sql_search_class);
	
	if(! $Test->fetch(PDO::FETCH_OBJ))
	{
			?>	
			
				<script type="text/javascript">
					alert("هداالصنف غير موجود !!");
				</script>
			<?
	}

	?>

        

    <div class="span9">
        <div class="content">
			<div class="btn-controls">
<?
	$count_class=0;
	$count_sum_class=0;

	$barcode=0;
	$search= $conn->query($sql_search_class);
	while($view_class=$search->fetch(PDO::FETCH_OBJ))
	{
	$count_class++;
		$Code=$view_class->Code;
		$Color=$view_class->Color;

		
		if($barcode!=$view_class->barcode)
		{
			$barcode=$view_class->barcode;
			
		?>
			<div class="btn-box-row row-fluid">
				<a  class="btn-box big span4" target="_blank">
			
			<?
			if($view_class->Img!="")
			{
				?>
				<img src="images/shoses/<? echo"$view_class->Img"; ?>" height="50%" width="50%" />  
				<?
				
			}
			else
			{
				?>
				    <img src="images/shoses/class.jpg" height="50%" width="50%" />
				<?
			}
			?>
			                                    
			<p class="text-muted">
			<b><? echo"$view_class->Name"; ?></b>
			<b><? echo"$view_class->Code-$view_class->Color"; ?></b>
			<b><?
			if($view_class->type=='S')echo"أحدية"; 
			if($view_class->type=='C')echo"ملابس";
			if($view_class->type=='A')echo"أكسسوارات";
			?>
			</b>
						<b><?echo "الكمية  : ",$view_class->qty_store;?></b>
			<? $count_sum_class+=$view_class->qty_store; ?>
	<br>
			<b>السعر البيع	<? echo " $view_class->Price	 "; ?> د.ل </b>

				
	
			</p>
			
						
							</a>
					
							
		<?
		
		}
	
	?>
	
		
		<?
		
		
		
	}
	?>
									<table class="table table-bordered">
										<thead>
										<tr>
										
											<th><center>
											<h2>عدد  الأصناف  : <? echo "$count_class ";?> </h2>
											<h2>إجمالي الكمية  : <? echo "$count_sum_class ";?> </h2>
									
											</center>
											</th>
											
										</tr>
										</thead>
									</table>

			</div>
        </div>
    </div>
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
						<i class="menu-icon icon-time"></i>&nbsp;<? echo gmdate(" h:i A Y-m-d ", time() + 2 * 3600);?>
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


	Form();
	Search_View($conn);
?>

				    </div><!--/.content-->
				</div><!--/.span9-->
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
	header('Location: index.php');
}
