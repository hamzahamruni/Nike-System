<!DOCTYPE html>
<html lang="ar" dir="rtl" >
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
?>
</script>
<?
if(!$_SESSION['Logout'])
{
?>
    <body>

        <!-- /navbar -->
    <div class="wrapper">
        <div class="container">
            <div class="row">

				<img src="images/logo.jpg" width=300 height=300  />
				<img src="images/name.jpg" width=300 height=300 />
				
				
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->
<?
		extract($_POST);

		
		
		$sql_search_Bill_Data="SELECT * FROM sale s,relation_class_sale r,class c WHERE r.id_sale=s.Id_sale AND r.id_class=c.Id_class AND s.del='0' AND ( date>='$year-01-01 00:00:01' AND date<='$year-12-31 23:59:59') ORDER BY date,s.Id_sale  ";
	
		$Search_Data_Bill=$conn->query($sql_search_Bill_Data);
		?>
				<div class="span12">
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
												<br><br><br>
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


			<script type="text/javascript">
				window.print();
			</script>	
			
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
	header('Location: http://localhost/Nike/index.php');
}