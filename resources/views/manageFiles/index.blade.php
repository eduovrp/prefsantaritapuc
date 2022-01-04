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
                        <table id="dataTable-Files" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="print">Nome</th>
                                    <th>Caminho</th>
                                    <th class="print">Ano</th>
                                    <th class="print">Categoria</th>
                                    <th class="print">Sub-Categoria</th>
                                    <th>Ações</th>
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
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-bars"></i>
                                        <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ $file->path }}" target="_blank"><i class="fa fa-download fa-2x"></i> Download</a></li>
                                            <li><a href="{{ route('manageFiles.edit', ['file' => $file->id]) }}"><i class="fa fa-edit fa-2x"></i> Editar</a></li>
                                            <li>
                                                <a href="javascript:void(0)" onClick="deleteFile({{ $file->id }})">
                                                    <i class="fas fa-trash fa-2x"></i> Excluir
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                </div><!-- /.tr-details -->
            </div><!-- /.tr-section -->


        </div><!-- row -->
        </div>
      </div><!-- /.row -->

      <script>

        function deleteFile(id) {
                var id  = id;
                let _url = `/managePosts/delete/${id}`;

                Swal.fire({
                title: 'Deseja realmente excluir este arquivo?',
                text: "Ao excluir, não será possível reverter a ação.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar!',
                cancelButtonText: 'Cancelar',
                width: '450px'

            }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: _url,
                    type: 'DELETE',
                    data: {
                        "id": id,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $("#row_"+id).fadeOut(300, function() {
                             $(this).remove();
                        });

                        Swal.fire(
                            'Arquivo exlcluido!',
                            'Tudo certo, o arquivo foi excluida do sistema.',
                            'success'
                        )
                    }
                });
            }
        })
    }
        </script>

@endsection
