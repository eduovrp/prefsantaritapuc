@extends('layouts.app')

@section('content')

 @php
 if(Auth::user()->nivel_acesso_id > 1)
    $nivelAcessos->shift()
 @endphp

<div class="row">
    <div class="col-sm-12 tr-sticky">
        <div class="tr-content theiaStickySidebar">
            <div class="tr-section">
                <div class="tr-post">
                    <div class="section-title title-before">
                    <span class="right"><a href="{{route('manageUsers.list')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Voltar</a></span>
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
                    <form action="{{ route( 'manageUsers.update', ['user' => $user->id] ) }}" method="post" id="target" enctype="multipart/form-data">
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
                                        <input type="text" class="form-control" id="cpf" name="cpf" value="{{ $user->cpf }}">
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="nivelAcesso">Nivel de Acesso</label>

                                          <select class="form-control" name="nivel_acesso_id" id="nivel_acesso_id"
                                                @if(Auth::user()->nivel_acesso_id >= 2 && $user->nivel_acesso_id <= 2) disabled="disabled" @endif>
                                            @foreach($nivelAcessos as $nivel)
                                                <option value="{{$nivel->id}}"  @if($nivel->id === $user->nivel_acesso_id) selected='selected' @endif>{{$nivel->name}}</option>
                                            @endforeach
                                          </select>
                                        </div>
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

@if(Auth::user()->nivel_acesso_id != 1 && $user->id == 6 || Auth::user()->nivel_acesso_id >= 1 && $user->id == 6 && Auth::user()->id != 6)

    @section('script')
        <script>

            $("#target :input").prop("disabled", true);

        </script>

    @endsection
@endif
