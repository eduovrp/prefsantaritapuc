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
                    <a href="{{ route('managePosts.create') }}" class="btn btn-primary">Nova Notícia</a>
                <div class="tr-manage">
                        <table id="dataTable-Files" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th class="print">Título</th>
                                    <th class="print">Categorias</th>
                                    <th class="print">Tags</th>
                                    <th class="print">Data</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr id="row_{{ $post->id }}">
                                <td>{{$post->id}}</td>
                                <td class="print">{{ $post->title }}</td>
                                <td class="print">{{ $post->categoryPost->name}}</td>
                                <td class="print">
                                    @foreach($post->tags as $tag)
                                        #{{$tag->name}}
                                    @endforeach
                                </td>
                                <td class="print">{{ $post->date }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-bars"></i>
                                        <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{route('post.show', ['post'=> $post->id])}}" target="_blank"><i class="fas fa-external-link-alt fa-2x"></i> Visualizar</a></li>
                                            <li><a href="{{ route('managePosts.edit', ['post' => $post->id]) }}"><i class="fa fa-edit fa-2x"></i> Editar</a></li>
                                            <li>
                                                <a href="javascript:void(0)" onClick="deletePost({{ $post->id }})">
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
@endsection

@section('script')
<script>
    function deletePost(id) {
                var id  = id;
                let _url = `/managePosts/delete/${id}`;

                Swal.fire({
                title: 'Deseja realmente excluir essa notícia?',
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
                            'Notícia exlcluida!',
                            'Tudo certo, a noticia foi excluida do sistema.',
                            'success'
                        )
                    }
                });
            }
        })
    }
</script>
@endsection
