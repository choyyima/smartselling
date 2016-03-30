<?php
$lib_root = $this->config->base_url() . "libraries/assets/";
$lib = $this->config->base_url() . "libraries/";
$img_link_style = 'float:left;width:25px;height:25px';
$ices_base_url = $this->config->base_url() . 'ices/';
$company = ICES_Engine::$company['val'];
?>
<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <!--[if IE]>
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <![endif]-->
        <title>Resto Admin</title>
        <!-- BOOTSTRAP CORE STYLE CSS -->
        <link rel="icon" href="<?php echo $lib_root ?>img/favicon-32x32.png">
        <link href="<?php echo $lib_root ?>css/bootstrap.css" rel="stylesheet" />
        <!-- FONT AWESOME CSS -->
        <link href="<?php echo $lib_root ?>css/font-awesome.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLE CSS -->
        <link href="<?php echo $lib_root ?>css/style.css" rel="stylesheet" />
        <!-- Google	Fonts -->
        <!--<link href="<?php echo $lib_root ?>css/style.css" rel='stylesheet' type='text/css' />-->
        <link href='<?php echo $lib_root ?>css/fonts.css' rel='stylesheet' type='text/css' />
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->        
    </head>
    <body>
        <div id="head">
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <h2><i class="fa fa-cutlery"></i> Sistem <span><i> Smart Selling</i></span>Restoran</h2>
                    </div>

                </div>
            </div>
        </div>
        <section style="padding:100px 0px 0px 0px;" >
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 ">
                        <div class="carousel-inner" role="listbox">
                                               
                        </div>
                        <div class="alert alert-danger">
                            <div class="media">
                                <div class="pull-left">
                                    <img src="<?php echo $lib_root ?>img/admin.png" class="img-responsive" />
                                </div>
                                <div class="media-body">
                                    <h3 class="media-heading">Accounting Login</h3>

                                    <a href="index-user.html" class="btn btn-danger " target="_blank">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
<!--
                    <div class="col-lg-6 ">
                        <div class="alert alert-warning">
                            <div class="media">
                                <div class="pull-right">
                                    <img src="<?php echo $lib_root ?>img/admin.png" class="img-responsive" />
                                </div>
                                <div class="media-body">
                                    <h3 class="media-heading">Cashier Login</h3>

                                    <a href="index-admin.html" class="btn btn-primary" target="_blank" >Login</a>
                                </div>
                            </div>                   
                        </div>
                        <div class="alert alert-success">
                            <div class="media">
                                <div class="pull-right">
                                    <img src="<?php echo $lib_root ?>img/admin.png" class="img-responsive" />
                                </div>
                                <div class="media-body">
                                    <h3 class="media-heading">Management Login</h3>
                                    <p></p>
                                    <a href="index-user.html" class="btn btn-danger " target="_blank">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>-->

                </div>
            </div>

        </section>

            <div class="modal fade" id="modal_sign_in" tabindex="" role="dialog" aria-hidden="false" style="display: none;overflow-y:auto">
                <div class="modal-dialog">
                    <div class="modal-content" style="">

                        <div class="modal-body" style="background-color:#6aa3c0;padding:1px;
                             border-top-left-radius: 4px;
                             border-top-right-radius: 4px;
                             border-bottom-right-radius: 4px;
                             border-bottom-left-radius: 4px;">
                            <div class="" id="login-box" style='margin:0 auto 0 auto'>
                                <div class="" style="border-top-left-radius: 4px;
                                     border-top-right-radius: 4px;
                                     border-bottom-right-radius: 0;
                                     border-bottom-left-radius: 0;

                                     background: #3d9970;
                                     box-shadow: inset 0px -3px 0px rgba(0, 0, 0, 0.2);
                                     padding: 20px 10px;
                                     text-align: center;
                                     font-size: 26px;
                                     font-weight: 300;
                                     color: #fff;
                                     background-color:#3c8dbc">
                                    SIGN IN
                                </div>
                                <form action="" method="post">
                                    <div class="" 
                                         style="padding: 10px 20px;
                                         background: #fff;
                                         color: #444;background-color: #eaeaec !important;">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-user fa-lg "></i>
                                                </span>
                                                <input type="text" name="username" class="form-control" placeholder="Username"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-key fa-lg"></i>
                                                </span>
                                                <input type="password" name="password" class="form-control" placeholder="Password"/>
                                            </div>
                                        </div>          
                                        <div class="form-group">
                                            <strong id="login_msg" style="color:#f56954 " 
                                                    class=""></strong>
                                        </div>
                                    </div>
                                    <div class="" style="border-top-left-radius: 0;
                                         border-top-right-radius: 0;
                                         border-bottom-right-radius: 4px;
                                         border-bottom-left-radius: 4px;padding: 10px 20px;
                                         background: #fff;
                                         color: #444;">                                                               
                                        <button type="submit" class="btn btn-primary btn-block" style="
                                                margin-bottom: 10px;background-color: #3c8dbc;
                                                border-color: #6aa3c0;">Let me in</button>  
                                    </div>
                                </form>            
                            </div>
                        </div>

                    </div>
                </div>
            </div>



        <!--  Jquery Core Script -->
        <script type="text/javascript" src="<?php echo $lib; ?>js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $lib; ?>js/jquery-ui.js"></script>
        <script type="text/javascript" src="<?php echo $lib; ?>js/jquery.actual.min.js"></script>
        <script src="<?php echo $lib ?>js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo $lib ?>js/ices/ices.js" type="text/javascript"></script>

    </body>
</html>
