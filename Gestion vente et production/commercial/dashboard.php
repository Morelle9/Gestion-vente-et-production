<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
//if (strlen($_SESSION['imsaid']==0)) {
  //header('location:logout.php');
//} else{

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Gestion Ventes et Production|| Dashboard</title>

<?php include_once('includes/cs.php');?>
</head>
<body>



<?php include_once('includes/header.php');?>
<?php include_once('includes/sidebar.php');?>
<!--sidebar-menu-->

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
<!--End-breadcrumbs-->

<!--Action boxes-->
<br />
  <div class="container-fluid">
   <div class="widget-box widget-plain">
      <div class="center">

<ul class="quick-actions">
<?php $query1=mysqli_query($con,"Select * from ventes where Status='1'");
$brandcount=mysqli_num_rows($query1);
?>
        <li class="bg_lb"> <a href="ajouter_vente.php"><i class="fa fa-building-o fa-3x"></i><br /> 
         <span class="label label-important" style="margin-top:5%"><?php echo $brandcount;?></span> Ajouter une Ventes </a> </li>


  <?php $query1=mysqli_query($con,"Select * from ventes where Status='1'");
$brandcount=mysqli_num_rows($query1);
?>
        <li class="bg_lb"> <a href="liste_vente.php"><i class="fa fa-building-o fa-3x"></i><br /> 
         <span class="label label-important" style="margin-top:5%"><?php echo $brandcount;?></span> Ventes </a> </li>

<?php $query2=mysqli_query($con,"Select * from vendeur where Status='1'");
$catcount=mysqli_num_rows($query2);
?>

        <li class="bg_ly"> <a href="Liste_vendeurs.php"> <i class="icon-list fa-3x"></i>
          <span class="label label-success" style="margin-top:7%"><?php echo $catcount;?></span> Commercial </a> </li>

          <?php $query1=mysqli_query($con,"Select * from vendeur where Status='1'");
$brandcount=mysqli_num_rows($query1);
?>
        <li class="bg_lb"> <a href="ajouter_vendeur.php"><i class="fa fa-building-o fa-3x"></i><br /> 
         <span class="label label-important" style="margin-top:5%"><?php echo $brandcount;?></span> Ajouter un commercial </a> </li>

         <?php $query1=mysqli_query($con,"Select * from clients where Status='1'");
$brandcount=mysqli_num_rows($query1);
?>
        <li class="bg_lb"> <a href="ajouter_client.php"><i class="fa fa-building-o fa-3x"></i><br /> 
         <span class="label label-important" style="margin-top:5%"><?php echo $brandcount;?></span> Ajouter un client </a> </li>

<?php $query3=mysqli_query($con,"Select * from clients where Status='1'");
$subcatcount=mysqli_num_rows($query3);
?>

        <li class="bg_lo"> <a href="Liste_clients.php">  <i class="icon-th"></i> <span class="label label--success" style="margin-top:7%"><?php echo $subcatcount;?></span>&nbsp; Clients</a> </li>



      </ul>




      
<?php include_once('includes/footer.php');?>

<?php include_once('includes/js.php');?>
</body>
</html>