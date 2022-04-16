@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12 tr-sticky">
        <div class="tr-content theiaStickySidebar">
            <div class="tr-section">
                <div class="tr-post">
                    <div class="section-title title-before">
                    <span class="right"><a href="{{route('contact.list')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Voltar</a></span>
                        <h1><a>Ouvidoria</a></h1>
                    </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                <div class="tr-details ouvidoria">

                    <div class="container">
                        <div class="col-md-8 col-md-offset-2">
                            <h2>Assunto: {{ $data->subject }}</h2>

                            <h3><strong>Nome:</strong> {{ $data->name }}, <strong>E-mail:</strong> {{ $data->email }} </h3>

                            <p>{{ $data->message }} </p>
                            <span>Data: {{ $data->created_at }}</span>

                        </div>
                    </div>


                </div><!-- /.tr-details -->
            </div><!-- /.tr-section -->

        </div><!-- row -->
        </div>
      </div><!-- /.row -->
@endsection
