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
            <li class="active"><a href="about.php">About</a></li>
            <li><a href="blog.php">Blog</a></li>
            <li><a href="contact.php">Contact</a></li>
          
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
    	<li><a href="#">About</a></li>
      </ol> 
      <h1 class="blue_font text-center">About us</h1>
   
    
    
       <div class="col-md-12 pad10">
       
       		<div class="box2">
            
            <div class="row">
            	    <div class="col-md-1"></div><!--col-md-1 -->
                    <div class="col-md-3">
                    <h3 class="orange_font">About Our Begining</h3>
                    <img src="images/about_03.jpg" class="img-responsive">
                    </div><!--col-md-3 -->
                  <div class="col-md-8 about_text1">
                    <p>The original board of trustees laid the groundwork for what would become today's Wisdom College on July 9, 1876, when the group gathered to hold the Wisdom College's inaugural board meeting and drafted the establishment's articles of incorporation. This guiding document outlined elements the founders believed would build an enduring legacy for the College: a commitment to offering a rigorous academic program and an ambition to provide "opportunities for all departments of higher education to persons of both sexes on equal terms." On September 10, 1876, the State of California issued the College's official certificate of incorporation, marking the formal beginning of the College's life.</p>
                   <p>An initial pledge of Rs. 600,000 from oil magnate James Williams, along with contributions by the Indian  Education Society, helped to found the College. The land of the College was donated by Marshall Field, owner of the historic Cochin department store that bore his name.</p>
                  </div><!--col-md-8 -->
                   </div><!--row --> 
                    
                   <br><br>
                    <div class="row">
            	    
                   
                  <div class="col-md-8 about_text2">
                    <p>With a commitment to free and open inquiry, our scholars take an interdisciplinary approach to research that spans arts to IT education. Their work transforms the way we understand the world, advancing and creating fields of study. Our scholars lead the country in scientific and technological innovations, often in partnership with our affiliated laboratories: Argonne National Laboratory, Fermi National Accelerator Laboratory, and the Marine Biological Laboratory in Noida, Delhi.</p>
                   <p>At Wisdom, we view college as a time for students to explore, exercise curiosity, and discover new interests and abilities. We provide students with an immersive, collaborative, and inspiring environment where they can develop a broadly informed, highly disciplined intellect that will help them be successful in whatever work they finally choose. Our students graduate with the values and knowledge they need to pursue meaningful work, find passion in life-long learning, and lead successful and purposeful lives.</p>
                 
                  </div><!--col-md-8 -->
                    <div class="col-md-3">
                    <h3 class="orange_font">What Are We Now</h3>
                    <img src="images/about_07.jpg" class="img-responsive">
                    </div><!--col-md-3 -->
                   
                   <div class="col-md-1"></div><!--col-md-1 -->
                   </div><!--row --> 
                    
                    
                    
       		<div class="clearfix"></div>
            </div><!--box2 -->
       
       </div><!--col-md-12 -->
       
    </div><!--row -->
    
    
    
     
    <div class="row">
    
    
       <div class="col-md-12 pad40">
       
       		<div class="box2">
            
            <div class="row">
            <h2 class="text-center black_font">Our Principles</h2>
             <div class="col-md-4 pad20">
             	<h3 class="orange_font text-center">Mission</h3>
                <div class="about_box1"><img src="images/mission.jpg" width="100%" class="img-responsive">
                <h5 class="pad20both">
                We believe teaching is a responsibility; a responsibility to build a student’s future by  giving him/her professional preparation and guidance to go on the right path in achieving their goal.
                </h5>
             	 </div><!--about_box1 -->
            </div><!--col-md-4 -->
                
            <div class="col-md-4 pad20">
                    <h3 class="orange_font text-center">Vision</h3>
                    <div class="about_box1"><img src="images/vision.jpg" width="100%" class="img-responsive">
                    <h5 class="pad20both">
                    We strive for being a model of excellence for solving complex educational problems through innovative and participatory teaching, scholarship, and community engagement.
                    </h5>
                     </div><!--about_box1 -->
            </div><!--col-md-4 -->
                 
            <div class="col-md-4 pad20">
             	<h3 class="orange_font text-center">Values</h3>
                <div class="about_box1"><img src="images/values.jpg" width="100%" class="img-responsive">
                <h5 class="pad20both">
                We are dedicated to helping students achieve their goals using our flexible programs tailored to suit individual needs and help enhancing the learning through group activities.
                </h5>
             	 </div><!--about_box1 -->
            </div><!--col-md-4 -->
            </div><!--row -->	    
            </div><!--box2 -->
       </div><!--col-md-12 -->
       
       
    </div><!--row -->
    
  </div><!--container-fluid -->
  				
 <div class="bg_pattern pad40">
    <div class="container-fluid bg_blue pad60">
      <h2 align="center" class="white_font">Team Behind Our Website</h2>
      
       <div class="container-fluid"><br>
       
            <div class="col-md-4 pad40">
            	<div class="col-xs-4 aboutteam">
                	<img src="images/jeemon.jpg" class="pull-right">
                </div>
            	<div class="col-xs-8"><div class="row"><br>
                    <h4 class="white_font pad10">Jeemon Puthusseri</h4>
                    <p class="gray_font">Layout & UI Designer</p>
                </div></div>
                <div class="clearfix"></div>
			</div><!--col-md-4 -->
            
       
            <div class="col-md-4 pad40">
            	<div class="col-xs-4 aboutteam">
                	<img src="images/suraj.jpg" class="pull-right">
                </div>
            	<div class="col-xs-8"><div class="row"><br>
                    <h4 class="white_font pad10">Suraj KV</h4>
                    <p class="gray_font">Web Designer</p>
                </div></div>
                <div class="clearfix"></div>
			</div><!--col-md-4 -->
       
            <div class="col-md-4 pad40">
            	<div class="col-xs-4 aboutteam">
                	<img src="images/bijin.jpg" class="pull-right">
                </div>
            	<div class="col-xs-8"><div class="row"><br>
                    <h4 class="white_font pad10">Bijin Kumar P</h4>
                    <p class="gray_font">Web Designer</p>
                </div></div>
                <div class="clearfix"></div>
			</div><!--col-md-4 -->
            
     </div><!--containerfluid -->            
                
                
      
       <div class="container-fluid"><br>
       
            <div class="col-md-4 pad40">
            	<div class="col-xs-4 aboutteam">
                	<img src="images/vipin.jpg" class="pull-right">
                </div>
            	<div class="col-xs-8"><div class="row"><br>
                    <h4 class="white_font pad10">Vipin Kumar PV</h4>
                    <p class="gray_font">Front-End Developer</p>
                </div></div>
                <div class="clearfix"></div>
			</div><!--col-md-4 -->
       
            <div class="col-md-4 pad40">
            	<div class="col-xs-4 aboutteam">
                	<img src="images/shamseer.jpg" class="pull-right">
                </div>
            	<div class="col-xs-8"><div class="row"><br>
                    <h4 class="white_font pad10">Shamseer CH</h4>
                    <p class="gray_font">Web Developer</p>
                </div></div>
                <div class="clearfix"></div>
			</div><!--col-md-4 -->
       
            <div class="col-md-4 pad40">
            	<div class="col-xs-4 aboutteam">
                	<img src="images/prilna.jpg" class="pull-right">
                </div>
            	<div class="col-xs-8"><div class="row"><br>
                    <h4 class="white_font pad10">Prilna PV</h4>
                    <p class="gray_font">Web Developer</p>
                </div></div>
                <div class="clearfix"></div>
			</div><!--col-md-4 -->
            
     </div><!--containerfluid -->          
           
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
mysql_free_result($blog_search);
?>
