<?php require_once('Connections/wisdom.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "about.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "contact_form")) {
  $insertSQL = sprintf("INSERT INTO contact (Name, Email, Message) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['msg'], "text"));

  mysql_select_db($database_wisdom, $wisdom);
  $Result1 = mysql_query($insertSQL, $wisdom) or die(mysql_error());

  $insertGoTo = "contact.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_wisdom, $wisdom);
$query_contact = "SELECT * FROM contact";
$contact = mysql_query($query_contact, $wisdom) or die(mysql_error());
$row_contact = mysql_fetch_assoc($contact);
$totalRows_contact = mysql_num_rows($contact);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Wisdom Institute</title>
    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/my_style.css" rel="stylesheet" type="text/css" />
    
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script src="js/jquery-2.1.3.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<link href="css/thumbnail-slider.css" rel="stylesheet" />
	<script src="js/thumbnail-slider.js"></script>

</head>

<body>

	<div class="container-fluid bg_blue">
      <div class="col-lg-12" >
        <div class="login-icon">
        
			<?php if(isset($_SESSION['MM_Username'])){ ?>
            	<a href="<?php echo $logoutAction ?>" class="pull-right"> <i class="fa fa-sign-out"></i> Logout</a><span class="user_text pull-right white_font"><i class="fa fa-user"> </i> <?php echo ($_SESSION['MM_Username']) ?></span>
            	<div class="clearfix"></div>
            <?php } else { ?>
            	<a href="login.php" class="pull-right"><i class="fa fa-sign-in"></i> Login</a>
            	<div class="clearfix"></div> 
            <?php } ?>
        </div><!--login_icon -->
      </div><!--col-lg-12 -->
      
      <div class="col-md-12">
        <div class="row">
      
          <nav class="navbar">
			<div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img src="images/logo_03.jpg" class="img-responsive" width="160px" /></a>
        </div>
        
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="blog.php">Blog</a></li>
            <li class="active"><a href="contact.php">Contact</a></li>
          
          
          <form name="searchbar" class="navbar-form navbar-right">
            <div class="form-group">
              <input name="searchinput" type="text" class="form-control" placeholder="Search">
            </div>
            <button name="searchbutton" type="submit" class="btn btn-default" style="display:none">Submit</button>
          </form>
          
          </ul>
        </div><!-- /.navbar-collapse -->
        
        </nav>
       </div>
       </div><!--col-md-12 -->
        
    </div><!--container-fluid -->
    
    <div class="container-fluid bg_blue">
        <div class="col-md-12">  
            <hr class="navbar-line" />
        </div>
    </div><!--containerfluid -->
 
   
    
    <div class="container-fluid bg_pattern">
    <div class="row">
     
     <ol class="breadcrumb text-center orange_font" >
     	<li><a href="index.php">Home</a></li>
    	<li><a href="#">Contact</a></li>
      </ol> 
      <h1 class="blue_font text-center">Contact us</h1>
   
    

        
        <div class="col-md-12 pad10">
               <div class="box2">
                <div class="row">
                  <h3 class="orange_font">Send us a message</h3>
                         <p>Donec porta ipsum turpis, eget malesuada est 			  						 pharetra non. Proin ipsum eros, finibus at nisl  						 et, dignissim consectetur orci. Aliquam a eros   	  					 iaculis, laoreet nisl a, condimentum purus.      					 Pellentesque at sapien id velit tempus mollis    					 sit amet sed diam.</p><br>
        
                <div class="col-md-6"><div class="col-md-12">
                    <div class="row">
                        <form method="POST" action="<?php echo $editFormAction; ?>" name="contact_form" class="form-horizontal">
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="pwd"><h5>Name:</h5></label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="name">
                              </div>
                            </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="email"><h5>Email:</h5></label>
                              <div class="col-sm-10">
                                <input type="email" class="form-control" name="email">
                              </div>
                            </div>
                           <div class="form-group">
                              <label class="control-label col-sm-2" for="msg"><h5>Message:</h5></label>
                              <div class="col-sm-10">
                                <textarea class="form-control" name="msg" rows="7"></textarea>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="more-btn3 pull-right">Send</button>
                              </div>
                          </div><!--form_group -->
                          <input type="hidden" name="MM_insert" value="contact_form">	
                        </form>
                    </div><!--row -->
                </div><!--col-md-6 --></div><!--col-md-6 -->
        
                <div class="col-md-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d15617.756663687538!2d75.37036604999999!3d11.8744777!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1480405296459" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                
                </div><!--col-md-6 -->
        		</div>
        	</div><!--row -->
    		</div><!--box2 --> 
        </div><!--col-md-12 -->
    </div><!--containerfluid -->
    
    <div class="container-fluid bg_pattern pad40">
        
        <div class="col-md-12">
            
            <div class="row">
               <div class="box2">
                <div class="row text-center">
                   <div class="col-md-4"><h4><i class="fa fa-envelope-o orange_font fa-1_2x"></i> <span class="contact_item">&nbsp;wisdominstitute@gmail.com</span></h4></div><!--col-md-4 -->
                   <div class="col-md-4"><h4><i class="fa fa-mobile orange_font fa-1_5x"></i> <span class="contact_item">&nbsp;0450-23456790</span></h4></div><!--col-md-4 -->
                   <div class="col-md-4"><h4><i class="fa fa-map-marker orange_font fa-1_5x"></i> <span class="contact_item">&nbsp;Nr. Abcd, Cochin-01</span></h4></div><!--col-md-4 -->
                   
                   
        	    </div><!--row -->
    		  </div><!--box2 -->   
        </div><!--col-md-12 -->
        </div><!--row -->
    </div><!--containerfluid -->
    
    
    
    
    
    <div class="bg_pattern pad40">
        <div class="container-fluid bg_orange pad60">
            <div class="col-md-12">
                <h2 class="white_font text-center">Route Map</h2><br>
    		</div><!--col-md-12 -->
            <div class="col-md-6"><h4 class="white_font" align="center">From Cochin Airport</h4>
            
                <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d15617.756663687538!2d75.37036604999999!3d11.8744777!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1480405296459" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
            
            </div><!--col-md6 -->
            <div class="col-md-6"><h4 class="white_font" align="center">From Railway Station</h4>
            
                <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d15617.756663687538!2d75.37036604999999!3d11.8744777!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1480405296459" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
            
            </div><!--col-md6 -->
            
   		 </div><!--container-fluid -->
  
  
               
  
       
  <div class="bg_pattern pad20">
    
    <div class="container-fluid bg_footer">
           <div class="col-md-12">
        	<div class="col-md-6">
     			<p class="white_font">Copyright &copy; 2016</p>
        	</div><!--col-md-6 -->
        	<div class="col-md-6">
                <ul class="nav nav-pills navbar-right">
                	<li><a href="index.php">Home</a></li>
                	<li><a href="about.php">About</a></li>
                	<li><a href="blog.php">Blog</a></li>
                	<li><a href="courses.php">Courses</a></li>
                	<li><a href="contact.php">Contact</a></li>
                </ul>
        	</div><!--col-md-6 -->
           </div><!--col-md-12 --> 
    </div><!--container-fluid -->
  </div><!--bg_pattern -->

</body>
</html>
<?php
mysql_free_result($contact);
?>
