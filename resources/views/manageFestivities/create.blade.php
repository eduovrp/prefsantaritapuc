@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12 tr-sticky">
        <div class="tr-content theiaStickySidebar">
            <div class="tr-section">
                <div class="tr-post">
                    <div class="section-title title-before">
                    <span class="right"><a href="{{route('manageFestivities.index')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Voltar</a></span>
                        <h1><a>Criar nova Festividade</a></h1>
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

                <div class="tr-details">
                    <form action="{{route ('manageFestivities.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="name">Nome *</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="tag">Tag *</label>
                                    <input type="text" class="form-control" id="tag" name="tag" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="local">Local *</label>
                                        <input type="text" class="form-control" id="local" name="local" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="month">Mês da Festividade *</label>
                                    <input type="month" name="month" id="month" class="form-control" required>
                                </div>
                                <div class="col-md-8">
                                    <input type="file" name="files5">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col md-12">
                                    <label for="desc">Descrição</label>
                                    <textarea name="desc" class="form-control" id="desc" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-md-offset-3">
                            <input type="submit" class="btn btn-primary btn-xg btn-block">
                        </div>
                            </div>
                        </div>
                    </form>

                </div><!-- /.tr-details -->
            </div><!-- /.tr-section -->


        </div><!-- row -->
        </div>
      </div><!-- /.row -->
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {

            $('input[name="files5"]').fileuploader({
                limit: 2,
                extensions: ['jpg', 'jpeg', 'png', 'gif'],
                captions: 'pt',
            });

        });
    </script>
@endsection
