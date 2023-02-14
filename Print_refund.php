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

//_______________________________________________________________________________________________________
if(!$_SESSION['Logout'])
{
?>
    <body>



		<div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">

                    <div class="nav-collapse collapse navbar-inverse-collapse">
						<a href="home.php">
                        <ul class="nav nav-icons"><br>
						<img src="images/logo.jpg" width=200 height=200  />
                        </ul>
						<ul class="nav nav-icons"><br>
						<img src="images/name.jpg" width=200 height=200  />
                        </ul></a>	
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
                    </div>
                    <!-- /.nav-collapse -->
                </div>
            </div>
            <!-- /navbar-inner -->
        </div>
		
		
	        <!-- /navbar -->
<?
	if(isset($_POST['Cash_Sale']))
	{
	
		$Date=date ("Y-m-d H:i:s", time() + 2 * 3600);
		$bill=false;
		$bill2=false;
		
		$sql_total="SELECT SUM(`price`) AS total_price  FROM portfolio";
		$total=$conn->query($sql_total);
		$total_price=$total->fetch(PDO::FETCH_OBJ);	
		if(!(isset($total_price->total_price)))
		{
			header('Location: http://localhost/Nike/Sale_dis_ch.php');
		}
		
							$id_user=$_SESSION['id'];
							$sql_insert_sales="INSERT INTO sale (Id_sale,date,total_price,paid,id_user,del) VALUES (null,CURRENT_TIMESTAMP,'$total_price->total_price','$total_price->total_price','$id_user','0')";
							if($conn->exec($sql_insert_sales))
							{
								$bill=true;
							}
							else
							{
								$bill=false;
							}
							
							
							
	
							$sql_search_Bill_Data="SELECT MAX(`Id_sale`) AS ID FROM sale";
							$Search_Data_Bill=$conn->query($sql_search_Bill_Data);
							$Data_Bill=$Search_Data_Bill->fetch(PDO::FETCH_OBJ);
							
							
							$Id_sale=$Data_Bill->ID;
//_________________________________________________________________________________________________________________
?>
				
				
				
				
				
				<img src="images/Nike.jpg" width=300 height=300  />
			
			<?
						$sql3="SELECT * FROM portfolio,Class  WHERE id_portfolio=Id_class AND  del='1'";
						$View_Classes=$conn->query($sql3);	
						
						while($View_Class=$View_Classes->fetch(PDO::FETCH_OBJ))
						{
							$sql_insert_sales_realtion="INSERT INTO relation_class_sale (id_relation,id_sale,id_class,class_price) VALUES (null,'$Id_sale','$View_Class->Id_class','$View_Class->price')";
							if($conn->exec($sql_insert_sales_realtion))
							{
								$bill2=true;
							}
							else
							{
								$bill2=false;
							}	
						}
						
						
						
						if($bill AND $bill2)
						{
			?>
				
				<br><br>
				<div class="span9">
					<div class="content">
						<div class="module">
						<div class="module-head">
							<h3>	 فاتورة البيع Nike</h3>
						<br><i class="icon-facebook"></i> : Nike 
						<br><i class="icon-camera"></i> : Nike
						<br><i class="icon-phone"></i> : 091xxxxxxx 
						<br>
						<strong dir="rtl"> رقم فاتورة <? echo "$Id_sale"; ?></strong><BR>
							تا يخ و وفت فاتورة 
							<? 
								$Time=strtotime($Date);
								echo date("Y-m-d h:i A",$Time);
							?>
						</div>
						
								<table class="table table-bordered">
								  <thead>
									<tr>
									  <th>#</th>
								
									  <th>أسم الصنف</th>
									  <th>السعر</th>
									</tr>
								  </thead>
								<tbody>
							<?
							$n=0;
							$View_Classes=$conn->query($sql3);
							while($View_Class=$View_Classes->fetch(PDO::FETCH_OBJ))
							{
								$n++;
//______________________________________________________________________________________________________________________________________________
//									Insert 

									$sql_update="UPDATE Class SET del='0' WHERE Id_class='$View_Class->Id_class' ";
								if($conn->exec($sql_update))
								{
					
								
								echo"<tr>
									  <td>$n</td>
								
									  <td>$View_Class->Name</td>
									  <td>$View_Class->price د.ل </td>
									</tr>";
								}
							}
							?>
								  </tbody>
								

								 </table>
								 
									<table class="table table-bordered">
										<thead>
										<tr>
												<th>
										<center>	<h3> أجمالي السعر <? echo "$total_price->total_price ";?> د.ل </h3></center>
											</th>
										</tr>
										</thead>
									</table>
								<br>
						</div>
					</div>
				</div>
				<?
					
							$conn->exec("DELETE FROM `libya_phone`.`portfolio`");

		
						}
						else
						{
							$conn = null;
						}
							
				
					
		?>	

		<strong><i class="icon-tag"></i> Note : Goods are only replaced </strong><br>
		<strong> ملاحظة : البضاعة المباعة تستبدل فقط لمدة تلاتة أيام  <i class="icon-tag"></i></strong><br>

<?
		if($bill AND $bill2)
		{
			?>		
			<script type="text/javascript">
				window.print();
			</script>	
			<?
		}
	}
	else
	{
		header('Location: http://localhost/Nike/Home.php');
	}
	
	?>
	<div class="footer">
		<div class="container">
			 

          <b class="copyright"><? echo gmdate("Y", time() + 2 * 3600);?>تشرفنا بحضوركم  Nike شكراً لختياركم  </b>
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