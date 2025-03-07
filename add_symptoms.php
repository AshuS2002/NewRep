<?php
session_start();
error_reporting(0);
include('link/config.php');

if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location:index.php"); 
    }
    else{ 

if(isset($_POST['submit']))
{
$uniqueid=$_POST['uniqueid'];
$diseasename=$_POST['fullanme'];
$dname=$_POST['dname'];
$sql="INSERT INTO  symptoms_tb(symptoms_id,symptoms_name,disease_id) VALUES(:uniqueid,:diseasename,:dname)";
$query = $dbh->prepare($sql);
$query->bindParam(':uniqueid',$uniqueid,PDO::PARAM_STR);
$query->bindParam(':diseasename',$diseasename,PDO::PARAM_STR);
$query->bindParam(':dname',$dname,PDO::PARAM_STR);
$query->execute();

$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Symptoms Added Succesfully";
}
else 
{
$error="Something went wrong. Please try again";
}

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Add Symptoms </title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" type="text/css" href="js/DataTables/datatables.min.css"/>
        <link rel="stylesheet" href="css/form-content.css" media="screen" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
        <style>
            body{
                background-color:white;
            }
            </style>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
  <?php include('link/topbar.php');?> 
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">

                    <!-- ========== LEFT SIDEBAR ========== -->
              
                    <!-- /.left-sidebar -->

                    <div class="main-page">

                     <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">ADD SYMPTOMS</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="admin_edit_choice.php"><i class="fa fa-home"></i> Home</a></li>
                                
                                        <li class="active">ADD SYMPTOMS </li>
                                    </ul>
                                </div>
                             
                            </div>
                            <!-- /.row --> 
                        </div>
                        <div class="container-fluid">
                           
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel">
                                          
                                            </div>
                                            <div class="panel-body">
<?php if($msg){?>
<div class="result-color1" role="alert">
 <strong>Well done!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="result-red" role="alert">
                                            <strong>Oh!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
                                                <form class="form-horizontal" method="post">


 <div class="form-group">
<label for="default" class="col-sm-2 control-label">Enter Symptoms ID</label>
<div class="col-sm-10">
<input type="number" name="uniqueid" class="form-control" id="fullanme" required="required" autocomplete="off">
</div>
</div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Enter Symptoms Name </label>
<div class="col-sm-10">
<input type="text" name="fullanme" class="form-control" id="fullanme" required="required" autocomplete="off">
</div>
</div>

<div class="form-group">
         <label for="default" class="col-sm-2 control-label">Select Disease </label>
      <div class="col-sm-10">
         <select name="dname" class="form-control" id="default" required="required">
        <option value="">Select Disease</option>
        <?php $sql = "SELECT * from disease_tb";
        $query = $dbh->prepare($sql);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        if($query->rowCount() > 0)
        {
        foreach($results as $result)
        {   ?>
        <option value="<?php echo htmlentities($result->disease_id); ?>"><?php echo htmlentities($result->disease_id); ?>.<?php echo htmlentities($result->disease_name); ?>&nbsp;</option>
        <?php }} ?>
         </select>
                                                                </div>
                                                            </div>


                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="submit" class="result-color1">&nbspADD&nbsp</button>
                                                          
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-12 -->
                                </div>
                    </div>
                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- /.main-wrapper -->
        <script src="js/jquery-2.2.4.min.js"></script>

        <script src="js/main.js"></script>
        <script>
            $(function($) {
                $(".js-states").select2();
                $(".js-states-limit").select2({
                    maximumSelectionLength: 2
                });
                $(".js-states-hide").select2({
                    minimumResultsForSearch: Infinity
                });
            });
        </script>
    </body>
</html>
<?PHP } ?>
