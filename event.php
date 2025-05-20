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

		<style>
        .orange_box{
			border:2px solid #ff812a;
			padding:20px;
			}
		.table2>tbody>tr>td, .table2>tbody>tr>th, .table2>tfoot>tr>td, .table2>tfoot>tr>th, .table2>thead>tr>td, .table2>thead>tr>th {
			vertical-align: top;
		}
        
        
        
        </style>




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
    	<li><a href="#">Event</a></li>
      </ol> 
      <h1 class="blue_font text-center">Event</h1>
   
    
    
       <div class="col-md-12 pad10">
       
       		<div class="box2">
            	
                <div class="orange_box">
                <div class="row">
                <div class="col-md-4">
                 <img src="images/index_08.jpg" width="100%" class="img-responsive">
                </div><!--col-md-4 -->
               
                <div class="col-md-8">
                <h3 class="orange_font">Principal's Message</h3>
                 <p>purus malesuada finibus. Nulla eu dolor 
                    eleifend, interdum mi vel, ultrices purus. 
                    Sed tristique consequat ultrices. 
                    Donec porta ipsum turpis, eget malesuada 
                    est pharetra non. Proin ipsum eros, finibus 
                    at nisl et, dignissim consectetur orci.Lorem ipsum dolor sit amet, consectetur 
                    adipiscing elit. Etiam ultricies ligula a 
                    purus malesuada finibus.purus malesuada finibus. Nulla eu dolor 
                    eleifend, interdum mi vel, ultrices purus. 
                    Sed tristique consequat ultrices. 
                    </p>
                    <p>purus malesuada finibus. Nulla eu dolor 
                    eleifend, interdum mi vel, ultrices purus. 
                    Sed tristique consequat ultrices. 
                    Donec porta ipsum turpis, eget malesuada 
                    est pharetra non. Proin ipsum eros, finibus 
                    at nisl et, dignissim consectetur orci.Lorem ipsum dolor sit amet, consectetur 
                    adipiscing elit. Etiam ultricies ligula a 
                    purus malesuada finibus.purus malesuada finibus. Nulla eu dolor 
                    eleifend, interdum mi vel, ultrices purus. 
                    Sed tristique consequat ultrices. 
                    </p>
                 </div><!--col-md-8 -->
                </div><!--row -->
                
              </div><!--orange_box -->
            
            
            <div class="row pad40">
             <div class="col-xs-12">
              <table class="table table2 table-responsive table-hover">
              <tr>
                <td style="min-width:100px"><h5 class="blue_font">Heading</h5></td>
                <td style="min-width:100px"><h5>01/01/2017</h5></td>
                <td><p>
                    Donec porta ipsum turpis, eget malesuada 
                    est pharetra non. Proin ipsum eros, finibus 
                    at nisl et, dignissim consectetur orci.Lorem ipsum dolor sit amet, consectetur 
                    adipiscing elit. Etiam ultricies ligula a 
                    purus malesuada finibus.
                    </p>
               </td>
              </tr>
              
              <tr>
                <td style="min-width:100px"><h5 class="blue_font">Heading</h5></td>
                <td style="min-width:100px"><h5>01/01/2017</h5></td>
                <td><p>
                    Donec porta ipsum turpis, eget malesuada 
                    est pharetra non. Proin ipsum eros, finibus 
                    at nisl et, dignissim consectetur orci.Lorem ipsum dolor sit amet, consectetur 
                    adipiscing elit. Etiam ultricies ligula a 
                    purus malesuada finibus.
                    </p>
               </td>
              </tr>
              
              <tr>
                <td style="min-width:100px"><h5 class="blue_font">Heading</h5></td>
                <td style="min-width:100px"><h5>01/01/2017</h5></td>
                <td><p>
                    Donec porta ipsum turpis, eget malesuada 
                    est pharetra non. Proin ipsum eros, finibus 
                    at nisl et, dignissim consectetur orci.Lorem ipsum dolor sit amet, consectetur 
                    adipiscing elit. Etiam ultricies ligula a 
                    purus malesuada finibus.
                    </p>
               </td>
              </tr>
              
              <tr>
                <td style="min-width:100px"><h5 class="blue_font">Heading</h5></td>
                <td style="min-width:100px"><h5>01/01/2017</h5></td>
                <td><p>
                    Donec porta ipsum turpis, eget malesuada 
                    est pharetra non. Proin ipsum eros, finibus 
                    at nisl et, dignissim consectetur orci.Lorem ipsum dolor sit amet, consectetur 
                    adipiscing elit. Etiam ultricies ligula a 
                    purus malesuada finibus.
                    </p>
               </td>
              </tr>
              
              <tr>
                <td style="min-width:100px"><h5 class="blue_font">Heading</h5></td>
                <td style="min-width:100px"><h5>01/01/2017</h5></td>
                <td><p>
                    Donec porta ipsum turpis, eget malesuada 
                    est pharetra non. Proin ipsum eros, finibus 
                    at nisl et, dignissim consectetur orci.Lorem ipsum dolor sit amet, consectetur 
                    adipiscing elit. Etiam ultricies ligula a 
                    purus malesuada finibus.
                    </p>
               </td>
              </tr>
              
              
              <tr>
                <td style="min-width:100px"><h5 class="blue_font">Heading</h5></td>
                <td style="min-width:100px"><h5>01/01/2017</h5></td>
                <td><p>
                    Donec porta ipsum turpis, eget malesuada 
                    est pharetra non. Proin ipsum eros, finibus 
                    at nisl et, dignissim consectetur orci.Lorem ipsum dolor sit amet, consectetur 
                    adipiscing elit. Etiam ultricies ligula a 
                    purus malesuada finibus.
                    </p>
               </td>
              </tr>
              
              
              <tr>
                <td style="min-width:100px"><h5 class="blue_font">Heading</h5></td>
                <td style="min-width:100px"><h5>01/01/2017</h5></td>
                <td><p>
                    Donec porta ipsum turpis, eget malesuada 
                    est pharetra non. Proin ipsum eros, finibus 
                    at nisl et, dignissim consectetur orci.Lorem ipsum dolor sit amet, consectetur 
                    adipiscing elit. Etiam ultricies ligula a 
                    purus malesuada finibus.
                    </p>
               </td>
              </tr>
              
              
            </table>


            
            
            
            </div><!--col-xs-12 -->
           
           </div><!--row --> 
            
            
            </div><!--box2 -->
       
       </div><!--col-md-12 -->
       
    
    
    
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