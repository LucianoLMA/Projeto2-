<!DOCTYPE html>
<html>
    <head>
        <title>Locadora Veículos</title>
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
        <meta name="robots" content="all" />
        <!-- Mobile Meta -->
        <script src="includes/js/jquery-1.11.3.js"></script>
        <script src="includes/js/jquery-ui.js"></script>
        <link rel="shortcut icon" type="image/png" href="includes/imagens/veiculo.png"/>
        <link rel="stylesheet" href="includes/css/jquery-ui.css" type="text/css" />
        <link href="includes/css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="includes/css/datatables.min.css">

        <script src="includes/js/jquery-1.9.1.js" type="text/javascript"></script>
        <script src="includes/js/jquery-ui.js" type="text/javascript"></script>
        <script src="includes/js/jquery.maskMoney.js" type="text/javascript"></script>
        <script src="includes/js/jquery.maskedinput.min.js" type="text/javascript"></script>
        <script src="includes/js/validarcampos.js" type="text/javascript"></script>
        <script src="includes/js/jquery-1.11.3.js"></script>
        <script src="includes/js/jquery-ui.js"></script>
        <link rel="stylesheet" href="includes/css/jquery-ui.css" type="text/css" />
        <script src="includes/js/bootstrap.min.js"></script>
        <script src="includes/js/dataTables.bootstrap.min.js"></script>
        <script src="includes/js/validarcampos.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap core CSS -->
        <link href="includes/css/bootstrap.css" rel="stylesheet">
        <!-- Font Awesome CSS -->
        <link rel="stylesheet" href="includes/css/custom.css"/>
    </head>
    <body class="no-trans front-page">
        <div class="scrollToTop circle"><i class="icon-up-open-big"></i></div>
        <div class="page-wrapper">
            <div class="header-container">
                <div class="header-top dark ">
                    <div class="container">
                        <div class="row">

                        </div>
                    </div>
                </div>
                <header class="header   clearfix">

                    <div class="container">
                        <div class="row">

                            <div class="col-md-3">
                                <div class="">
                                    <div id="header-top-second"  class="clearfix">
                                        <div class="header-top-dropdown text-left">
                                            <div id="logo" class="logo">
                                                <img src="includes/css/images/logo.png" class="img-responsive " width="200" alt=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-9" style="padding-left: 20%">
                                <div class="header-left clearfix">
                                    <div class="main-navigation  animated with-dropdown-buttons">
                                        <nav class="navbar navbar-default" role="navigation">
                                            <div class="container-fluid">
                                                <form action="controlelogin/conectado.php" method="POST">
                                                    <table>
                                                        <tr>
                                                            <td><label style="color: white">CPF:&nbsp;</label></td>
                                                            <td><input type="text" class="form-control" id="cpf_atualizado" name="cpf" placeholder="Digite seu CPF" ></td>
                                                            <td><label style="color: white">&nbsp; &nbsp;Senha:&nbsp;</label></td>
                                                            <td><input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua Senha"></td>
                                                            <td>&nbsp; &nbsp;<button type="submit" class="btn btn-success">Entrar</button></button></td>
                                                        </tr>
                                                    </table>
                                                </form>
                                                <!-- Toggle get grouped for better mobile display -->
                                                <div class="navbar-header">
                                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                                                        <span class="sr-only">Toggle navigation</span>
                                                        <span class="icon-bar"></span>
                                                        <span class="icon-bar"></span>
                                                        <span class="icon-bar"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </nav>
                                    </div> 
                                </div>                      
                            </div>
                        </div>
                    </div>
                </header>
            </div>
            <div class="container">
                    <div class="row">
                        <img src="includes/imagens/cruze.jpg" style="width: 1245px; height: 460px"/>
                    </div>
            </div>
            <footer id="footer">
                <div class="subfooter">
                    <div class="container">
                        <div class="subfooter-inner">
                            <div class="row">
                                <div class="col-md-12 wpn-copyright">
                                    <p class="text-center white">® 2017 Locadora Veículos - Direitos reservados</p>
                                </div>
                                <div class="col-md-12">
                                    <p class="text-center white">Desenvolvimento <b>Luciano Machado</b> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
    </body>
</html>