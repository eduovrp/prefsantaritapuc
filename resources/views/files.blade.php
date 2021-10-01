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
                                @if($file->ext == 'pdf')
                                    <i class="far fa-file-pdf fa-5x"></i>
                                @elseif ($file->ext == 'docx')
                                    <i class="far fa-file-word fa-5x"></i>
                                @elseif($file->ext == 'rar')
                                    <i class="far fa-file-archive fa-5x"></i>
                                @else
                                    <i class="far fa-file fa-5x"></i>
                                @endif
                            </div>
                            @if(strlen($file->desc) > 3)
                            <div class="col-md-9">
                                <p class="file_name">{{$file->single_name.' n°. '.$file->number.' / '.$file->year}}</p>
                                <p class="file_desc">{{$file->desc}}</p>
                            </div>
                            @else 
                                <div class="col-md-9">
                                    
                                    <p class="file_desc">{{$file->fileName}}</p>
                                </div> 
                            @endif
                        </div>
                    </div><!-- /.tr-details -->
                </div>
            </a>
            @endforeach
        @endif
    </div>
    
      </div><!-- /.row -->

@endsection
