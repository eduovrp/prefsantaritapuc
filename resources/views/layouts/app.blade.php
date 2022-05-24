<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="eduovrp">
		<meta name="description"
		content="A cidade foi fundada em 22 de maio de 1952 e transformada em distrito em 30 de dezembro de 1953,
		em território do município de Santa Fé do Sul. Desenvolveu-se e obteve sua autonomia político-administrativa
		em 28 de fevereiro de 1964, quando foi elevada a município.">

		<meta name="robots" content="noodp">

		<meta property="og:locale" content="pt_BR">
		<meta property="og:type" content="article">
		<meta property="og:title" content="Prefeitura Municipal de Santa Rita d'Oeste - SP">
		<meta property="og:description" content="Portal de Notícias e Informações oficiais da Prefeitura Municipal.">
		<meta property="og:url" content="http://www.santaritadoeste.sp.gov.br">
		<meta property="og:site_name" content="Prefeitura Municipal de Santa Rita d'Oeste - SP">
		<meta property="og:image" content="http://www.santaritadoeste.sp.gov.br/images/brasaosr.png"/>
		<meta property="article:publisher" content="https://www.facebook.com/PrefeituraSantaRita/">
		<meta property="article:author" content="https://www.facebook.com/eduovrp">

		<title>Prefeitura Municipal de Santa Rita d'Oeste - SP</title>

		<!-- CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/magnific-popup.css') }}" rel="stylesheet">
        <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
        <link href="{{ asset('css/slick.css') }}" rel="stylesheet">
        <link href="{{ asset('css/jplayer.css') }}" rel="stylesheet">
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">
        <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
        <link href="{{ asset('css/background.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font/font-fileuploader.css') }}" rel="stylesheet">
        <link href="{{ asset('css/jquery.fileuploader.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/jquery.fancybox.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/bootstrap-tagsinput.css') }}" rel="stylesheet">
        <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/summernote.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/switchery.min.css') }}" rel="stylesheet">



		<script src="https://kit.fontawesome.com/02c1f06a40.js" crossorigin="anonymous"></script>

		<!-- fonts -->
		<link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,500,600,700,800%7CRoboto:100,300,400,500,700,900%7CSignika+Negative:300,400,600,700" rel="stylesheet">

	    <!-- icons -->
	    <link rel="icon" href="{{ asset('images/brasaosr.png') }}">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
 	<body>
	  	<div class="main-wrapper tr-page-top homepage">
		  	<div class="container-fluid">
		  		<div class="row">

                    <!-- Header -->
                    <div class="col-sm-3 tr-sidebar tr-sticky">
						<div class="theiaStickySidebar">
							<div class="tr-menu sidebar-menu">
								<nav class="navbar navbar-default">
									<div class="navbar-header">
										<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
										<span class="sr-only">MENU</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										</button>
                                        <a class="navbar-brand" href="{{url ('/')}}">
                                            <img class="img-responsive" src="{{ asset('images/brasaosr.png') }}" alt="Brasão de Santa Rita d'Oeste">
                                        </a>
									</div><!-- /navbar-header -->

									<div class="collapse navbar-collapse" id="navbar-collapse">
										<span class="discover">MENU</span>
										<ul class="nav navbar-nav">

                                            <li>
                                                <a href="{{url ('/')}}"><i class="fa fa-home" aria-hidden="true"></i>Início</a>
                                            </li>
                                            <li>
                                                <a href="{{url ('/posts')}}"><i class="fa fa-newspaper-o" aria-hidden="true"></i>Notícias</a>
                                            </li>
                                            <li class="dropdown">
                                                <a class="pointer"><i class="fa fa-map-signs" aria-hidden="true"></i>Turismo</a>
                                                <ul class="sub-menu">
                                                    <li>
                                                        <a href="atracoes-turisticas">Atrações Turísticas </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{url ('/festivities')}}">Calendário de Eventos</a>
                                                    </li>
                                                    <li>
                                                        <a href="conheca-santarita">Conheça Santa Rita d'Oeste</a>
                                                    </li>
                                                </ul>
                                            </li>

                                            @foreach(App\Models\fileCategory::menu() as $menu)
                                                <li class="dropdown">
                                                    <a class="pointer"><i class="{{$menu->iconMenu}}" aria-hidden="true"></i>{{$menu->name}}</a>
                                                    <ul class="sub-menu">
                                                        @foreach($menu->fileSubCategories as $submenu)
                                                        <li>
                                                            <a href="{{
                                                                route('years',
                                                                ['fileCategory' => $menu->href,
                                                                 'fileSubCategory' => $submenu->href
                                                                ])
                                                            }}

                                                                ">{{$submenu->name}}</a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach

                                    <li><a href="{{route ('contact.index') }}"><i class="fa fa-phone" aria-hidden="true"></i>Fale Conosco</a></li>
                                    </ul>
										</ul>
									</div>
								</nav><!-- /navbar -->
							</div><!-- /left-memu -->
						</div><!-- /.theiaStickySidebar -->
					</div>



					<div class="col-sm-9">
						<div class="tr-topbar clearfix">
							<div class="topbar-left">
			                    <div class="breaking-news">
			                        <span># Ultimas Notícias</span>
			                        <div id="ticker">
			                            <ul>
                                            @foreach(App\Models\Post::posts() as $post)
                                                <li>
                                                    <a href="{{route('post.show', ['post'=> $post->id])}}">{{ $post->title }}</a>
                                                </li>
                                            @endforeach
										</ul>
			                   	 	</div>
			                	</div><!-- breaking-news -->
							</div><!-- /.topbar-left -->
							<div class="topbar-right">
								<div class="user">
									<div class="user-image">
                                        <img class="img-responsive img-circle"
                                        src="@if(Auth::check())
                                                {{asset(Auth::user()->avatar_url)}}
                                            @else
                                                {{asset('images/others/ninja.png')}}
                                            @endif
                                        " alt="Image">
									</div>
									<div class="dropdown user-dropdown">
                                        Olá,
                                        @if(Auth::check())
										<a href="#" aria-expanded="true">{{ Auth::user()->name }}<i class="fa fa-caret-down" aria-hidden="true"></i></a>
										<ul class="sub-menu text-left">

                                            @if(Auth::user()->nivelAcesso == "Admin")
                                                <li><a href="{{route('manageFileCategories.index')}}">Gerenciar Categorias de Arquivo</a></li>
                                                <li><a href="{{route('manageFiles.index')}}">Gerenciar Arquivos</a></li>
                                                <li><a href="{{route('managePosts.index')}}">Gerenciar Notícias</a></li>
                                                <li><a href="{{route('manageCards.index')}}">Gerenciar Cartões</a></li>
                                                <li><a href="{{route('manageFestivities.index')}}">Gerenciar Festividades</a></li>
                                                <li><a href="{{route('manageUsers.list')}}">Gerenciar Usuários</a></li>
                                                <li><a href="{{route('contact.list')}}">Ouvidoria</a></li>
                                            @elseif(Auth::user()->nivelAcesso == "User")
                                                <li><a href="{{ route('auth.updateAccount', ['id' => Auth::user()->id]) }}">Atualizar Cadastro</a></li>
                                            @endif
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <li>
                                                <a href="{{ route('logout') }}"
                                                                    onclick="event.preventDefault();
                                                                                this.closest('form').submit();">
                                                    {{ __('Sair') }}
                                                </a>
                                            </li>
                                        </form>
                                        @else
                                        <a href="#" aria-expanded="true">Visitante<i class="fa fa-caret-down" aria-hidden="true"></i></a>
										<ul class="sub-menu text-left">
                                            <li><a href="{{route('register')}}">Registre-se</a></li>
											<li><a href="{{route('login')}}">Entrar</a></li>
                                        @endif
										</ul>
									</div>
								</div>
								<div class="searchNlogin">
									<ul>
										<li class="search-icon"><i class="fa fa-search"></i></li>

									</ul>
									<div class="search">
										<form action="search" method="get">
											<input type="text" name="pesquisa" class="search-form" autocomplete="off" minlength="3" placeholder="Digite & pressione Enter">
										</form>
									</div> <!--/.search-->
								</div>
							</div><!-- /.topbar-right -->
						</div><!-- /.tr-topbar -->



                            @yield('content')

                        </div>
                    </div><!-- /.container-fulid -->
                </div><!-- /.main-wrapper -->

                        <footer id="footer">
                                    <div class="footer-menu">
                                        <div class="container">
                                            <ul class="nav navbar-nav">
                                                <li><a href="{{url ('/')}}">Inicio</a></li>
                                                <li><a href="posts">Notícias</a></li>
                                                <li><a href="cidade#map">Como Chegar</a></li>
                                                <li><a href="{{route ('contact.index') }}">Ouvidoria</a></li>
                                                <li><a href="registrar">Registre-se</a></li>
                                                <li><a href="https://portal.office.com/" target="_blank">Webmail</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="footer-bottom text-center">
                                        <div class="container">
                                            <div class="footer-bottom-content">
                                                <div class="footer-logo">
                                                    <a href="{{url ('/')}}"><img class="img-responsive" src="{{asset('images/logosr.png')}}" width="275px" height="179px" alt="Logo Administração"></a>
                                                </div>
                                                <p>A cidade foi fundada em 22 de maio de 1952 e transformada em distrito em 30 de dezembro de 1953, em território do município de Santa Fé do Sul. Desenvolveu-se e obteve sua autonomia político-administrativa em 28 de fevereiro de 1964, quando foi elevada a município.</p>
                                                <address>
                                                    <p>&copy; 2020 <a href="{{url ('/')}}">Santa Rita d'Oeste - SP</a>. Email: <a href="#">tecnologia@santaritadoeste.sp.gov.br</a></p>
                                                </address>

                                            </div><!-- /.footer-bottom-content -->
                                        </div><!-- /.container -->
                                    </div><!-- /.footer-bottom -->

                                </footer><!-- /#footer -->

                                <!-- JS -->
                                <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
                                <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
                                <script type="text/javascript" src="{{asset('js/marquee.js')}}"></script>
                                <script type="text/javascript" src="{{asset('js/moment.min.js')}}"></script>
                                <script type="text/javascript" src="{{asset('js/theia-sticky-sidebar.js')}}"></script>
                                <script type="text/javascript" src="{{asset('js/jquery.jplayer.min.js')}}"></script>
                                <script type="text/javascript" src="{{asset('js/jplayer.playlist.min.js')}}"></script>
                                <script type="text/javascript" src="{{asset('js/slick.min.js')}}"></script>
                                <script type="text/javascript" src="{{asset('js/carouFredSel.js')}}"></script>
                                <script type="text/javascript" src="{{asset('js/jquery.magnific-popup.js')}}"></script>
                                <script type="text/javascript" src="{{asset('js/main.js')}}"></script>
                                <script type="text/javascript" src="{{asset('js/nav.js')}}"></script>
                                <script type="text/javascript" src="{{asset('js/jquery.fancybox.min.js')}}"></script>
                                <script type="text/javascript" src="{{asset('js/jquery.fileuploader.min.js')}}"></script>
                                <script type="text/javascript" src="{{asset('js/files.js')}}"></script>
                                <script type="text/javascript" src="{{asset('js/pdfmake.min.js')}}"></script>
                                <script type="text/javascript" src="{{asset('js/vfs_fonts.js')}}"></script>
                                <script type="text/javascript" src="{{asset('js/datatables.min.js')}}"></script>
                                <script type="text/javascript" src="{{asset('js/typeahead.bundle.min.js')}}"></script>
                                <script type="text/javascript" src="{{asset('js/summernote.min.js')}}"></script>
                                <script type="text/javascript" src="{{asset('js/bootstrap-tagsinput.min.js')}}"></script>
                                <script type="text/javascript" src="{{asset('js/sweetalert2.all.min.js')}}"></script>
                                <script type="text/javascript" src="{{asset('js/switchery.min.js')}}"></script>

                                @yield('script')

                            </body>
                        </html>
