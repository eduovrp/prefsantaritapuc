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
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('warning'))
                    <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ session('warning') }}
                    </div>
                @endif
                    <a href="{{ route('uploadFiles') }}" class="btn btn-primary">Novo Upload</a>
                <div class="tr-details">
                    <div class="table-responsive">
                        <table id="dataTable-Files" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="print">Nome</th>
                                    <th>Caminho</th>
                                    <th class="print">Ano</th>
                                    <th class="print">Categoria</th>
                                    <th class="print">Sub-Categoria</th>
                                    <th>Download</th>
                                    <th>Editar</th>
                                    <th>Deletar</th>
                                </tr>
                            </thead>
                        <tbody>
                            @foreach($files as $file)
                            <tr id="row_{{ $file->id }}">
                                <td class="print">{{ $file->name }}</td>
                                <td>{{ substr($file->path,0,25 )}}...</td>
                                <td class="print">{{ $file->year }}</td>
                                <td class="print">{{ $file->fileCategory->name }}</td>
                                <td class="print">{{ $file->fileSubCategory->name }}</td>
                                <td><a href="{{ $file->path }}" target="_blank"><i class="fa fa-download fa-2x"></i></a></td>
                                <td><a href="{{ route('manageFiles.edit', ['file' => $file->id]) }}"><i class="fa fa-edit fa-2x"></i></a></td>
                                <td>
                                    <a href="javascript:void(0)" onClick="deletePost({{ $file->id }})">                               
                                        <i class="fas fa-trash fa-2x"></i>
                                    </a>
                                </td>
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

      <script>
           function deletePost(id) {
                var id  = id;
                let _url = `/manageFiles/delete/${id}`;

                console.log(id);
                console.log(_url);

                $.ajax({
                    url: _url,
                    type: 'DELETE',
                    data: {
                        "id": id,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                    $("#row_"+id).remove();
                    }
                });
            }
        </script>

@endsection
