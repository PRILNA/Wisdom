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

$maxRows_wisdom_notification = 1;
$pageNum_wisdom_notification = 0;
if (isset($_GET['pageNum_wisdom_notification'])) {
  $pageNum_wisdom_notification = $_GET['pageNum_wisdom_notification'];
}
$startRow_wisdom_notification = $pageNum_wisdom_notification * $maxRows_wisdom_notification;

mysql_select_db($database_wisdom, $wisdom);
$query_wisdom_notification = "SELECT * FROM notifications ORDER BY sl_no DESC";
$query_limit_wisdom_notification = sprintf("%s LIMIT %d, %d", $query_wisdom_notification, $startRow_wisdom_notification, $maxRows_wisdom_notification);
$wisdom_notification = mysql_query($query_limit_wisdom_notification, $wisdom) or die(mysql_error());
$row_wisdom_notification = mysql_fetch_assoc($wisdom_notification);

if (isset($_GET['totalRows_wisdom_notification'])) {
  $totalRows_wisdom_notification = $_GET['totalRows_wisdom_notification'];
} else {
  $all_wisdom_notification = mysql_query($query_wisdom_notification);
  $totalRows_wisdom_notification = mysql_num_rows($all_wisdom_notification);
}
$totalPages_wisdom_notification = ceil($totalRows_wisdom_notification/$maxRows_wisdom_notification)-1;

$maxRows_wisdom_event = 1;
$pageNum_wisdom_event = 0;
if (isset($_GET['pageNum_wisdom_event'])) {
  $pageNum_wisdom_event = $_GET['pageNum_wisdom_event'];
}
$startRow_wisdom_event = $pageNum_wisdom_event * $maxRows_wisdom_event;

mysql_select_db($database_wisdom, $wisdom);
$query_wisdom_event = "SELECT * FROM event ORDER BY sl_no DESC";
$query_limit_wisdom_event = sprintf("%s LIMIT %d, %d", $query_wisdom_event, $startRow_wisdom_event, $maxRows_wisdom_event);
$wisdom_event = mysql_query($query_limit_wisdom_event, $wisdom) or die(mysql_error());
$row_wisdom_event = mysql_fetch_assoc($wisdom_event);

if (isset($_GET['totalRows_wisdom_event'])) {
  $totalRows_wisdom_event = $_GET['totalRows_wisdom_event'];
} else {
  $all_wisdom_event = mysql_query($query_wisdom_event);
  $totalRows_wisdom_event = mysql_num_rows($all_wisdom_event);
}
$totalPages_wisdom_event = ceil($totalRows_wisdom_event/$maxRows_wisdom_event)-1;

$maxRows_wisdom_news = 1;
$pageNum_wisdom_news = 0;
if (isset($_GET['pageNum_wisdom_news'])) {
  $pageNum_wisdom_news = $_GET['pageNum_wisdom_news'];
}
$startRow_wisdom_news = $pageNum_wisdom_news * $maxRows_wisdom_news;

mysql_select_db($database_wisdom, $wisdom);
$query_wisdom_news = "SELECT * FROM news ORDER BY sl_no DESC";
$query_limit_wisdom_news = sprintf("%s LIMIT %d, %d", $query_wisdom_news, $startRow_wisdom_news, $maxRows_wisdom_news);
$wisdom_news = mysql_query($query_limit_wisdom_news, $wisdom) or die(mysql_error());
$row_wisdom_news = mysql_fetch_assoc($wisdom_news);

if (isset($_GET['totalRows_wisdom_news'])) {
  $totalRows_wisdom_news = $_GET['totalRows_wisdom_news'];
} else {
  $all_wisdom_news = mysql_query($query_wisdom_news);
  $totalRows_wisdom_news = mysql_num_rows($all_wisdom_news);
}
$totalPages_wisdom_news = ceil($totalRows_wisdom_news/$maxRows_wisdom_news)-1;

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
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username1'])) {
  $loginUsername=$_POST['username1'];
  $password=$_POST['pwd1'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "login.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_wisdom, $wisdom);
  
  $LoginRS__query=sprintf("SELECT Username, Password FROM `user` WHERE Username=%s AND Password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $wisdom) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
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
            	<a href="<?php echo $logoutAction ?>" class="pull-right">&nbsp;
            	<div class="clearfix"></div>
            <?php } else { ?>
            	<a href="login.php" class="pull-right">&nbsp;</a>
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
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
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
    
    
    </div><!--container-fluid -->
    
    <div class="container-fluid bg_blue">
      	<div class="col-md-7">  
    		<img src="images/index_02.jpg" class="img-responsive"/>
    	</div>
         <div class="col-md-5">
        
        <div class="row">
        
        
        
       	  <div class="col-md-2"></div>
       	  <div class="col-md-8 login_form_padding">
      		
            <h1 class="white_font">Login</h1>
            
            <form ACTION="<?php echo $loginFormAction; ?>" METHOD="POST" name="login_form1">
            	<input type="text" placeholder="Username" class="form-control margin20" required name="username1" />
                <input type="password" placeholder="Password" class="form-control margin20" required name="pwd1" />
                <button type="submit" class="btn more-btn3" name="btn_submit" >Login</button>
          	 	 	
            </form>
          </div><!--col-md-8 -->
          <div class="col-md-2"></div> 
        </div>  <!--row -->   
        </div><!--col-md-5 -->
    </div><!--containerfluid -->
    
    <div class="container-fluid bg_light_blue pad60">
      <div class="col-md-5">
        <img src="images/teacher_02.jpg" class="img-responsive" />
      
      </div><!--col-md-5 -->
      <div class="col-md-7  pad20">
        <h2 class="black_font">Welcome!</h2>
         <p>
        	The value of good education cannot be underestimated. From the childhood and up to the adult age each of us tries to discover something new, have deeper knowledge of various subjects and simply learn the world better. You will get your future job and climb the career ladder depending on the knowledge that you get at school, college, university, etc. 
        </p>
        <p>
        	Are you a fast learner? How quickly can you solve different tasks and find the right solution of a problem? These are only some of the factors that determine your professional success.
        </p>
        <p>
        	But more than all that we believe a good teacher can change everything, from inspiring students to learn better, to raising their standards of learning. That's why we assure the more you learn with us, the more you would love to learn!
        </p>
      
      </div><!--col-md-7 -->
    </div><!--container-fluid -->
    
    <div class="container-fluid bg_pattern">
    <div class="row">
    
     <div class="col-md-4 pad40">
        <img src="images/boxtop.png" class="img-responsive boxtopimg" />
          <div class="box1">
            
             
               
                
            
<h2 class="orange_font box-header">Notifications</h2>
              
               <?php do { ?>
               <h4 class="blue_font"><?php echo $row_wisdom_notification['heading']; ?></h4>
               <p><?php echo $row_wisdom_notification['text']; ?></p>
        <br />
        <p>Date: <?php echo $row_wisdom_notification['time_stamp']; ?></p>
        <?php } while ($row_wisdom_notification = mysql_fetch_assoc($wisdom_notification)); ?>
        <div class="row"> 
            <div class="col-md-4">     
            	<input type="button" value="More.." class="more-btn"/> 
            </div><!--col-md-4 -->
        </div> <!--row --> 
      </div><!--box1 -->
     
     </div><!--col-md-4 -->
     
    
     <div class="col-md-4 pad40">
         <img src="images/boxtop.png" class="img-responsive boxtopimg"/>
          <div class="box1">
            
              
               
                
           
<h2 class="orange_font box-header">Upcoming Event</h2>
			  <?php do { ?>
              <h4 class="blue_font"><?php echo $row_wisdom_event['heading']; ?></h4>
               <p><?php echo $row_wisdom_event['text']; ?></p>
 
                <br />
                <p>Date: <?php echo $row_wisdom_event['time_stamp']; ?></p>
                <?php } while ($row_wisdom_event = mysql_fetch_assoc($wisdom_event)); ?>
                <div class="row"> 
                    <div class="col-md-4">     
                    	<input type="button" value="More.." class="more-btn"/> 
                    </div><!--col-md-4 -->
                </div> <!--row -->  
       </div><!--box1 -->  
     </div><!--col-md-4 -->
     
     
     <div class="col-md-4 pad40">
        <img src="images/boxtop.png" class="img-responsive boxtopimg" />
          <div class="box1">
           
             
              
<h2 class="orange_font box-header">Campus News</h2>
			  <?php do { ?>
              <h4 class="blue_font"><?php echo $row_wisdom_news['heading']; ?></h4>
               <p><?php echo $row_wisdom_news['text']; ?></p><br />
             <p>Date: <?php echo $row_wisdom_news['time_stamp']; ?></p>
             <?php } while ($row_wisdom_news = mysql_fetch_assoc($wisdom_news)); ?>
              <div class="row"> 
               <div class="col-md-4">     
                <input type="button" value="More.." class="more-btn"/> 
               </div><!--col-md-4 -->
              </div> <!--row -->    
          </div><!--box1 -->
     </div><!--col-md-4 -->
     
    </div><!--row -->
    
    
     
    <div class="row">
       <div class="col-md-12 pad40">
       
       		<div class="box2">
            
              <h2 class="text-center black_font">Our Campus Specialities</h2>
              <h5 class="feature_text ">
              	Our institution has an exemplary, long-standing record of accomplishments in focused education. In order to keep up with the growing demands of technology, research and teaching, we are completing initiatives designed to maintain our building and facilities in a state-of-the-art condition. Through the generosity of our alumni and with the support of our directors, we continue to provide optimal care and the best education to our students and train them to be highly-skilled, knowledgeable, technically competent professionals.
                </h5>
              <div class="row">
                
                <div class="col-md-12">
                
                    <div class="col-md-4"><br />
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div align="center"><i class="fa fa-graduation-cap orange_font text-center fa-5x" aria-hidden="true"></i></div>
                            <br />
                            <h4 class="blue_font">Well Qualified Teachers</h4>
                            <p>
                            Professional development is essential for every teacher who wants to be one step ahead. We believe teaching is inspiring students to ask questions and giving them right directions while learning.
                            </p>
                             </div><!--col-md-10 --> 
                           <div class="col-md-1"></div>
                       	</div><!--col-md-4 --> 
                       
                       <div class="col-md-4"><br />
                       	<div class="col-md-1"></div>
                       	<div class="col-md-10">
                           <div align="center"><i class="fa fa-laptop orange_font text-center fa-5x" aria-hidden="true"></i></div>
                           <br />
                           <h4 class="blue_font">Fully Equipped Lab</h4>
                            <p>
                            Our lab is a fine blend of modern technology and high level erganomics. Along with highy experienced staffs, we are sure that the learning experience of our students will sky rocket.
                            </p>
                        </div><!--col-md-10 --> 
                       	<div class="col-md-1"></div>
                   	</div><!--col-md-4 --> 
                   
                   <div class="col-md-4"><br />
                       <div class="col-md-1"></div>
                       <div class="col-md-10">
                        <div align="center"><i class="fa fa-newspaper-o orange_font text-center fa-5x" aria-hidden="true"></i></div>
                        <br />
                        <h4 class="blue_font">Resource Rich Library</h4>
                          
                        <p>
                        Our library has been designed to provide students with expert level resources. With a range of new e-learning spaces and video sessions we have everything students need to learn effectively.
                        </p>
                         </div><!--col-md-10 --> 
                       
                       <div class="col-md-1"></div>
                   </div><!--col-md-4 --> 
                   
                   	</div><!--col-md-12 -->
                </div> <!--row -->
                
                <div class="row">
                   <div class="col-md-2"></div>
                   <div class="col-md-8"><hr /></div>
                   <div class="col-md-2"></div> <br />
                </div><!--row -->   
                
                
                <div class="row">
                   <h2 class="pad20 text-center black_font">Our Courses</h2>
               		<h5 class="feature_text ">
                    Our vision to be the 'highly qualified professional education center' is exemplified by our nationally reputed quality. We offer 3 professional degrees now, in addition to the short-term courses based on individual requirement. All our courses are recognized by The Government of India.
                    </h5>
                  
                   <div class="col-md-1"></div>
                   <div class="col-md-10">
                      <div class="col-md-4"><h4 class="blue_font"><a href="courses.php#course1"><i class="fa fa-book orange_font" aria-hidden="true"></i>  Ethical Hacking</a></h4></div>
                      <div class="col-md-4"><h4 class="blue_font"><a href="courses.php#course2"><i class="fa fa-book orange_font" aria-hidden="true"></i>  Undercover Journalism</a></h4></div>
                      <div class="col-md-4"><h4 class="blue_font"><a href="courses.php#course3"><i class="fa fa-book orange_font" aria-hidden="true"></i>  Meditation and NLP</a></h4></div>
                   </div>
                   <div class="col-md-1"></div> <br />
                 </div><!--row -->
                 
                 <div class="row">
                   <div class="col-md-12 pad40" align="center">     
             		<a href="courses.php" class="more-btn2">Know more..</a> 
                   </div>
                  </div><!--row -->
                  
            </div><!--box2 -->
       
       </div><!--col-md-12 -->
    </div><!--row -->
    
  </div><!--container-fluid -->
       

       
  <div class="bg_pattern pad40">
    <div class="container-fluid bg_orange pad40">
     <h2 align="center" class="white_font">Recent Photos</h2>
     
      <div class="row">
     
       <!--start-->
    <div style="padding:80px 0;">
        <div id="thumbnail-slider">
            <div class="inner">
                <ul>
                    <li>
                        <a class="thumb" href="images/1.jpg"></a>
                    </li>
                    <li>
                        <a class="thumb" href="images/22.jpg"></a>
                    </li>
                    <li>
                        <a class="thumb" href="images/33.jpg"></a>
                    </li>
                    <li>
                        <a class="thumb" href="images/44.jpg"></a>
                    </li>
                    <li>
                        <a class="thumb" href="images/55.jpg"></a>
                    </li>
                    <li>
                        <a class="thumb" href="images/66.jpg"></a>
                    </li>
                    <li>
                        <a class="thumb" href="images/77.jpg"></a>
                    </li>
                    <li>
                        <a class="thumb" href="images/88.jpg"></a>
                    </li>
                    <li>
                        <a class="thumb" href="images/99.jpg"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--end-->
     
     
     </div>
     
     
     
    </div><!--container-fluid --><br>
    
    
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
mysql_free_result($wisdom_notification);

mysql_free_result($wisdom_event);

mysql_free_result($wisdom_news);

mysql_free_result($blog_search);
?>
