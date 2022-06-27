@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12 tr-sticky">
        <div class="tr-content theiaStickySidebar">
            <div class="tr-section">
                <div class="tr-post">
                    <div class="section-title title-before">
                        <h1><a>Notícias</a></h1>
                    </div>

                <div class="tr-details">
                    <div class="notices">
                        @foreach ($posts as $post)
                            <div class="row notice">
                                <a href="{{route('post.show', ['post'=> $post->id])}}" target="_blank">
                                    <div class="col-md-3">
                                        <img src="{{ asset($post->src_img)}}" class="img-responsive">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="title-post">{{$post->title}}</div>
                                            <div class="post-content">
                                                {{substr(strip_tags($post->text,'<br>'),0,200)}}...
                                            </div>
                                                <div class="entry-meta">
                                                    <ul>
                                                                <li><i class="fa fa-calendar"></i> {{$post->created_at}}</li>
                                                                <li> <i class="fa fa-tag"></i>
                                                                    @foreach($post->tags as $tag)
                                                                    #{{$tag->name}}
                                                                    @endforeach
                                                                </li>
                                                                <li>
                                                                    <span class="categories badge badge-secondary">
                                                                        {{$post->categoryPost->name}}
                                                                    </span>
                                                                </li>
                                                    </ul>
                                                </div><!-- /.entry-meta -->

                                        </div>
                                    </div>
                                </a>
                            </div>
                            <hr>
                        @endforeach

                        {{$posts->render()}}
                    </div>
                </div><!-- /.tr-details -->
            </div><!-- /.tr-section -->


        </div><!-- row -->
        </div>
      </div><!-- /.row -->

@endsection
