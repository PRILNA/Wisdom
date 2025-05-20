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
 
   
    
    <div class="container-fluid bg_pattern">
    <div class="row">
     
     <ol class="breadcrumb text-center orange_font" >
     	<li><a href="index.php">Home</a></li>
    	<li><a href="#">Courses</a></li>
      </ol> 
      <h1 class="blue_font text-center">Courses</h1>
   
    
    
       <div class="col-md-12 pad10" id="course1">
       
       		<div class="box2">
              <div class="row">
            	<h3 class="orange_font">Ethical Hacking</h3>
              <div class="row">
             <div class="col-md-8"> 
             <img src="images/ethical.jpg" class="img-responsive text-center"><br> 
               <p>
                A Certified Ethical Hacker is a skilled professional who understands and knows how to look for weaknesses and vulnerabilities in target systems and uses the same knowledge and tools as a malicious hacker, but in a lawful and legitimate manner to assess the security posture of a target system(s). The CEH credential certifies individuals in the specific network security discipline of Ethical Hacking from a vendor-neutral perspective.
               </p>
               <p>      
                    The Certified Ethical Hacker program is the pinnacle of the most desired information security training program any information security professional will ever want to be in. To master the hacking technologies, you will need to become one, but an ethical one! The accredited course provides the advanced hacking tools and techniques used by hackers and information security professionals alike to break into an organization.
              </p>
              <p>      
                   This course will immerse you into the Hacker Mindset so that you will be able to defend against future attacks. The security mindset in any organization must not be limited to the silos of a certain vendor, technologies or pieces of equipment.

This ethical hacking course puts you in the driver’s seat of a hands-on environment with a systematic process. Here, you will be exposed to an entirely different way of achieving optimal information security posture in their organization; by hacking it! You will scan, test, hack and secure your own systems. You will be taught the five phases of ethical hacking and the ways to approach your target and succeed at breaking in every time! The five phases include Reconnaissance, Gaining Access, Enumeration, Maintaining Access, and covering your tracks.
              </p> 
              </div><!--col-md-8 -->
              <div class="col-md-4">
                 <div class="bg_blue course_details_box">
                   <div class="row">
                   <div class="col-xs-12 pad20">
                     <div class="col-xs-12">
                         <p class="white_font">Course name</p>
                         <hr>
                     </div><!--col-xs-12 -->
                     <div class="col-xs-12">
                         <h4 class=" pull-right white_font">Ethical Hacking</h4>
                     </div><!--col-xs-12 -->
                     
                     <div class="col-xs-12  margin20">
                         <p class="white_font">Duration</p>
                         <hr>
                     </div><!--col-xs-12 -->
                     <div class="col-xs-12">
                         <h4 class=" pull-right white_font">2 Years</h4>
                     </div><!--col-xs-12 -->
                     
                     <div class="col-xs-12 margin20">
                         <p class="white_font">Elilibility</p>
                         <hr>
                     </div><!--col-xs-12 -->
                     <div class="col-xs-12">
                         <h4 class=" pull-right white_font">Plus Two</h4>
                     </div><!--col-xs-12 -->
                     
                     <div class="col-xs-12  margin20">
                         <p class="white_font ">Age limit</p>
                         <hr>
                     </div><!--col-xs-12 -->
                     <div class="col-xs-12">
                         <h4 class=" pull-right white_font">45 Years</h4>
                     </div><!--col-xs-12 -->
                     
                     <div class="col-xs-12  margin20">
                         <p class="white_font">Course fee*</p>
                         <hr>
                     </div><!--col-xs-12 -->
                     <div class="col-xs-12">
                         <h4 class=" pull-right white_font">Rs. 35000/-</h4>
                     </div><!--col-xs-12 -->
                     
                     <div class="col-xs-12 margin20">
                         <p>*Includes taxes</p>
                        
                     </div><!--col-xs-12 -->
                     
                     
                  
                   
                      </div><!--col-xs-12 -->
                    </div><!--row -->
                 </div><!--bg_blue -->
              </div><!--col-md-4 -->
              </div><!--row -->
               <br>
              <div class="bg_orange course_contact_pad">
               <div class="row">
                <div class="col-md-8">
                <h3 class="white_font pad20both">Interested to know more or join our course?</h3>
                </div><!--col-md-8 -->
                <div class="col-md-4 pad40 text-center">
                <a href="contact.php" class="more-btn4">Contact us</a>
              </div><!--col-md-4 -->
              </div><!--row -->
              </div><!--bg_orange -->
              </div><!--row -->
            </div><!--box2 -->
                
       </div><!--col-md-12 -->   
        
    
       <div class="col-md-12 pad40" id="course2">
       
       		<div class="box2">
              <div class="row">
            	<h3 class="orange_font">Undercover Jornalism</h3>
              <div class="row">
             <div class="col-md-8"> 
             <img src="images/undercover.jpg" class="img-responsive text-center"><br> 
               <p>
                While journalism aims to seek and report the truth, the techniques of how the truth is revealed should always be kept a secret. If undercover journalism is an active lie to get the truth, then eventually trust can possibly be broken between reporters and the public. According to the Columbia Journalism Review, "Overreliance on sting operations and subterfuge can weaken the public's trust in the media and compromise journalists' claim to be truth-tellers. Undercover reporting can be a powerful tool, but it's one to be used cautiously: against only the most important targets, and even then only when accompanied by solid traditional reporting." Undercover journalism exposes a lot of truths that would otherwise stay under the radar. In the 1990s, ABC Primetime Live went undercover to investigate rumors of Food Lion's unsanitary practices. According to the Society of Professional Journalists’ Code of Ethics, "journalists should avoid undercover or other surreptitious methods of gathering information unless traditional, open methods will not yield information vital to the public.” Undercover journalism should be used scarcely and if it is used, then it should be done if there are no other options to get the information. It also should be accompanied by useful, interesting, and relevant information for the public.
               </p>
               <p>      
                    The Certified Undercover Jornalism program is the most desired journalism training program any media person will ever want to be in. The accredited course provides the advanced techniques used by undercover jornalists and media persons alike to break into an organization. This course will immerse you into the spirit of journalism and will create mindset to work in any organization.
              </p> 
              </div><!--col-md-8 -->
              <div class="col-md-4">
                 <div class="bg_blue course_details_box">
                   <div class="row">
                   <div class="col-xs-12 pad20">
                     <div class="col-xs-12">
                         <p class="white_font">Course name</p>
                         <hr>
                     </div><!--col-xs-12 -->
                     <div class="col-xs-12">
                         <h4 class=" pull-right white_font">Undercover Jornalism</h4>
                     </div><!--col-xs-12 -->
                     
                     <div class="col-xs-12  margin20">
                         <p class="white_font">Duration</p>
                         <hr>
                     </div><!--col-xs-12 -->
                     <div class="col-xs-12">
                         <h4 class=" pull-right white_font">3 Years</h4>
                     </div><!--col-xs-12 -->
                     
                     <div class="col-xs-12 margin20">
                         <p class="white_font">Elilibility</p>
                         <hr>
                     </div><!--col-xs-12 -->
                     <div class="col-xs-12">
                         <h4 class=" pull-right white_font">Degree</h4>
                     </div><!--col-xs-12 -->
                     
                     <div class="col-xs-12  margin20">
                         <p class="white_font ">Age limit</p>
                         <hr>
                     </div><!--col-xs-12 -->
                     <div class="col-xs-12">
                         <h4 class=" pull-right white_font">35 Years</h4>
                     </div><!--col-xs-12 -->
                     
                     <div class="col-xs-12  margin20">
                         <p class="white_font">Course fee*</p>
                         <hr>
                     </div><!--col-xs-12 -->
                     <div class="col-xs-12">
                         <h4 class=" pull-right white_font">Rs. 25000/-</h4>
                     </div><!--col-xs-12 -->
                     
                     <div class="col-xs-12 margin20">
                         <p>*Includes taxes</p>
                        
                     </div><!--col-xs-12 -->
                   
                      </div><!--col-xs-12 -->
                    </div><!--row -->
                 </div><!--bg_blue -->
              </div><!--col-md-4 -->
              </div><!--row -->
               <br>
              <div class="bg_orange course_contact_pad">
               <div class="row">
                <div class="col-md-8">
                <h3 class="white_font pad20both">Interested to know more or join our course?</h3>
                </div><!--col-md-8 -->
                <div class="col-md-4 pad40 text-center">
                <a href="contact.php" class="more-btn4">Contact us</a>
              </div><!--col-md-4 -->
              </div><!--row -->
              </div><!--bg_orange -->
              </div><!--row -->
            </div><!--box2 -->
                
       </div><!--col-md-12 -->
       
       
       
       <div class="col-md-12 pad40" id="course3">
       
       		<div class="box2">
              <div class="row">
            	<h3 class="orange_font">Meditation & NLP</h3>
              <div class="row">
             <div class="col-md-8"> 
             <img src="images/meditation.jpg" class="img-responsive text-center"><br> 
               <p>
                Meditation is a way of giving your brain a rest. There are many different reasons for people to want to learn to meditate. However, nowadays the most overriding motive is the need to be more relaxed. Meditation practice gives you the shortcut to being a more relaxed person. Sometimes people tell me that they have tried meditation, but they can't switch off. Meditation does not require you to have a 'switched of' mind. Often people have been trying to learn a meditation method which is unsuitable for the specific natural way that their brain operates..
               </p>
               <p>NLP (Neuro Linguistic Programming) is a type of practical applied psychology. Many other forms of personal and professional development systems tell you what it is you need to do, but not how you go about doing it. NLP is practical in its application and shows you how to achieve what you want - it gives you the tools.
              </p>
              <p>      
                   Our course combines both the topics and aims at developing your knowledge as well as the ability to successfully meditate at the same time. The course is driven by experts in meditation techniques and NLP scholars. This program wil help you achieve a quantum leap in your personal and spiritual development, whilst giving you the necessary tools to promote your professional skills, no matter what your present profession. The course is offered in user friendly in "easy to understand" way.
              </p> 
              </div><!--col-md-8 -->
              <div class="col-md-4">
                 <div class="bg_blue course_details_box">
                   <div class="row">
                   <div class="col-xs-12 pad20">
                     <div class="col-xs-12">
                         <p class="white_font">Course name</p>
                         <hr>
                     </div><!--col-xs-12 -->
                     <div class="col-xs-12">
                         <h4 class=" pull-right white_font">Meditation & NLP</h4>
                     </div><!--col-xs-12 -->
                     
                     <div class="col-xs-12  margin20">
                         <p class="white_font">Duration</p>
                         <hr>
                     </div><!--col-xs-12 -->
                     <div class="col-xs-12">
                         <h4 class=" pull-right white_font">1 Year</h4>
                     </div><!--col-xs-12 -->
                     
                     <div class="col-xs-12 margin20">
                         <p class="white_font">Elilibility</p>
                         <hr>
                     </div><!--col-xs-12 -->
                     <div class="col-xs-12">
                         <h4 class=" pull-right white_font">SSLC</h4>
                     </div><!--col-xs-12 -->
                     
                     <div class="col-xs-12  margin20">
                         <p class="white_font ">Age limit</p>
                         <hr>
                     </div><!--col-xs-12 -->
                     <div class="col-xs-12">
                         <h4 class=" pull-right white_font">60 Years</h4>
                     </div><!--col-xs-12 -->
                     
                     <div class="col-xs-12  margin20">
                         <p class="white_font">Course fee*</p>
                         <hr>
                     </div><!--col-xs-12 -->
                     <div class="col-xs-12">
                         <h4 class=" pull-right white_font">Rs. 15000/-</h4>
                     </div><!--col-xs-12 -->
                     
                     <div class="col-xs-12 margin20">
                         <p>*Includes taxes</p>
                        
                     </div><!--col-xs-12 -->
                     
                     
                  
                   
                      </div><!--col-xs-12 -->
                    </div><!--row -->
                 </div><!--bg_blue -->
              </div><!--col-md-4 -->
              </div><!--row -->
               <br>
              <div class="bg_orange course_contact_pad">
               <div class="row">
                <div class="col-md-8">
                <h3 class="white_font pad20both">Interested to know more or join our course?</h3>
                </div><!--col-md-8 -->
                <div class="col-md-4 pad40 text-center">
                <a href="contact.php" class="more-btn4">Contact us</a>
              </div><!--col-md-4 -->
              </div><!--row -->
              </div><!--bg_orange -->
              </div><!--row -->
            </div><!--box2 -->
       
       </div><!--col-md-12 -->    
       
       
       
       </div></div>
       

  
       
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
