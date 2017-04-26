<?php
require_once './protected/libs/controlador.php';// teste
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Locadora Veículos</title>
        
        <!-- Excluir Registro - Mensagem-->
        <link rel="shortcut icon" type="image/png" href="includes/imagens/veiculo.png"/>
        <link href="includes/css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="includes/css/datatables.min.css">
        <link rel="stylesheet" href="includes/css/redmond/jquery-ui-1.10.1.custom.css">
        <script src="includes/js/jquery-1.9.1.js" type="text/javascript"></script>
        <script src="includes/js/jquery-ui.js" type="text/javascript"></script>
        <script src="includes/js/jquery.maskMoney.js" type="text/javascript"></script>
        <script src="includes/js/jquery.maskedinput.min.js" type="text/javascript"></script>
        <script src="includes/js/validarcampos.js" type="text/javascript"></script>
        <script src="includes/js/vanilla-masker.min.js" type="text/javascript"></script>
 

        <!-- Excluir Registro - Mensagem-->
        <script src="includes/js/jquery-1.11.3.js"></script>
        <script src="includes/js/jquery-ui.js"></script>
        <link rel="stylesheet" href="includes/css/jquery-ui.css" type="text/css" />

        <!-- Chosen -->
        <script src="includes/js/plugins/chosen/chosen.jquery.js"></script>
        <!-- Chosen -->
        <link href="includes/css/plugins/chosen/chosen.css" rel="stylesheet">
        
        <script type="text/javascript">
            $(document).ready(function () {
            });

            function excluir(acao, controle, id) {

                $("#dialog").dialog({
                    autoOpen: false,
                    modal: true,
                    buttons: {
                        "Cancelar": function () {
                            $(this).dialog("close");
                        },
                        "Confirmar": function () {
                            window.location.href = 'painel.php?controle=' + controle + '&acao=' + acao + '&id=' + id;
                        }
                    }
                });
                $("#dialog").dialog("open");
            };
        </script>
        <script src="includes/js/jquery.easy-confirm-dialog.js"></script>
        <style type="text/css">
            .error{
                color: red;
                font-size: 12px;
            }
            hr {
                color: blue;
                background-color: blue;
                height: 1px;
            }
            .ui-dialog { font-size: 11px; }
            #question {
                width: 300px!important;
                height: 60px!important;
                padding: 10px 0 0 10px;
            }
            #question img {
                float: left;
            }
            #question span {
                float: left;
                margin: 20px 0 0 10px;
            }
            .ui-dialog 
            .ui-dialog-titlebar-close{
                background-image: url(includes/img/remove.png);
                background-color: white;
            }
            .ui-draggable 
            .ui-dialog-titlebar{
                background-color: #3D5B99;
            }
            .navbar-default 
            .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:focus, .navbar-default .navbar-nav>.open>a:hover{background-color: #428bca}
            #menutitle{
                color: white;
            }
            .ui-datepicker .ui-datepicker-header {
                position: relative;
                padding: .2em 0;
                background-color: #3D5B99;
            }
            div.ui-datepicker{
             font-size:14px;
            }
            body {
                padding-top: 85px;
            }

            /*AtlantaJeans theme added*/
            .panel-primary>.panel-heading {
              color: #fff;
              background-color: #3D5B99;
              border-color: #3D5B99;
            }
            .panel-primary{
              border-color: #3D5B99;
              margin-left: -25px;
              margin-right: -25px;
            }
            a {
                color: #3D5B99;
                text-decoration: none;
            }
            .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
                z-index: 2;
                color: #fff;
                cursor: default;
                background-color: #3D5B99;
                border-color: #f0dbe1;
            }
            .dataTables_wrapper .dataTables_paginate .paginate_button {
                box-sizing: border-box;
                display: inline-block;
                min-width: 1.5em;
                padding: 0.5em 1em;
                margin-left: 2px;
                text-align: center;
                text-decoration: none !important;
                cursor: pointer;
                color: #333 !important;
                border: 1px solid transparent;
                border-radius: 2px;
            }
            .btn-primary {
                color: #fff;
                background-color: #5b2436;
                border-color: #f0dbe1;
            }
            hr {
                color: #f0dbe1;
                background-color: #f0dbe1;
                height: 1px;
            }
            
            #box{
                    width: 100px; 
                    height: 35px;
                    border-radius: 10px;
            }

            /*Rodapé*/
            .footer {
                position:absolute;
                bottom:0;
                left: 0px;
                width:100%;
                height: 50px;
                background: #3D5B99
            }
        </style>
    </head>
</head>
<body style="padding-top: 55px;">
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #3D5B99">
        <div class="container" style="padding-left: 0px">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#" style=" padding-left: 25px;"  id="menutitle">Locadora Veículos</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="painel.php"  id="menutitle">Home</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"  id="menutitle" aria-expanded="false">Manutenções<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="painel.php?controle=gerenteController&acao=listar">Manutenção de Gerente</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="painel.php?controle=colaboradorController&acao=listar">Manutenção de Colaboradores</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="index.php?controle=rendaController&acao=listar">Manutenção de Clientes</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="index.php?controle=rendaController&acao=listar">Manutenção de Segurança</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"  id="menutitle" aria-expanded="false">Manutenção Geral<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="painel.php?controle=veiculoController&acao=listar">Manutenção de Veículo</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="painel.php?controle=setorController&acao=listar">Manutenção de Setor</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="painel.php?controle=cidadeController&acao=listar">Manutenção de Cidade</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"  id="menutitle" aria-expanded="false">Reservas<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="index.php?controle=clienteController&acao=listar">Reserva Cliente</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="index.php?controle=rendaController&acao=listar">Reserva Colaborador</a></li>
                        </ul>
                    </li>
                    <li><a href="/locadoraveiculos/controlelogin/sair.php"  id="menutitle">Sair</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    <div class="container">
        <?php
        $app = new Controlador();
        ?>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="includes/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="includes/js/jquery.dataTables.min.js"></script>
    <script src="includes/js/dataTables.bootstrap.min.js"></script>
    <!-- page script -->
    <script>
        $(function () {
            $("#example1").DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "oLanguage": {
                "sProcessing": "Aguarde enquanto os dados são carregados ...",
                "sLengthMenu": "Mostrar _MENU_ registros por pagina",
                "sZeroRecords": "Nenhum registro correspondente ao criterio encontrado",
                "sInfoEmtpy": "Exibindo 0 a 0 de 0 registros",
                "sInfo": "Exibindo de _START_ a _END_ de _TOTAL_ registros",
                "sInfoFiltered": "",
                "sSearch": "Pesquisar",
                "oPaginate": {
                   "sFirst":    "Primeiro",
                   "sPrevious": "Anterior",
                   "sNext":     "Próximo",
                   "sLast":     "Último"
                }  
              } 
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "oLanguage": {
                "sProcessing": "Aguarde enquanto os dados são carregados ...",
                "sLengthMenu": "Mostrar _MENU_ registros por pagina",
                "sZeroRecords": "Nenhum registro correspondente ao criterio encontrado",
                "sInfoEmtpy": "Exibindo 0 a 0 de 0 registros",
                "sInfo": "Exibindo de _START_ a _END_ de _TOTAL_ registros",
                "sInfoFiltered": "",
                "sSearch": "Pesquisar",
                "oPaginate": {
                   "sFirst":    "Primeiro",
                   "sPrevious": "Anterior",
                   "sNext":     "Próximo",
                   "sLast":     "Último"
                }  
              } 
            });
        });
    </script>
    <div style="display: none">
        <div id="dialog" title="Exclusão do Registro"/><img src="includes/imagens/question.png" alt="" /><span>Tem certeza que deseja excluir o registro?</span></div>
    </div>
</body>
</html>