<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['imsaid']==0)) {
  header('location:logoutClient.php');
  } else{

if(isset($_POST['update']))
  {
    $id = $_GET['id']; 
    $accountID = $_POST['accountID'];
    $accountType = $_POST['accountType'];
    $contactName = $_POST['contactName'];
    $companyName = $_POST['companyName'];
    $address = $_POST['address'];
    $cellphnumber = $_POST['cellphnumber'];
    $email = $_POST['email'];
    $notes = $_POST['notes'];
    $password = $_POST['password'];
    $creationdate = $_POST['creationdate'];
     
    $query=mysqli_query($con, "update tblclient set AccountID ='$accountID', AccountType='$accountType', ContactName='$contactName', CompanyName ='$companyName', Address='$address', Cell='$contactName' where ID='$sid'");
    
    if ($query) {
    echo '<script>alert("Client has been updated.")</script>';
  }
  else
    {
       echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  
}
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Gestion COMPAFRIQUE|| Update Client</title>
<?php include_once('includes/cs.php');?>
</head>
<body>

<!--Header-part-->
<?php include_once('includes/header.php');?>
<?php include_once('includes/sidebar.php');?>


<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <strong>Update Client</strong></div>
  <h1>Update Client</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Update Category</h5>
        </div>
        <div class="widget-content nopadding">
          <form method="post" class="form-horizontal">
           <?php
                     $sid=$_GET['scid'];
$ret=mysqli_query($con,"select tblcategory.CategoryName as catname,tblcategory.ID as cid,tblclient.SubCategoryname as subcat,tblsubcategory.Status from tblsubcategory inner join tblcategory on tblcategory.ID=tblsubcategory.CatID where tblsubcategory.ID='$sid'");

while ($row=mysqli_fetch_array($ret)) {

?>
            <div class="control-group">
              <label class="control-label">Category Name :</label>
              <div class="controls">
                <select name="category" class="span11" required="true">
                    <option value="<?php echo $row['cid'];?>"><?php echo $row['catname'];?></option>
              <?php $query=mysqli_query($con,"select * from tblcategory");
              while($result=mysqli_fetch_array($query))
              {
              ?>      
                  <option value="<?php echo $result['ID'];?>"><?php echo $result['CategoryName'];?></option>
                  <?php } ?>
                  </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Sub Category Name :</label>
              <div class="controls">
                <input type="text" class="span11" name="subcat" id="subcat" value="<?php  echo $row['subcat'];?>" required='true' />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Status :</label>
              <div class="controls">
                <?php  if($row['Status']=="1"){ ?>
                <input type="checkbox"  name="status" id="status" value="1"  checked="true"/>
                <?php } else { ?>
                  <input type="checkbox" value='1' name="status" id="status" />
                  <?php } ?>
              </div>
            </div>
            
           <?php } ?>
            <div class="form-actions">
              <button type="submit" class="btn btn-success" name="update">Update</button>
            </div>
          </form>
        </div>
      </div>
    
    </div>
  </div>
 </div>
</div>
<?php include_once('includes/footer.php');?>
<?php include_once('includes/js.php');?>
</body>
</html>
<?php } ?>