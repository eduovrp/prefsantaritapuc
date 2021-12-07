@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12 tr-sticky">
        <div class="tr-content theiaStickySidebar">
            <div class="tr-section">
                <div class="tr-post">
                    <div class="section-title title-before">
                    <span class="right"><a href="{{route('manageFiles.index')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Voltar</a></span>
                        <h1><a>Arquivos</a></h1>
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
                    <form action="{{route ('manageFiles.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-5">
                                    <label for="">Categoria</label>
                                    <select name="category" id="category" class="form-control" required>
                                        <option value="">Selecione a Categoria</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
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
        $("#category").change(function() {
            var category = $(this).val();
            $('.after').remove();

            $.ajax({
                url: "{{ route('ajaxRequest') }}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "category" : category
                },
                success: function(data){
                    data.map(category => {
                        $('.subCategory').after(`<option class="after" value="${category.id}"> ${category.name} </option>`);
                    })
                    $('#subCategory').prop('disabled', '');
                }
            })
         });

        $('input[name="files"]').fileuploader({
            addMore: true
        });
    });
    </script>


@endsection
