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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO blogs (blog_heading, blog_text, image_name, author) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['blog_heading'], "text"),
                       GetSQLValueString($_POST['blog_text'], "text"),
                       GetSQLValueString($_POST['image_name'], "text"),
                       GetSQLValueString($_POST['author'], "text"));

  mysql_select_db($database_wisdom, $wisdom);
  $Result1 = mysql_query($insertSQL, $wisdom) or die(mysql_error());

  $insertGoTo = "blog.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$maxRows_blog_01 = 2;
$pageNum_blog_01 = 0;
if (isset($_GET['pageNum_blog_01'])) {
  $pageNum_blog_01 = $_GET['pageNum_blog_01'];
}
$startRow_blog_01 = $pageNum_blog_01 * $maxRows_blog_01;

mysql_select_db($database_wisdom, $wisdom);
$query_blog_01 = "SELECT * FROM blogs ORDER BY time_stamp DESC";
$query_limit_blog_01 = sprintf("%s LIMIT %d, %d", $query_blog_01, $startRow_blog_01, $maxRows_blog_01);
$blog_01 = mysql_query($query_limit_blog_01, $wisdom) or die(mysql_error());
$row_blog_01 = mysql_fetch_assoc($blog_01);

if (isset($_GET['totalRows_blog_01'])) {
  $totalRows_blog_01 = $_GET['totalRows_blog_01'];
} else {
  $all_blog_01 = mysql_query($query_blog_01);
  $totalRows_blog_01 = mysql_num_rows($all_blog_01);
}
$totalPages_blog_01 = ceil($totalRows_blog_01/$maxRows_blog_01)-1;
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
            <li class="active"><a href="blog.php">Blog</a></li>
            <li><a href="contact.php">Contact</a></li>
          
          
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
    	<li><a href="#">Blogs</a></li>
      </ol> 
      <h1 class="blue_font text-center">Blog posts</h1>
   
    
    
        <?php do { ?>
       <div class="col-md-12 pad40">
       
       		<div class="box2">
            
            
            	<h3 class="orange_font"><?php echo $row_blog_01['blog_heading']; ?></h3>
                <p>Date: <?php echo $row_blog_01['time_stamp']; ?> &nbsp;&nbsp; Posted By: <?php echo $row_blog_01['author']; ?></p>
                <p>
                <img src="images/<?php echo $row_blog_01['image_name']; ?>.jpg" class="img-responsive pull-left" style="padding-right:20px; padding-bottom:20px;">
                <?php echo $row_blog_01['blog_text']; ?> 
                </p>
                <a href="blog_full.php?sl_no=<?php echo $row_blog_01['sl_no']; ?>" class="more-btn5">Read more</a>
            </div><!--box2 -->
       
       </div><!--col-md-12 -->
       <?php } while ($row_blog_01 = mysql_fetch_assoc($blog_01)); ?>
       
    
      </div></div>
      
        
<div class="bg_pattern pad40" >	
    <div class="container-fluid bg_blue pad60">
    
    
     <div class="col-sm-12"><h2 class="white_font text-center">Post Your Blog Here</h2></div>
            <div class="col-sm-1"></div>
            <div class="col-sm-9">
      
            <form class="form-horizontal pad40" method="post" name="form1" action="<?php echo $editFormAction; ?>">
                 <div class="form-group">     
                     <label class="control-label col-sm-3 white_font myfont1">Topic Heading</label>
                     <div class="col-sm-9">
                        <input type="text" name="blog_heading" placeholder="Blog header goes here" class="form-control input-lg">        
                    </div>
                </div>
                
                 <div class="form-group">     
                     <label class="control-label col-sm-3 white_font myfont1">Image Name</label>
                     <div class="col-sm-9">
                        <input type="text" name="image_name" placeholder="Enter image name" class="form-control input-lg">        
                    </div>
                </div>
                        
                <div class="form-group">
                    <label class="control-label col-sm-3 white_font myfont1">Blog Text</label>
                    <div class="col-sm-9">
                        <textarea name="blog_text" cols="50" class="form-control" rows="12" placeholder="Blog text goes here"></textarea>
                    </div>
                </div> 
                <input type="submit" value="Post now" class="more-btn3 pull-right">
                <input type="hidden" name="author" value="<?php echo ($_SESSION['MM_Username']) ?>">
                <input type="hidden" name="MM_insert" value="form1">
            </form>
   
           </div><!--col-md-9 -->
     
            <div class="col-sm-2"></div>
  </div><!--container-fluid --> 
</div>
               
  
       
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
mysql_free_result($blog_01);
?>
