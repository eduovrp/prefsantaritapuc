@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12 tr-sticky">
        <div class="tr-content theiaStickySidebar">
            <div class="tr-section">
                <div class="tr-post">
                    <div class="section-title title-before">
                        <h1><a>Arquivos</a></h1>
                    </div>

                <div class="tr-details">
                    @foreach($files as $file)
                    <ul>
                        <li>{{$file->name}}</li>
                    </ul>
                    @endforeach

                </div><!-- /.tr-details -->
            </div><!-- /.tr-section -->


        </div><!-- row -->
        </div>
      </div><!-- /.row -->

@endsection
