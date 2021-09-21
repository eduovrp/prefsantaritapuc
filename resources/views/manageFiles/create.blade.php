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
                        <div class="tr-details">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    <form action="{{url ("manageFiles/$file->id") }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @METHOD('PUT')
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-5">
                                
                                    <label for="category">Categoria</label>
                                    <select name="category" id="category" class="form-control" required>
                                        <option value="">Selecione a Categoria</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}"  @if($category->id === $file->fileCategory->id) selected='selected' @endif>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <label for="subCategory">Sub-Categoria</label>
                                    <select name="subCategory" id="subCategory" class="form-control" required>
                                        <option value="" class="subCategory">Selecione a Categoria</option>

                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="year">Ano</label>
                                    <input type="number" class="form-control" name="year" id="year" value="{{$file->year}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{$file->name}}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="path">Caminho</label>
                                <input type="text" class="form-control" name="path" id="path" value="{{$file->path}}" disabled >
                            </div>
                            </div>
                        </div>
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
@endsection