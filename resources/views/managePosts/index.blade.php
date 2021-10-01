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
                    <a href="{{ route('managePosts.create') }}" class="btn btn-primary">Nova Notícia</a>
                <div class="tr-details">
                    <div class="table-responsive">
                        <table id="dataTable-Files" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="print">Título</th>
                                    <th class="print">Categorias</th>
                                    <th class="print">Tags</th>
                                    <th class="print">Data</th>
                                    <th>Abrir</th>
                                    <th>Editar</th>
                                    <th>Deletar</th>
                                </tr>
                            </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr id="row_{{ $post->id }}">
                                <td class="print">{{ $post->title }}</td>
                                <td class="print">{{ $post->categoryPost->name}}</td>
                                <td class="print">
                                    @foreach($post->tags as $tag)
                                        #{{$tag->name}}
                                    @endforeach
                                </td>
                                <td class="print">{{ $post->created_at }}</td>
                                <td><a href="{{route('post.show', ['post'=> $post->id])}}" target="_blank"><i class="fas fa-external-link-alt fa-2x"></i></a></td>
                                <td><i class="fa fa-edit fa-2x"></i></a></td>
                                <td>
                                    <a href="javascript:void(0)" onClick="deletePost({{ $post->id }})">                               
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
                let _url = `/managePosts/delete/${id}`;

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
                    }
                });
            }
        </script>

@endsection
