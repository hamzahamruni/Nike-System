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
<?php
include_once ("connection.php");
session_start();	

function form($conn)
{
						$year=0;
						$month=0;
					
						$sql_search_Bill_Data="SELECT * FROM  sale WHERE date>='2020-01-01 00:00:01' AND date<='2090-12-31 23:59:591' AND del='0'";
						$Search_Data_Bill=$conn->query($sql_search_Bill_Data);
							
	?>
					<div class="span9">
						<div class="content">

							<div class="module">
								<div class="module-head">
									<h3>تقرير إردات السنة <i class="icon-print"></i></h3>
									<hr>
						
								</div>
							
								<form action="" method="post" class="form-horizontal row-fluid">
		
								
								<div class="control-group">			
									<div class="controls">
											<div class="control-group">
										
											
												
												
												
												
											
												
												
											<SELECT  name = "year"  class="span3">
													<?
											while($Data_Bill=$Search_Data_Bill->fetch(PDO::FETCH_OBJ))
											{
												if(date('Y',strtotime($Data_Bill->date))!=$year)
												{
													$year=date('Y',strtotime($Data_Bill->date));
											
											?>
														<option value="<?php echo date('Y',strtotime($Data_Bill->date)); ?>"><?php echo date('Y',strtotime($Data_Bill->date)); ?></option>
											<?
												}
											}
											?>
											</SELECT>
											
											</div>
											
										
									</div>
										<br>
										<div class="control-group">

											<div class="controls">
												<button type="submit" name="View" class="btn btn-primary pull-center">عرض تقرير <i class="icon-search"></i></button>
											</div>
										</div>
										
								</form>
								<br>
							
								</div>
						</div>
					</div>
			</div><!--/.span9-->
	<?
}
function View($conn)
{
		extract($_POST);
		if(!(isset($_POST['View'])))
		{
				$year=gmdate("Y", time() + 2 * 3600);
		}
		
		
		$sql_search_Bill_Data="SELECT * FROM sale s,relation_class_sale r,class c WHERE r.id_sale=s.Id_sale AND r.id_class=c.Id_class AND s.del='0' AND ( date>='$year-01-01 00:00:01' AND date<='$year-12-31 23:59:59') ORDER BY date,s.Id_sale  ";
	
		$Search_Data_Bill=$conn->query($sql_search_Bill_Data);
		?>
				<div class="span9">
					<div class="content">
						<div class="module">
								<div class="module-head"><ul class="widget widget-menu unstyled">
									<center><h2> إردات السنة <br><?  echo $year; ?> </h2></center>
								</div>						
							<div class="module-body">
								
									<?
								
								if($Search_Data_Bill)
            					{
										$Total_Sales_Month=0;
										$Total_Sales_Day=0;
										$Total_Sales_Year=0;
										$Total_Buy_Year=0;
										$ID=0;
										
										$day=0;
										$month=0;
									while($Data_Bill=$Search_Data_Bill->fetch(PDO::FETCH_OBJ))
										{
											$br=true;
												if($month != date('m',strtotime($Data_Bill->date)))
												{
													$br=false;
													
													$month=date('m',strtotime($Data_Bill->date));
													?>
													
													<table class="table table-bordered" dir="rtl" >
													<tbody>
												
												<?
												$sql_total_price_month="SELECT SUM(`total_price`) AS total_price_month  FROM sale WHERE ( date>='$year-$month-01 00:00:01' AND date<='$year-$month-31 23:59:59') ";
												
												$total_month=$conn->query($sql_total_price_month);
												$total_price_month=$total_month->fetch(PDO::FETCH_OBJ);	
												$Total_Sales_Year+=$total_price_month->total_price_month;
												?>
												<br><br>
													<tr>
														
														<th>
														<center>
														<h3> الشهر &nbsp; <? echo date('m M',strtotime($Data_Bill->date)); ?> &nbsp; &nbsp; أجمالي المبيعات : <? echo $total_price_month->total_price_month; ?> د.ل </h3>
														</center>
														</th>
												
													</tr>
												
													</tbody>
													</table>
													<?
												}
												if($day != date('d',strtotime($Data_Bill->date)))
												{
													$day=date('d',strtotime($Data_Bill->date));
													?>
													
													<table class="table table-bordered" dir="rtl" >
													<tbody>
												
												<?
												$sql_total_price_day="SELECT SUM(`total_price`) AS total_price_day  FROM sale WHERE ( date>='$year-$month-$day 00:00:01' AND date<='$year-$month-$day 23:59:59') ";
												
												$total_day=$conn->query($sql_total_price_day);
												$total_price_day=$total_day->fetch(PDO::FETCH_OBJ);	
												if($br)
												{
												?>
												<br><br>
												<?
												}
												?>
													<tr>
														
														<th>
														<center>
														<h4> اليوم &nbsp; <? echo date('d D',strtotime($Data_Bill->date)); ?> &nbsp; &nbsp; أجمالي المبيعات : <? echo $total_price_day->total_price_day; ?> د.ل </h4>
														</center>
														</th>
												
													</tr>
												
													</tbody>
													</table>
													<?
												}
											
										
											if($ID!=$Data_Bill->Id_sale)
											{
												$Total_Sales_Day=$Total_Sales_Day+$Data_Bill->total_price;
												$ID=$Data_Bill->Id_sale;
											?>
											
											<table class="table table-bordered" dir="rtl" >
											<thead>
											
											<tr>
												<th>
												<center>
												
												<h5>رقم فاتورة : <? echo "$Data_Bill->Id_sale"; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
													وقت فاتورة  : <?$Time=strtotime($Data_Bill->date); echo date("h:i A ",$Time); ?></h5><hr>	
												<h4>السعر الكلي : <? echo "$Data_Bill->total_price د.ل"; ?></h4>

												</center>
												</th>
											</tr>
											</thead>
											<thead>
											<tr>
												
												<th><center>أسم الصنف</center></th>
												<th><center>السعر الصنف <i class='icon-money'></i></center></th>
												<th><center>عند المستخدم <i class='icon-user'></i></center></th>
											</tr>
											</thead>
										<?
											}
										
										?>
											
											
											<tbody>
											
												<tr>
													
													<td><center><? echo "$Data_Bill->Name"; ?></center></td>
													<td><center><? echo " $Data_Bill->class_price د.ل "; ?></center></td>
												<?	
													$Search_user=$conn->query("SELECT * FROM users WHERE  id='$Data_Bill->id_user' ");
													$user=$Search_user->fetch(PDO::FETCH_OBJ);
													
												?>
													<td><center><? echo " $user->Name"; ?></center></td>
												</tr>
											
											</tbody>
											
								 <?
											$Total_Buy_Year+=$Data_Bill->Price_buy;
										}
			
								  ?>
								  </table>
								<br>
									<table class="table table-bordered">
										<thead>
										<tr>
											<th>
											<center>
											<h3> إجمالي إردات السنة  <? echo $year," : ","$Total_Sales_Year د.ل";?></h3>
											<?
											if($_SESSION['Priv']=='A')
											{
												?>
												<h3> إجمالي الشراء  <? echo "$Total_Buy_Year د.ل";?></h3>
												<h3> إجمالي الربح <? echo $Total_Sales_Year-$Total_Buy_Year," د.ل";?></h3>
												<?
											}
											?>
											</center>
											</th>
										</tr>
										</thead>
									</table>
									
									<br>
								<form action="Print_Bill_Year.php" target="_blank" method="post">
								
								<div class="control-group">
									<div class="controls">
									<input type="hidden" Name="year" value="<? echo "$year";?>">
									<input type="hidden" Name="month" value="<? echo "$month";?>">
									<input type="hidden" Name="day" value="<? echo "$day";?>">
											<button type="submit" name="Print" class="btn btn-primary pull-right"><i class="icon-print"></i> طباعة </button>
									</div>
								</div>
								</form>
								<br>
								<br>
								<?
								}
								else 
								{
								?>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
										<strong>لايوجد مبيعات اليوم !</strong> الحمد لله

									</div>
								<?
								}
							?>					
							</div>
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
						<img src="images/logo.jpg" width=100 height=200  />
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

	form($conn);
	View($conn);

	
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
	<script  src="js/select_date.js"></script>
</body>
<?
}
else
{
	header('Location: index.php');
}