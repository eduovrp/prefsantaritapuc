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

                    <a href="uploadFiles" class="btn btn-primary">Novo Upload</a>
                <div class="tr-details">
                    <div class="table-responsive">
                        <table id="dataTable-Files" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="print">Nome</th>
                                    <th class="print">Caminho</th>
                                    <th class="print">Ano</th>
                                    <th class="print">Categoria</th>
                                    <th class="print">Sub-Categoria</th>
                                    <th>Download</th>
                                    <th>Editar</th>
                                </tr>
                            </thead>
                        <tbody>
                            @foreach($files as $file)
                            <tr>
                                <td class="print">{{$file->name}}</td>
                                <td class="print">{{substr($file->path,0,25)}}...</td>
                                <td class="print">{{$file->year}}</td>
                                <td class="print">{{$file->fileCategory->name}}</td>
                                <td class="print">{{$file->fileSubCategory->name}}</td>
                                <td><a href="{{$file->path}}"><i class="fa fa-download fa-2x"></i></a></td>
                                <td><a href="{{url("manageFiles/$file->id/edit")}}"><i class="fa fa-edit fa-2x"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>


                </div><!-- /.tr-details -->
            </div><!-- /.tr-section -->


        </div><!-- row -->
        </div>
      </div><!-- /.row -->

@endsection
