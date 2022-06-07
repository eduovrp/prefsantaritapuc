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
                                <td class="print">{{ $user->nivelAcesso->name }}</td>
                                <td class="print">{{ date('d/m/Y', strtotime($user->created_at)); }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-bars"></i>
                                        <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            @if(Auth::user()->nivel_acesso_id != 1 && $user->id != 6 || Auth::user()->nivel_acesso_id == 1)
                                                <li><a href="{{ route('manageUsers.edit', ['user' => $user->id]) }}"><i class="fas fa-edit"></i> Editar</a></li>
                                            @endif
                                            <li>
                                               @if(Auth::user()->nivel_acesso_id > 1 && $user->nivel_acesso_id == 1 || Auth::user()->nivel_acesso_id == $user->nivel_acesso_id)
                                                <a href="javascript:void(0)" onClick="warningMessage()">
                                                    <i class="fas fa-trash"></i> Excluir
                                                </a>
                                               @else
                                                <a href="javascript:void(0)" onClick="deleteUser({{ $user->id }})">
                                                    <i class="fas fa-trash"></i> Excluir
                                                </a>
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

function warningMessage() {

                Swal.fire({
                title: 'Erro!',
                text: "Você não tem permissão excluir este usuário.",
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Fechar',
                width: '450px'
                });
            }

        function deleteUser(id) {
                var id  = id;
                let _url = `/manageUsers/delete/${id}`;

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
