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
                                <div class="col-md-5">
                                    <label for="">Categoria</label>
                                        <div id="the-basics">
                                            <input class="typeahead form-control" type="text" name="category" style="width: 25em;" placeholder="">
                                        </div>
                                </div>
                                <div class="col-md-5">
                                    <label for="">Sub-Categoria</label>
                                    <select name="subCategory" id="subCategory" class="form-control" disabled required>
                                        <option value="" class="subCategory">Selecione a Categoria</option>

                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="year">Ano</label>
                                    <input type="number" class="form-control" name="year" id="year" value="{{now()->year}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="file" name="files" required>
                        </div>
                        <div class="col-md-6 col-md-offset-3">
                            <input type="submit" class="btn btn-primary btn-block">
                        </div>
                            </div>
                        </div>
                    </form>

                </div><!-- /.tr-details -->
            </div><!-- /.tr-section -->


        </div><!-- row -->
        </div>
      </div><!-- /.row -->

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
});

</script>

@endsection
