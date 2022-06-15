@extends('layouts.app')

@section('content')


<div class="tr-home-slider home-slider-1 tr-section">
    <div id="home-carousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">

            @foreach ($posts as $post)

            <li data-target="#home-carousel" data-slide-to="{{$loop->index}}" class="@if($loop->first) active @endif">
                <span class="catagory">{{$post->categoryPost->name}}</span>
                <span class="indicators-title">{{$post->title}}</span>
            </li>

            @endforeach

        </ol>

        <div class="carousel-inner" role="listbox">
            <!-- Noticias -->
        @foreach ($posts as $post)
                    <div class="item @if($loop->first) active @endif" style=" background-image: url({{ $post->src_img }})">
                        <div class="post-content">
                            <span class="catagory" data-animation="animated fadeInUp">
                                <a href="#">
                                    @foreach($post->tags as $tag)

                                   <span>#{{$tag->name}} </span>

                                    @endforeach
                                </a>
                            </span>
                            <h2 class="entry-title" data-animation="animated fadeInUp">
                                <a href="{{route('post.show', ['post'=> $post->id])}}">{{ $post->title }}</a>
                            </h2>
                            <div class="entry-meta"  data-animation="animated fadeInUp">
                                <ul>
                                    <li>{{ $post->created_at }}</a></li>
                                </ul>
                            </div>
                        </div><!-- /.post-content -->
                    </div><!-- /.item -->

                    @endforeach

									<!-- Fim Noticias -->

								</div><!-- /.carousel-inner -->
							</div><!-- /#home-carousel -->
                        </div><!-- /.tr-home-slider -->

                        <div class="row">
							<div class="col-sm-8">
								<div class="tr-content">
									<div class="tr-section bg-transparent">
										<div class="tr-post medium-post">
											<div id="carousel-one" class="carousel slide" data-ride="carousel">
												<div class="carousel-inner" role="listbox">

                                                @foreach($cards as $card)
													<div class="item @if($loop->first)active @endif">
													@if($card->src_img_onclick != null)
														<a data-fancybox="gallery" href="{{$card->src_img_onclick}}">
													@else
                                                        <a href="{{$card->href}}">
													@endif
                                                            <div class="entry-header">
                                                                <div class="entry-thumbnail">
                                                                    <img src="{{$card->src_img}}" width="600px" alt="Image" >
                                                                </div>
                                                            </div>
														</a>
													</div>
                                                @endforeach

												</div>
												<div class="gallery-turner">
													<a class="left-photo" href="#carousel-one" role="button" data-slide="prev"><i class="fa fa-angle-left fa-2x"></i></a>
													<a class="right-photo" href="#carousel-one" role="button" data-slide="next"><i class="fa fa-angle-right fa-2x"></i></a>
												</div>
											</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tr-weather tr-widget">
                                    <div class="weather-top">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="weather-image">
                                                    <img class="img-responsive" src="images/others/{{$weather->icon}}.png" alt="Image">
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <span class="weather-temp">{{$weather->temperature}} <sup><span>°</span>C</sup></span>
                                                <span class="weather-type">{{$weather->condition}}</span>
                                            </div>
                                        </div>
                                        <ul>
                                            <li>{{$weather->name.' - '.$weather->state}}</li>
                                            <li><span><img class="img-responsive" src="images/others/weather2.png" alt="Image"></span>{{$weather->humidity}}%</li>
                                            <li><span><img class="img-responsive" src="images/others/weather3.png" alt="Image"></span>{{$weather->data->wind_velocity}} Km/h</li>
                                        </ul>
                                        <div class="right">
                                            Atualizado em: {{date('d/m/Y à\s H:i', strtotime($weather->date))}}
                                        </div>
                                    </div><!-- /.weather-top -->

                                    <div class="weather-bottom">
                                        <ul>
                                            @foreach($forecast->data as $day)

                                            <li>
                                                <div class="weather-icon">
                                                    <img class="img-responsive" src="images/others/days/{{$day->dayIcon}}.png" alt="Image">
                                                </div>
                                                <div class="weather-info">
                                                    <span>{{$day->minTemperature.'° / '.$day->maxTemperature}}°</span>
                                                    <span class="date">@if($loop->first) {{'Hoje'}} @else {{date('d/m', strtotime($day->date))}} @endif</span>
                                                </div>
                                            </li>
                                                @if($loop->iteration == 4)
                                                    @break
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div><!-- /.weather-bottom -->
                                </div><!-- /.weather-widget -->
                            </div>

                            <div class="col-sm-4 tr-sidebar tr-sticky">
                                    <div class="theiaStickySidebar">

                                        <div class="tr-section tr-widget">
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li role="presentation" class="active"><a href="#links" data-toggle="tab"><i class="fa fa-star"></i> Links Úteis</a></li>
                                            </ul>
                                                <div role="tabpanel" class="tab-pane fade in" id="links">
                                                    <ul class="authors-post">
                                                    <br>
                                                        <li>
                                                            <div class="entry-meta">
                                                                <div class="author-image">
                                                                    <a href="{{url('concursos/editais')}}"><img class="img-responsive" src="images/services/concursos.png" alt="Concursos e Seletivos"></a>
                                                                </div>
                                                                <div class="author-info">
                                                                    <h2><a href="{{url('concursos/editais')}}">Concursos e Seletivos</a></h2>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <hr>
                                                        <li>
                                                            <div class="entry-meta">
                                                                <div class="author-image">
                                                                    <a href="{{url('licitacao/contratos')}}"><img class="img-responsive" src="images/services/licitacao.png" alt="Contratos de Licitações"></a>
                                                                </div>
                                                                <div class="author-info">
                                                                    <h2><a href="{{url('licitacao/contratos')}}">Contratos de Licitações</a></h2>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <hr>
                                                        <li>
                                                            <div class="entry-meta">
                                                                <div class="author-image">
                                                                    <a href="{{url('legislacao/leis')}}"><img class="img-responsive" src="images/services/legislacao.png" alt="Leis do Município"></a>
                                                                </div>
                                                                <div class="author-info">
                                                                    <h2><a href="{{url('legislacao/leis')}}">Leis do Município</a></h2>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <hr>
                                                        <li>
                                                            <div class="entry-meta">
                                                                <div class="author-image">
                                                                    <a href="{{url('legislacao/decretos')}}"><img class="img-responsive" src="images/services/sugestao.png" alt="Decretos"></a>
                                                                </div>
                                                                <div class="author-info">
                                                                    <h2><a href="{{url('legislacao/decretos')}}">Decretos</a></h2>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <hr>
                                                        <li>
                                                            <div class="entry-meta">
                                                                <div class="author-image">
                                                                    <a href="{{route('festivities')}}"><img class="img-responsive" src="images/services/turismo.png" alt="Turismo"></a>
                                                                </div>
                                                                <div class="author-info">
                                                                    <h2><a href="{{route('festivities')}}">Turismo</a></h2>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <hr>
                                                        <li>
                                                            <div class="entry-meta">
                                                                <div class="author-image">
                                                                    <a href="{{route('contact.index')}}"><img class="img-responsive" src="images/services/ouvidoria.png" alt="Ouvidoria"></a>
                                                                </div>
                                                                <div class="author-info">
                                                                    <h2><a href="{{route('contact.index')}}">Ouvidoria</a></h2>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div><!-- /.theiaStickySidebar -->

                                </div>
                            </div>
@endsection
