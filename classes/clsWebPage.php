<?php

use Afsar\lib;

class WebPage {

    public $Title;
    public $SubTitle;
    public $ShowHdr;
    public $ShowFtr;
    public $ShowNavbar;
    public $ShowSidebar1;
    public $ShowSidebar2;
    public $ShowSidebar3;

    public $hdr_scripts = [];
    public $hdr_styles  = [];
    public $ftr_scripts = [];
    public $ftr_styles  = [];

    private $pgCallBack;
    private $jsDocReady;
    private $LoremIpsum;

    // constructor
    public function __construct() {
        
        $this->Title        = "";
        $this->SubTitle     = "";
        $this->ShowHdr      = true;
        $this->ShowFtr      = true;
        $this->ShowSidebar1 = true;
        $this->ShowSidebar2 = true;
        $this->ShowSidebar3 = true;
        
        $this->LoremIpsum   = file_get_contents("lorem_ipsum.html");
 
    }

    public function RenderPage($pgCallBackFunction = "", $jsDocReadyFunction = "")  {
 
        try {
            $this->pgCallBack = $pgCallBackFunction;
            $this->jsDocReady = $jsDocReadyFunction;
            $this->html_header();
            $this->SiteLayout1();
            //$this->SiteLayout2();
            $this->html_footer();
        }
        catch (\Throwable $e) {
            echo "
                <p>Oops!</p>
                <p>error</p>
                <p>".$e->getMessage()."</p>
            ";
       }

    }


    private function SiteLayout1() {

        ?>

        <body class="d-flex flex-column min-vh-100">
      
        <?php
        $this->do_nav_bar();
        ?>

            <!-- container -->
            <main role="main" class="container starter-template">
        
                <?php
                $this->ContentLayout();
                ?>

                <!-- widgets -->
                <div id="sidebar" class="right widget_sidebar">
                    <h4>App Widgets</h4>
                    <div>Widget 1</div>
                    <div>Widget 2</div>
                    <div>Widget 3</div>
                    <div>Widget etc</div>
                </div>    

            </main>
     

        <!-- /container -->
        <footer class="mt-auto">    
            &copy; 2021 - Sample API Application
        </footer>

        </body>

        <?php
        
    }


    private function SiteLayout2() {

    ?>
    
        <body>      


            <div class="wrapper d-flex align-items-stretch">
                <nav id="sidebar">
                    <div class="custom-menu">
                        <button type="button" id="sidebarCollapse" class="btn btn-primary">
                            <i class="fa fa-bars"></i>
                            <span class="sr-only">Toggle Menu</span>
                        </button>
                    </div>

                    <div class="p-4">
                        <h1><a href="index.html" class="logo">Portfolic <span>Portfolio Agency</span></a></h1>
                        <ul class="list-unstyled components mb-5">
                            <li class="active"><a href="index.php"><span class="fa fa-home mr-3"></span> Home</a></li>
                            <li><a href="pg_userlist.php"><span class="fa fa-user mr-3"></span> User List</a></li>
                            <li><a href="frm_sample.php"><span class="fa fa-briefcase mr-3"></span> Sample Form</a></li>
                            <li><a href="frm_register.php"><span class="fa fa-sticky-note mr-3"></span> Register</a></li>
                            <li><a href="pg_login.php"><span class="fa fa-suitcase mr-3"></span> Login</a></li>
                            <li><a href="#"><span class="fa fa-cogs mr-3"></span> Logout</a></li>
                            <li><a href="#"><span class="fa fa-paper-plane mr-3"></span> Contacts</a></li>
                        </ul>

                        <div class="mb-5">
                            <h3 class="h6 mb-3">Subscribe for newsletter</h3>
                            <form action="#" class="subscribe-form">
                                <div class="form-group d-flex">
                                    <div class="icon"><span class="icon-paper-plane"></span></div>
                                    <input type="text" class="form-control" placeholder="Enter Email Address">
                                </div>
                            </form>
                        </div>

                        <div class="footer">
                            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                            </div>

                    </div>
                </nav>

            <!-- Page Content  -->
            <div id="content" class="p-4 p-md-5 pt-5">
            <h1 class="mb-4">h1</h1>
            <h2>Sidebar #05</h2>
                <?php
                $this->ContentLayout();
                ?>
            </div>
            </div>

        <script src="js3rdparty/main.js"></script>

    </body>

    
        
    <?php
    
    }
    private function ContentLayout() {

        $this->PageHeader();
    ?>

        <div class="row">         
    
            <!-- where prompt / messages will appear -->
            <div id="response"></div>
    
            <!-- where main content will appear -->
            <div id="content">
                <?php
                if ($this->pgCallBack == "") {
                    echo $this->LoremIpsum;
                }
                else {
                    call_user_func($this->pgCallBack);      // this is the call back function should reside in the file that includes this page class
                }
                ?>                  
            </div>    
    
        </div>

        <div class="col">              
        
            <?php 
            if (C_DEBUG) { 
                ?> 
                <h5>Debug Information</h5>
                <h6>api url:</h6><div id="api_url"></div>
                <h6>api post data</h6><div id="api_post"></div>    
                <h6>cookie token</h6><div id="cookie_token" class="debug"></div>
                <h6>api response</h6><div id="api_response" class="debug"></div>
                <?php 
            }  ?>
            <?=$this->widgetUserInfo();?>
        </div>

       <?php

    }
        

    private function widgetUserInfo() {

        global $cfg;

        if ($cfg->UserInfo["id"]!=0) {
            $content =  $cfg->UserInfo["firstname"].' '.$cfg->UserInfo["lastname"];
            $content = $content.'  (<a href="pg_logout">Logout</a>)'; 
        } else {
            $content = '<a href="pg_login.php">Login</a>';
        }
        
        $html = '
                    <hr/>
                    <b>'.$content.'</b>         
            ';
        
    return $html;

    }

    private function PageHeader() {

        ?>

        <div class="page-header">
        <h1><?=$this->Title;?>
                 <small><?=$this->SubTitle;?></small>
        </h1> 
        </div>
        
        <?php

    }

    private function html_header() {

        ?>

        <!doctype html>
        <html lang="en">
            <head>
                <!-- Required meta tags -->
                <meta charset="utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
                <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
                
                <title><?php echo $this->Title ?></title>
        
                
                <!-- tabulator served from the CDN -->
                <link href="https://unpkg.com/tabulator-tables@4.9.3/dist/css/tabulator.min.css" rel="stylesheet">
                <script type="text/javascript" src="https://unpkg.com/tabulator-tables@4.9.3/dist/js/tabulator.min.js"></script>
                <!-- end of tabulator includes -->
                         
                <!-- CSS only -->
                <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900">
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
                <link  rel="stylesheet"href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        

                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>        

                <!-- http://labs.creative-area.net/jquery.datagrid/ -->
                <script src="https://cdn.jsdelivr.net/npm/jquery.datagrid@0.2.3/jquery.datagrid.min.js"></script>


                <!--link rel="stylesheet" href="css3rdparty/style.css"-->

                <link rel="stylesheet" type="text/css" href="css/custom.css" />      
 
                <script src="js/custom.js"></script>
                <script src="js/utils.js"></script>
                      
                <?php 
                // https://github.com/ambersnow/bs-jsonform
            	?>
                <script type="text/javascript" src="js/bs-jsonformV2.js"></script>

                <?php
                    
                    foreach ($this->hdr_scripts as $js) {
                        echo '<script type="text/javascript" src="'.$js.'"></script>';
                    }

                    foreach ($this->hdr_styles as $css) {
                        echo '<link rel="stylesheet" type="text/css" href="'.$js.'" />';
                    }

                ?>



            </head>
        <?php

    }

    private function do_nav_bar() {

        ?>

        <!-- navbar -->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="index.php";>Single Page App</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="index.php">Home</a>
                    <a class="nav-item nav-link" href="pg_userlist.php">User List</a>
                    <a class="nav-item nav-link" href="frm_sample.php">Sample Form</a>
                    <a class="nav-item nav-link" href="pg_register.php">Register</a>
                    <a class="nav-item nav-link" href="pg_login.php">Login</a>
                    <a class="nav-item nav-link" href="pg_login.php">Logout</a>
                </div>
            </div>
        </nav>
        <!-- /navbar -->

        <?php
    }


    private function html_footer() {
                
        foreach ($this->ftr_scripts as $js) {
            echo '<script type="text/javascript" src="'.$js.'"></script>';
        }

        foreach ($this->ftr_styles as $css) {
            echo '<link rel="stylesheet" type="text/css" href="'.$js.'" />';
        }
            
        $this->RenderJsDocReady();

       echo "
       </html>
       ";

    }


    private function RenderJsDocReady() {

        ?>

        <script>

        // A $( document ).ready() block.
        $( document ).ready(function() {
            $("#cookie_token").html(getCookie("jwt_token"));        
            <?php
            if ($this->jsDocReady!="") { 
                echo $this->jsDocReady."();";
            }
            ?>            
        });
    
        </script>

        <?php
    }

}  // end of class AppPage
