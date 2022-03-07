@extends('layouts.app')


@section('content')

<div class="row">
    <div class="col-sm-12 tr-sticky">
        <div class="tr-content theiaStickySidebar">
            <div class="tr-section">
                <div class="tr-post">
                    <div class="section-title title-before">
                        <h1><a>Cadastrar Nova Categoria de Arquivos</a></h1>
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

                <div class="tr-manage">
                    <form action="{{route ('manageFileCategories.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="name">Nome da Categoria</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="col-md-3">
                                    <label for="iconMenu">Icon FontAwesome</label>
                                    <input type="text" class="form-control" id="iconMenu" name="iconMenu">
                                </div>
                                <div class="col-md-3">
                                    <label for="href">href</label>
                                    <input type="text" class="form-control" id="href" name="href">
                                </div>
                                <div class="col-md-3">
                                    <label for=""></label>
                                    <input type="submit" class="btn form-control btn-primary">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
            <div class="tr-section">
                <div class="tr-post">
                    <div class="section-title title-before">
                        <h1><a>Categoria de Arquivos</a></h1>
                    </div>
                    <div class="tr-manage">
                        <table id="dataTable-Files" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th class="print">Nome</th>
                                    <th class="print">Icon FontAwesome</th>
                                    <th class="print">href</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                        <tbody>
                            @foreach($FileCategories as $cat)
                            <tr id="row_{{ $cat->id }}">
                                <td>{{$cat->id}}</td>
                                <td class="print">{{ $cat->name }}</td>
                                <td class="print"><i class="{{ $cat->iconMenu }}" aria-hidden="true"> </i> ({{ $cat->iconMenu }})</td>
                                <td class="print">{{ $cat->href }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-bars"></i>
                                        <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ route('manageFileCategories.edit', ['fileCategory' => $cat->id]) }}"><i class="fa fa-edit fa-2x"></i> Editar</a></li>
                                            <li>
                                                @if($cat->fileSubCategories->isNotEmpty() == false)
                                                    <a href="javascript:void(0)" onClick="deleteCat({{ $cat->id }})">
                                                        <i class="fas fa-trash fa-2x"></i> Excluir
                                                    </a>
                                                @else
                                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Existem sub-menus cadastrados nesta categoria, é preciso remove-los antes de excluir este registro."><i class="gray fas fa-trash fa-2x"></i> Excluir</a>
                                                @endif
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

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

        $('#name').on('focusout',function(){
            var text = $('#name').val();
            let _url = `/manageFileSubCategories/${text}`;
            $.ajax({
                type: 'POST',
                url: _url,
                data: {
                        "text": text,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#href').val(response);
                    }
            });
        });

        function deleteCat(id) {
                var id  = id;
                let _url = `/manageFileCategories/delete/${id}`;

                Swal.fire({
                title: 'Deseja realmente excluir esta categoria?',
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
                            'Categoria exlcluida!',
                            'Tudo certo, a Categoria foi excluida do sistema.',
                            'success'
                        )
                    }
                });
            }
        })
    }
        </script>

@endsection
