<?php
$lib_root = $this->config->base_url() . "libraries/assets/";
$img_link_style = 'float:left;width:25px;height:25px';
$ices_base_url = $this->config->base_url() . 'ices/';
$company = ICES_Engine::$company['val'];
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
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
        <title>Support Admin</title>
        <!-- BOOTSTRAP CORE STYLE CSS -->
        <link href="<?php echo $lib_root ?>css/bootstrap.css" rel="stylesheet" />
        <!-- FONT AWESOME CSS -->
        <link href="<?php echo $lib_root ?>css/font-awesome.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLE CSS -->
        <link href="<?php echo $lib_root ?>css/style.css" rel="stylesheet" />
        <!-- Google	Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Nova+Flat' rel='stylesheet' type='text/css' />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <script>
            $('#myModal').on('shown.bs.modal', function () {
                $('#myInput').focus()
            });

            $('#myModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var recipient = button.data('media-heading') // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('New message to ' + recipient);
            });
        </script>
    </head>
    <body>
        <div id="head">
            <div class="container">
                <div class="row">

                    <div class="col-md-4 col-sm-4">
                        <h4><span>Call:</span> +01-4589-987-567</h4>
                    </div>

                </div>
            </div>
        </div>
        <section style="padding:100px 0px 0px 0px;" >
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 ">
                        <div class="alert alert-info">
                            <div class="media">
                                <div class="pull-left">
                                    <img src="<?php echo $lib_root ?>img/admin.png" class="img-responsive" />
                                </div>
                                <div class="media-body">
                                    <h3 class="media-heading">Admin Login</h3>
                                    <p>
                                        Aenean faucibus luctus enim. Duis quis sem risu suspend lacinia elementum nunc. 
                                        Aenean faucibus luctus enim. 
                                    </p>
                                    <div class="bs-example bs-example-padded-bottom"> 
                                        <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#myModal"> Login</button> 
                                    </div>
                                    <!--<a href="index-admin.html" class="btn btn-primary" target="_blank" >Login</a>-->
                                </div>
                            </div>                   
                        </div>
                        <div class="alert alert-danger">
                            <div class="media">
                                <div class="pull-left">
                                    <img src="<?php echo $lib_root ?>img/admin.png" class="img-responsive" />
                                </div>
                                <div class="media-body">
                                    <h3 class="media-heading">Accounting Login</h3>
                                    <p>
                                        Aenean faucibus luctus enim. Duis quis sem risu suspend lacinia elementum nunc. 
                                        Aenean faucibus luctus enim. 
                                    </p>
                                    <a href="index-user.html" class="btn btn-danger " target="_blank">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 ">
                        <div class="alert alert-warning">
                            <div class="media">
                                <div class="pull-right">
                                    <img src="<?php echo $lib_root ?>img/admin.png" class="img-responsive" />
                                </div>
                                <div class="media-body">
                                    <h3 class="media-heading">Cashier Login</h3>
                                    <p>
                                        Aenean faucibus luctus enim. Duis quis sem risu suspend lacinia elementum nunc. 
                                        Aenean faucibus luctus enim. 
                                    </p>
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
                                    <p>
                                        Aenean faucibus luctus enim. Duis quis sem risu suspend lacinia elementum nunc. 
                                        Aenean faucibus luctus enim. 
                                    </p>
                                    <a href="index-user.html" class="btn btn-danger " target="_blank">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none; overflow: hidden;"> 
                    <div class="modal-dialog " role="document"> 
                        <div class="modal-content"> 
                            <div class="modal-header"> 
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button> 
                                <h4 class="modal-title" id="myModalLabel">Login</h4> 
                            </div> 
                            <div class="modal-body"> 
                                <form>
                                    <label for="inputEmail3" class="col-sm-3 control-label">Username</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user fa-1x"></i></div>
                                        <input type="text" class="form-control" id="exampleInputAmount" >
                                    </div>
                                    <div class="form-group"></div>
                                    <label for="inputPassword3" class="col-sm-3 control-label">Password</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-key fa-1x"></i></div>
                                        <input type="password" class="form-control" id="exampleInputAmount" >
                                    </div>
                                </form>
                            </div> 
                            <div class="modal-footer"> 
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Login</button> 
                            </div> 
                        </div> 
                    </div> 
                </div>

            </div>

        </section>

        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none; overflow: hidden;"> 
            <div class="modal-dialog " role="document"> 
                <div class="modal-content"> 
                    <div class="modal-header"> 
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button> 
                        <h4 class="modal-title" id="myModalLabel">Login</h4> 
                    </div> 
                    <div class="modal-body"> 
                        <form>
                            <label for="inputEmail3" class="col-sm-3 control-label">Username</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user fa-1x"></i></div>
                                <input type="text" class="form-control" id="exampleInputAmount" >
                            </div>
                            <div class="form-group"></div>
                            <label for="inputPassword3" class="col-sm-3 control-label">Password</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-key fa-1x"></i></div>
                                <input type="password" class="form-control" id="exampleInputAmount" >
                            </div>
                        </form>
                    </div> 
                    <div class="modal-footer"> 
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Login</button> 
                    </div> 
                </div> 
            </div> 
        </div>



        <!--  Jquery Core Script -->
        <script src="<?php echo $lib_root ?>js/jquery-1.10.2.js"></script>
        <!--  Core Bootstrap Script -->
        <script src="<?php echo $lib_root ?>js/bootstrap.js"></script>

    </body>
</html>
