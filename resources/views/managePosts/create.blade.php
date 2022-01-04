@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12 tr-sticky">
        <div class="tr-content theiaStickySidebar">
            <div class="tr-section">
                <div class="tr-post">
                    <div class="section-title title-before">
                    <span class="right"><a href="{{route('managePosts.index')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Voltar</a></span>
                        <h1><a>Criar nova notícia</a></h1>
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
                    <form action="{{route ('managePosts.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="title">Título *</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="category">Categoria *</label>
                                        <div id="the-basics">
                                            <input class="typeahead form-control" id="category" type="text" name="category" required>
                                        </div>
                                </div>
                                <div class="col-md-5">
                                        <label for="tags">Tags *</label><br>
                                        <input type="text" class="form-control" name="tags" id="tags" data-role="tagsinput" required/>
                                </div>
                                <div class="col-md-3">
                                    <label for="date">Data *</label>
                                    <input type="date" name="date" id="date" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="">Imagem Principal *</label>
                                    <input type="file" name="files1" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="text">Texto da Notícia *</label>
                                    <textarea name="text" id="text" class="summernote" cols="30" rows="30"></textarea>
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
        var substringMatcher = function(strs) {
        return function findMatches(q, cb) {
        var matches, substringRegex;

        // an array that will be populated with substring matches
        matches = [];

        // regex used to determine if a string contains the substring `q`
        substrRegex = new RegExp(q, 'i');

        // iterate through the pool of strings and for any string that
        // contains the substring `q`, add it to the `matches` array
        $.each(strs, function(i, str) {
            if (substrRegex.test(str)) {
            matches.push(str);
            }
        });

        cb(matches);
        };
    };

    var grupos = [<?php foreach($categoriesJson as $c){ echo "'".$c['name']."',";}?>];

    $('#the-basics .typeahead').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    },
    {
        name: 'grupos',
        source: substringMatcher(grupos)
    });

    Date.prototype.toDateInputValue = (function() {
            var local = new Date(this);
            local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
            return local.toJSON().slice(0,10);
        });

    $('#date').val(new Date().toDateInputValue());

    $('.summernote').summernote({
            minHeight: 200,
        });

        $('input[name="files1"]').fileuploader({
        limit: 1,
        extensions: ['jpg', 'jpeg', 'png', 'gif'],
        captions: 'pt',
        editor: {
            cropper: {
                minWidth: 800,
                minHeight: 300,
                showGrid: true
            },
            quality: 90,
            maxHeight: 400
        }
    });


});

</script>

@endsection
