@extends('layouts.app')

@section('content')

@foreach ($festivities as $fest)
<div class="modal fade" id="modal-{{$fest->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header header-calendario">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title center" id="myModalLabel">{{$fest->name}}</h4>
            </div>
            <div class="modal-body calendario">
                <p>{{$fest->desc}}</p>
            </div>
            <div class="modal-footer">
                <div class="col-md-6">
                    <a data-fancybox="gallery" href="{{$fest->first_img}}">
                        <img src="{{$fest->first_img}}" class="img-responsive img-thumbnail">
                    </a>
                </div>
                <div class="col-md-6">
                    <a data-fancybox="gallery" href="{{$fest->second_img}}">
                        <img src="{{$fest->second_img}}" class="img-responsive img-thumbnail">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="row">
    <div class="col-sm-12 tr-sticky ">
        <div class="tr-content  theiaStickySidebar">
            <div class="tr-section ">
                <div class="tr-post">
                    <div class="section-title title-before">
                        <h1><a href="#">Calendário de Eventos</a></h1>
                    </div>
                <div class="tur eventos">
                    <div class="row">
                        <div class="col-md-12">

                        @foreach ($festivities as $fest)


                            <div class="col-md-4">
                                <div class="new-card pointer" data-toggle="modal" data-target="#modal-{{$fest->id}}">
                                    <div class="new-card-content">
                                        <div class="categoria acontecendo">
                                            {{$fest->tag}}
                                        </div>
                                        <div class="data">
                                            <div class="divider">
                                                <span class="mes">{{substr($fest->month,0,3)}}</span>
                                            </div>
                                        </div>
                                        <div class="evento">
                                            <span class="nome">{{$fest->name}}</span>
                                            <span class="localizacao mt"><i class="fa fa-map-marker"></i> {{$fest->local}}</span>
                                            <span class="status acontecendo"><i class="fa fa-external-link"></i> Saiba mais</span>
                                        </div>
                                    </div>
                                    <div class="sombra"></div>
                                </div>
                            </div>

                        @endforeach

                    </div><!-- /.tr-details -->
                </div><!-- /.tr-section -->


            </div><!-- row -->
            </div>
          </div><!-- /.row -->
        </div><!-- /.row -->
    </div><!-- /.row -->

@endsection


