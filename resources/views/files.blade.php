@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12 tr-sticky">
        <div class="tr-content theiaStickySidebar">
            <div class="tr-section">
                <div class="tr-post">
                    <div class="section-title title-before">
                        <h1><a>{{implode(' / ',explode('/',$uri))}}</a></h1>
                    </div>
                  
            </div><!-- /.tr-section -->
            
        </div><!-- row -->
        @if($checkUri==false)
    
            @foreach($years as $year)
            <a href='{{url("$uri/$year->year")}}'>
                <div class="col-md-3">              
                    <div class="tr-years">
                            {{$year->year}}
                        </div>
                    </div>
                </a>
            @endforeach
        @else
            @foreach($files as $file)
            <a href="{{ asset($file->path) }}" target="_blank">
            <div class="col-md-4">      
                <div class="tr-arqs">
                    <div class="row">
                            <div class="col-md-3">
                                <i class="far fa-file-pdf fa-5x"></i>
                            </div>
                            <div class="col-md-9">
                                <p class="file_name">{{$file->internal_type.''.$file->internal_number}}</p>
                                <p class="file_desc">{{$file->simple_name}}</p>
                            </div>
                        </div>
                    </div><!-- /.tr-details -->
                </div>
            </a>
            @endforeach
        @endif
    </div>
    
      </div><!-- /.row -->

@endsection
