<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> @yield('titulo','Inicio') | Escuela de Formación de Tecnólogos</title>
    <link rel="icon" type="image/png" href="/img/escudo_epn.png">

{{-- select2 --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

    <!-- Tell the browser to be responsive to screen width -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset("assets/$theme/plugins/fontawesome-free/css/all.min.css")}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("assets/$theme/dist/css/adminlte.min.css")}}">
    <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset("assets/$theme/plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins -->
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!--Load the AJAX API para GOOGLE CHARTS-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    @yield("styles")

    <link rel="stylesheet" href="{{asset("assets/css/estilo.css")}}">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!--Iconos-->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed" id="upPage">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Inicio Header -->
        @include("theme/$theme/header")
        <!-- Fin Header -->
        <!-- Inicio Aside -->
        @include("theme/$theme/aside")
        <!-- Fin Aside -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">

            </section>
            <section class="content">
                <div class="container-fluid">
                    @if (session()->has('flash-success'))
                        <div class="container">
                            <div class="alert alert-success alert-dismissible" data-auto-dismiss="3000">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><Strong>X</Strong></button>
                                {{ session('flash-success') }}
                            </div>
                        </div>
                    @endif
                    @if (session()->has('flash-danger'))
                        <div class="container">
                            <div class="alert alert-danger alert-dismissible" data-auto-dismiss="3000">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><Strong>X</Strong></button>
                                {{ session('flash-danger') }}
                            </div>
                        </div>
                    @endif
                    @yield('contenido')
                    @guest
                        @foreach ($inicio as $pagina)
                            
                        @endforeach
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div style="float: right;">
                                        <table style="height: 20px; width: 200px;">
                                            <tbody>
                                                <tr>
                                                    <td><a href="https://saew.epn.edu.ec/" target="_blank" title="SAEW" style="color: #778899;">
                                                        SAEW
                                                    </a>|<br /><br /></td>
                                                    <td><a href="mailto:{{$pagina->email ?? 'esfot@epn.edu.ec'}}" target="_blank" title="Correo Institucional" style="color: #778899;">
                                                        EMAIL
                                                    </a>|<br /><br /></td>
                                                    <td><a href="http://www.epn.edu.ec" target="_blank" title="Portal Web EPN" style="color: #778899;">
                                                        Portal Web
                                                    </a><br /><br /></td>
                                                </tr>
                                            </tbody>
                                        </table>		
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <img src="{{asset("/img/EPN_logo.png")}}" width="150" height="70" class="float-left d-none d-sm-block">
                                    <img src="{{asset("/img/logo_esfot_rectificado.png")}}"  width="150" height="70" class="float-left d-none d-sm-block">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner" style="border-radius: 20px;">
                                                    <div class="carousel-item active">
                                                        @if (isset($pagina->sliderImage1))
                                                            <img src="{{asset("storage").'/'.$pagina->sliderImage1}}" class="d-block w-100" alt="..."  width="600px" height="400px">
                                                        @else
                                                            <img src="{{asset("/img/esfotpanoramica.jpg")}}" class="d-block w-100" alt="..." width="600px" height="400px">
                                                        @endif
                                                    </div>
                                                    <div class="carousel-item">
                                                        @if (isset($pagina->sliderImage2))
                                                            <img src="{{asset("storage").'/'.$pagina->sliderImage2}}" class="d-block w-100" alt="..."  width="600px" height="400px">
                                                        @else
                                                            <img src="{{asset("/img/esfotpanoramica.jpg")}}"  class="d-block w-100" alt="..." width="600px" height="400px">
                                                        @endif
                                                    </div>
                                                    <div class="carousel-item">
                                                        @if (isset($pagina->sliderImage3))
                                                            <img src="{{asset("storage").'/'.$pagina->sliderImage3}}" class="d-block w-100" alt="..."  width="600px" height="400px">
                                                        @else
                                                            <img src="{{asset("/img/esfotpanoramica.jpg")}}"  class="d-block w-100" alt="..." width="600px" height="400px">
                                                        @endif
                                                    </div>
                                                </div>
                                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    
                                    <br>
                                    <hr>
                                    <h3 id="misionvision">Misi&oacute;n Visi&oacute;n</h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    
                                                    <div class="col-md-12">
                                                        <div class="card">
                                                            <div class="card-header" id="styFormAuth" style="text-align: center;"><strong>Misi&oacute;n</strong></div>
                                                            
                                                            <div class="card-body">
                                                                {{$pagina->mission ?? 'Visión'}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="col-md-12">
                                                        <div class="card">
                                                            <div class="card-header" id="styFormAuth" style="text-align: center;"><strong>Visi&oacute;n</strong></div>
                                                            
                                                            <div class="card-body">
                                                                {{$pagina->vision ?? 'Visión'}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <br>
                                    <h3 id="galeria">Galer&iacute;a</h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <section id="blog">
                                                <!--<h3>&Aacute;reas</h3>-->
                                                <div class="contenedorGaleria">
                                                    <article>
                                                        <div class="card img-box" style="width: 18rem;">
                                                            @if (isset($pagina->image1))
                                                                <img src="{{asset("storage").'/'.$pagina->image1}}"  class="img-thumbnail img-fluid card-img-top" style="width:auto;height:250px;" alt="logo">
                                                            @else
                                                                <img src="{{asset("/img/no_imagen.png")}}"  class="img-fluid" alt="logo" style="width:auto;height:250px;">
                                                            @endif
                                                        </div>
                                                    </article>
                                                    <article>
                                                        <div class="card img-box" style="width: 18rem;">
                                                            @if (isset($pagina->image2))
                                                                <img src="{{asset("storage").'/'.$pagina->image2}}"  class="img-thumbnail img-fluid card-img-top" style="width:auto;height:250px;" alt="logo">
                                                            @else
                                                                <img src="{{asset("/img/no_imagen.png")}}"  class="img-fluid" alt="logo" style="width:auto;height:250px;">
                                                            @endif
                                                        </div>
                                                    </article>
                                                    <article>
                                                        <div class="card img-box" style="width: 18rem;">
                                                            @if (isset($pagina->image3))
                                                                <img src="{{asset("storage").'/'.$pagina->image3}}"  class="img-thumbnail img-fluid card-img-top" style="width:auto;height:250px;" alt="logo">
                                                            @else
                                                                <img src="{{asset("/img/no_imagen.png")}}"  class="img-fluid" alt="logo" style="width:auto;height:250px;">
                                                            @endif
                                                        </div>
                                                    </article>
                                                    <article>
                                                        <div class="card img-box" style="width: 18rem;">
                                                            @if (isset($pagina->image4))
                                                                <img src="{{asset("storage").'/'.$pagina->image4}}"  class="img-thumbnail img-fluid card-img-top" style="width:auto;height:250px;" alt="logo">
                                                            @else
                                                                <img src="{{asset("/img/no_imagen.png")}}"  class="img-fluid" alt="logo" style="width:auto;height:250px;">
                                                            @endif
                                                        </div>
                                                    </article>
                                                    <article>
                                                        <div class="card img-box" style="width: 18rem;">
                                                            @if (isset($pagina->image5))
                                                                <img src="{{asset("storage").'/'.$pagina->image5}}"  class="img-thumbnail img-fluid card-img-top" style="width:auto;height:250px;" alt="logo">
                                                            @else
                                                                <img src="{{asset("/img/no_imagen.png")}}"  class="img-fluid" alt="logo" style="width:auto;height:250px;">
                                                            @endif
                                                        </div>
                                                    </article>
                                                    <article>
                                                        <div class="card img-box" style="width: 18rem;">
                                                            @if (isset($pagina->image6))
                                                                <img src="{{asset("storage").'/'.$pagina->image6}}"  class="img-thumbnail img-fluid card-img-top" style="width:auto;height:250px;" alt="logo">
                                                            @else
                                                                <img src="{{asset("/img/no_imagen.png")}}"  class="img-fluid" alt="logo" style="width:auto;height:250px;">
                                                            @endif
                                                        </div>
                                                    </article>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endguest
                </div>
            </section>
            @guest
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div style="float: right;">	
                                <a href="#upPage"><i class="fas fa-arrow-circle-up" style="padding: 5px; font-size:50px;"></i></a>	
                            </div>
                        </div>
                    </div>
                </div>
            @endguest
        </div>
        <h3 id="contactanos"></h3>
        <!--Inicio Footer -->
        @guest
            @include("includes/footer")
        @else
            @include("theme/$theme/footer")
        @endguest
        <!-- Fin Footer -->
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->	
    </div>

    {{-- CDN DE GOOGLE - JQUERY VERSION 2.2.4 --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    {{-- select2 --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script type="text/javascript">
        $("#nameid").select2({
                placeholder: "Buscar...",
                allowClear: true
            });

        $("#nameiddos").select2({
            placeholder: "Buscar ...",
            allowClear: true
        });
    </script>


    <script src="{{asset("assets/$theme/plugins/jquery/jquery.min.js")}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset("assets/$theme/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset("assets/$theme/dist/js/adminlte.min.js")}}"></script>
    <!-- AdminLTE for demo purposes -->

    <!-- overlayScrollbars -->
<script src="{{asset("assets/$theme/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}"></script>

    @yield("scriptsPlugins")

    <script src="{{asset("assets/js/jquery-validation/jquery.validate.min.js")}}"></script>
    <script src="{{asset("assets/js/jquery-validation/localization/messages_es.min.js")}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{asset("assets/js/scripts.js")}}"></script>
    <script src="{{asset("assets/js/funciones.js")}}"></script>
    
    @yield("scripts")

    <!--Script del número de caracteres permitidos en cada Input o TextArea-->
    <script src="{{asset('assets/maxLength/maxLength.js')}}"></script>
    
     <!--tooltips-->
     <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

    {{-- MAXIMO FECHA JS --}}
    <script>
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //se suma 1 ya que a enero se le representa con el 0!
        var yyyy = today.getFullYear();
        if(dd<10){
                dd='0'+dd
            } 
            if(mm<10){
                mm='0'+mm
            } 

        today = yyyy+'-'+mm+'-'+dd;
        document.getElementById("datefield").setAttribute("max", today);
    </script>
    {{-- PAGINACION FORMULARIO --}}
    <script>
        $(document).ready(function(){
        var current = 1,current_step,next_step,steps;
        steps = $("fieldset").length;
        $(".next").click(function(){
        current_step = $(this).parent();
        next_step = $(this).parent().next();
        next_step.show();
        current_step.hide();
        setProgressBar(++current);
        });
        $(".previous").click(function(){
        current_step = $(this).parent();
        next_step = $(this).parent().prev();
        next_step.show();
        current_step.hide();
        setProgressBar(--current);
        });
        setProgressBar(current);
        // Change progress bar action
        function setProgressBar(curStep){
        var percent = parseFloat(100 / steps) * curStep;
        percent = percent.toFixed();
        $(".progress-bar")
        .css("width",percent+"%")
        .html(percent+"%");
        }
        });
    </script>
</body>

</html>