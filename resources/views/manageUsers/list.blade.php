@extends('layouts.app')


@section('content')

<div class="row">
    <div class="col-sm-12 tr-sticky">
        <div class="tr-content theiaStickySidebar">
            <div class="tr-section">
                <div class="tr-post">
                    <div class="section-title title-before">
                        <h1><a>Gerenciar Usuários</a></h1>
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
                        <table id="dataTable-Files" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th class="print">Nome do Usuário</th>
                                    <th class="print">E-Mail</th>
                                    <th class="print">Provedor</th>
                                    <th class="print">Nível de Acesso</th>
                                    <th class="print">Data de Criação</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr id="row_{{ $user->id }}">
                                <td>{{$user->id}}</td>
                                <td class="print">{{ $user->name }}</td>
                                <td class="print">{{ $user->email }}</td>
                                <td class="print">{{ $user->provider }}</td>
                                <td class="print">{{ $user->nivelAcesso }}</td>
                                <td class="print">{{ date('d/m/Y', strtotime($user->created_at)); }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-bars"></i>
                                        <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ route('user.edit', ['contact' => $user->id]) }}"><i class="fas fa-search-plus"></i> Visualizar</a></li>
                                            <li>
                                                <a href="javascript:void(0)" onClick="deleteUser({{ $user->id }})">
                                                    <i class="fas fa-trash"></i> Excluir
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

        function deleteUser(id) {
                var id  = id;
                let _url = `/user/delete/${id}`;

                Swal.fire({
                title: 'Deseja realmente excluir este Usuário?',
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
                            'Usuário exlcluido!',
                            'Tudo certo, o usuário foi excluido do sistema.',
                            'success'
                        )
                    }
                });
            }
        })
    }

        </script>

@endsection
