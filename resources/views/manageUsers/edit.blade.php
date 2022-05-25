@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12 tr-sticky">
        <div class="tr-content theiaStickySidebar">
            <div class="tr-section">
                <div class="tr-post">
                    <div class="section-title title-before">
                    <span class="right"><a href="{{route('home')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Voltar</a></span>
                        <h1><a>Gerenciar Usuário</a></h1>
                    </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                <div class="tr-details">
                    <form action="{{ route( 'manageUsers.update', ['user' => $user->id] ) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="row">
                                    <h4>Dados Pessoais</h4>
                                    <hr>
                                    <div class="col-md-5">
                                        <label for="name">Nome Completo</label>
                                        <input type="text" class="form-control" id="name" value="{{ $user->name }}" name="name" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="tag">CPF</label>
                                        <input type="number" class="form-control" id="cpf" name="cpf" value="{{ $user->cpf }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="local">RG </label>
                                            <input type="text" class="form-control" id="rg" name="rg" value="{{ $user->rg }}" >
                                    </div>
                               </div>
                               <div class="row">
                                    <div class="col-md-6">
                                       <label for="email">e-mail</label>
                                       <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="nivel">Nivel Acesso</label>
                                        <input type="text" class="form-control" id="nivelAcesso" name="nivelAcesso" value="{{ $user->nivelAcesso }}" disabled="disabled" >
                                    </div>
                                    <div class="col-md-3">
                                        <label for="promover">&nbsp;</label>
                                        <input type="button" class="form-control btn btn-info" id="promote" @if($user->nivelAcesso == 'Admin') onClick="removePrivileges({{ $user->id }}) @else onClick="promoteUser({{ $user->id }}) @endif"
                                        value="
                                        @if($user->nivelAcesso == 'Admin') Remover privilégios de Admin

                                            @elseif($user->nivelAcesso == 'User') Promover usuário a Gerente @else Promover usuário a Admin @endif">
                                    </div>
                               </div>
                               <div class="row">
                                   <h4>Endereço</h4>
                                   <hr>
                                    <div class="col-md-7">
                                        <label for="logradouro">Logradouro</label>
                                            <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="logradouro">Numero</label>
                                            <input type="text" class="form-control" id="number" name="number" value="{{ $user->number }}">
                                    </div>
                                   <div class="col-md-3">
                                       <label for="logradouro">Bairro</label>
                                       <input type="text" class="form-control" id="district" name="district" value="{{ $user->district }}">
                                    </div>
                               </div>
                               <div class="row">
                                    <div class="col-md-7">
                                        <label for="logradouro">Cidade</label>
                                        <input type="text" class="form-control" id="city" name="city" value="{{ $user->city }}">
                                    </div>
                                    <div class="col-md-5">
                                        <label for="logradouro">Estado / UF</label>
                                        <input type="text" class="form-control" id="state" name="state" value="{{ $user->state }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-md-offset-3">
                            <input type="submit" class="btn btn-primary btn-xg btn-block">
                        </div>
                    </form>
                </div><!-- /.tr-details -->
            </div><!-- /.tr-section -->


        </div><!-- row -->
        </div>
      </div><!-- /.row -->
@endsection

@section('script')
<script>
function removePrivileges(id) {
            var id  = id;
            let _url = `/manageUsers/removePrivileges/${id}`;

            Swal.fire({
            title: 'Deseja realmente remover os privilégios deste usuário?',
            text: "O usuário selecionado não terá mais privilégios e não poderá inserir, alterar e apagar informações do sistema, confirmar?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, Confirmar!',
            cancelButtonText: 'Cancelar',
            width: '450px'

        }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: _url,
                type: 'PUT',
                data: {
                    "id": id,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {

                        $('#nivelAcesso').val('User');
                        $('#promote').val('Promover Usuário a Gerente');
                        $("#promote").attr("onClick",`promoteUser(${id})`);

                    Swal.fire(
                        'Privilégios de administrador removidos.!',
                        'Tudo certo, as alterações foram realizadas com sucesso.',
                        'success'
                    )
                }
            });
        }
    })
}

    function promoteUser(id) {
            var id  = id;
            let _url = `/manageUsers/promote/${id}`;

            Swal.fire({
            title: 'Deseja realmente promover este usuário?',
            text: "O usuário selecionado terá privilégios acima do atual, podendo inserir, alterar e apagar informações sensíveis do sistema, confirmar?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, Confirmar!',
            cancelButtonText: 'Cancelar',
            width: '450px'

        }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: _url,
                type: 'PUT',
                data: {
                    "id": id,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {

                    if($('#nivelAcesso').val() == 'User') {
                        $('#nivelAcesso').val('Gerente');
                        $('#promote').val('Promover Usuário a Administrador');
                    } else if($('#nivelAcesso').val() == 'Gerente') {
                        $('#nivelAcesso').val('Administrador');
                        $('#promote').val('Revogar Acesso de Administrador');
                        $("#promote").attr("onClick",`removePrivileges(${id})`);
                    }
                    Swal.fire(
                        'Usuário promovido!',
                        'Tudo certo, o usuário foi promovido!',
                        'success'
                    )
                }
            });
        }
    })
}



    </script>

@endsection
