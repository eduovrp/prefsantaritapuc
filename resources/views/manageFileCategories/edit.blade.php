@extends('layouts.app')


@section('content')

<div class="row">
    <div class="col-sm-12 tr-sticky">
        <div class="tr-content theiaStickySidebar">
            <div class="tr-section">
                <div class="tr-post">
                    <div class="section-title title-before">
                        <h1><a>Editar Categoria: {{$cat->name}}</a></h1>
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
                    <form action="{{route ('manageFileCategories.update', ['fileCategory' => $cat->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="name">Nome da Categoria</label>
                                    <input type="text" class="form-control" id="name" value="{{$cat->name}}" name="name">
                                </div>
                                <div class="col-md-3">
                                    <label for="iconMenu">Icon FontAwesome</label>
                                    <input type="text" class="form-control" id="iconMenu" value="{{$cat->iconMenu}}" name="iconMenu">
                                </div>
                                <div class="col-md-3">
                                    <label for="href">href</label>
                                    <input type="text" class="form-control" id="href" value="{{$cat->href}}" name="href">
                                </div>
                                <div class="col-md-3">
                                    <label for=""></label>
                                    <input type="submit" class="btn form-control btn-primary" value="Salvar Alterações">
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
                            <a href="{{route('manageFileCategories.index')}}" class="btn btn-default right"><i class="fa fa-arrow-left"></i> Voltar</a>
                        <h1><a>SubCategoria de Arquivos</a></h1>
                    </div>
                    <div class="tr-manage">
                        <form action="{{route ('manageFileSubCategories.store') }}" id="form-subCat" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name1" name="name">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="single_name">Single Name</label>
                                        <input type="text" class="form-control" id="single_name1" name="single_name">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="href">href</label>
                                        <input type="text" class="form-control" id="href1" name="href">
                                    </div>
                                    <div class="col-md-3">
                                        <label for=""></label>
                                        <input type="submit" class="btn form-control btn-primary" id="criarSubCategoria" value="Cadastrar SubCategoria">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="fileCategory" id="category_id" value="{{$cat->id}}">
                            <input type="hidden" id="method">
                        </form>
                    </div>
                    <br><br>
                    <div class="tr-manage">
                        <table id="dataTable-Files" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th class="print">Name</th>
                                    <th class="print">Single Name</th>
                                    <th class="print">href</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                        <tbody>
                            @foreach($subCategorias as $subCat)
                            <tr id="row_{{ $subCat->id }}">
                                <td>{{$subCat->id}}</td>
                                <td class="print">{{ $subCat->name }}</td>
                                <td class="print">{{ $subCat->single_name }}</td>
                                <td class="print">{{ $subCat->href }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-bars"></i>
                                        <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a onclick="editarSubCat('{{$subCat->href}}','{{$subCat->name}}','{{$subCat->single_name}}',{{$subCat->id}})" class="pointer"><i class="fa fa-edit fa-2x"></i> Editar</a></li>
                                            <li>
                                                <a href="javascript:void(0)" onClick="deleteSubCat({{ $subCat->id }})">
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

        $('#name1').on('focusout',function(){
            var text = $('#name1').val();
            let _url = `/manageFileSubCategories/${text}`;
            $.ajax({
                type: 'POST',
                url: _url,
                data: {
                        "text": text,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#href1').val(response);
                    }
            });
        });

    function editarSubCat(href,name,single_name,id){
        $("#href1").val(href);
        $("#name1").val(name);
        $("#single_name1").val(single_name);
        $("#criarSubCategoria").prop("id","AlterarSubCat").val("Atualizar SubCategoria");
        $("#form-subCat").attr("action",`{{url ('manageFileSubCategories/${id}') }}`);
        $("#method").attr('name', '_method').val('PUT');
    }

        function deleteSubCat(id) {
                var id  = id;
                let _url = `/manageFileSubCategories/delete/${id}`;

                Swal.fire({
                title: 'Deseja realmente excluir esta SubCategoria?',
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
                            'Tudo certo, a SubCategoria foi excluida do sistema.',
                            'success'
                        )
                    }
                });
            }
        })
    }
        </script>

@endsection
