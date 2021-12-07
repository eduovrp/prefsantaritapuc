@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12 tr-sticky">
        <div class="tr-content theiaStickySidebar">
            <div class="tr-section">
                <div class="tr-post">
                    <div class="entry-header">
                        <div class="entry-thumbnail">
                            <img class="img-responsive" src="{{$post->src_img}}" alt="Image">
                        </div>
                    </div>
                    <div class="post-content">
                        <div class="entry-meta">
                            <ul>
                                        <li>{{$post->created_at}}</li>
                                        <li>
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
                        <h2 class="entry-title">
                            {{$post->title}}
                        </h2>
                    </div><!-- /.post-content -->
                </div><!-- /.tr-post -->

                <div class="tr-details">
                    <div class="row">
                      {!! $post->text !!}
                    </div>
                </div><!-- /.tr-details -->
            </div><!-- /.tr-section -->


        </div><!-- row -->
        </div>
      </div><!-- /.row -->

@endsection
