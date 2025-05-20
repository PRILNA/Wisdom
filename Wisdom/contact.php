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
	
  $logoutGoTo = "index.php";
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

$colname_blog_search = "-1";
if (isset($_POST['searchin'])) {
  $colname_blog_search = $_POST['searchin'];
}
mysql_select_db($database_wisdom, $wisdom);
$query_blog_search = sprintf("SELECT * FROM blogs WHERE blog_text LIKE %s", GetSQLValueString("%" . $colname_blog_search . "%", "text"));
$blog_search = mysql_query($query_blog_search, $wisdom) or die(mysql_error());
$row_blog_search = mysql_fetch_assoc($blog_search);
$totalRows_blog_search = mysql_num_rows($blog_search);
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
          
          <form name="searchbar" class="navbar-form navbar-right" method="post">
            <div class="form-group">
              <input name="searchin" type="text" class="form-control" placeholder="Search" required>
            </div>
            <button name="searchbutton" type="submit" style="display:none">Submit</button>
          </form>
          
          </ul>
        </div><!-- /.navbar-collapse -->
        
        </nav>
       </div>
       </div><!--col-md-12 -->
        
    </div><!--container-fluid -->
    
	<?php if($row_blog_search > 0) { ?>
    <div class="container-fluid bg_blue" id="aaa">
    <div class="alert alert-dismissible alert-info">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <div class="col-md-12">
            <?php do { ?>
              <a href="blog_full.php?sl_no=<?php echo $row_blog_search['sl_no']; ?>">
                <?php echo $row_blog_search['blog_heading']; ?>
              </a>
              <p style="height:50px;overflow:hidden"><?php echo $row_blog_search['blog_text']; ?></p>
            <?php } while ($row_blog_search = mysql_fetch_assoc($blog_search)); ?><br>
        </div>
        <div class="clearfix"></div>
       </div>
    </div><!--containerfluid -->
    <?php } ?>
    
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
                         <p>
                         You can contact us any way that is convenient for you. We are available 24/7 via fax or email. You can also use a quick contact form below or visit our office personally. We would be happy to answer your questions.
                         </p><br>
        
                <div class="col-md-6 pad20"><div class="col-md-12">
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
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13216.94143107018!2d76.27044016922166!3d9.982106148410416!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b080d537fca8aad%3A0x7718d3ac5b6c03ea!2sMarine+Drive%2C+Kochi%2C+Kerala%2C+India!5e0!3m2!1sen!2sin!4v1480675125698" width="100%" height="320" frameborder="0" style="border:0" allowfullscreen class="pad20"></iframe>
                
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
            
                <iframe src="https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d125706.85775267462!2d76.25153710614374!3d10.071259217088977!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e6!4m5!1s0x3b080882748f4a6f%3A0x30b2ebe45d968458!2sCochin+International+Airport+(COK)%2C+Airport+Road%2C+Kochi%2C+Kerala+683111%2C+India!3m2!1d10.1517834!2d76.392958!4m5!1s0x3b080d537fca8aad%3A0x7718d3ac5b6c03ea!2sMarine+Drive%2C+Kochi%2C+Kerala%2C+India!3m2!1d9.9825798!2d76.27542749999999!5e0!3m2!1sen!2sin!4v1480675282902" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
            
            </div><!--col-md6 -->
            <div class="col-md-6"><h4 class="white_font" align="center">From South Railway Station</h4>
            
                <iframe src="https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d15717.795586373592!2d76.27413701011827!3d9.979728242725526!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e6!4m5!1s0x3b0872b4498c107f%3A0x2da22b212ba9d071!2sErnakulam+Junction+South%2C+South+Railway+Station+Road%2C+Ernakulam+South%2C+Kochi%2C+Kerala+682011%2C+India!3m2!1d9.969055599999999!2d76.2910113!4m5!1s0x3b080d537fca8aad%3A0x7718d3ac5b6c03ea!2sMarine+Drive%2C+Kochi%2C+Kerala%2C+India!3m2!1d9.9825798!2d76.27542749999999!5e0!3m2!1sen!2sin!4v1480675390256" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
            
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

mysql_free_result($blog_search);
?>
