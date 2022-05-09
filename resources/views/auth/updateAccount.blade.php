@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12 tr-sticky">
        <div class="tr-content theiaStickySidebar">
            <div class="tr-section">
                <div class="tr-post">
                    <div class="section-title title-before">
                    <span class="right"><a href="{{route('home')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Voltar</a></span>
                        <h1><a>Complete seu cadastro ou atualize as informações</a></h1>
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
                    <form action="{{ route( 'auth.update', ['user' => $user->id] ) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="row">
                                    <h4>Dados Pessoais</h4>
                                    <hr>
                                    <div class="col-md-5">
                                        <label for="name">Nome Completo</label>
                                        <input type="text" class="form-control" id="name" value="{{ $user->name }}" name="name" placeholder="Digite seu nome completo." required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="tag">CPF</label>
                                        <input type="number" class="form-control" id="cpf" name="cpf" value="{{ $user->cpf }}" maxlength="11" placeholder="Somente Números, sem pontos ou traços.">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="local">RG </label>
                                            <input type="text" class="form-control" id="rg" name="rg" value="{{ $user->rg }}" placeholder="Digite seu RG">
                                    </div>
                               </div>
                               <div class="row">
                                   <h4>Endereço</h4>
                                   <hr>
                                    <div class="col-md-7">
                                        <label for="logradouro">Logradouro</label>
                                            <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}" placeholder="Digite seu endereço, rua, avenida, alameda, etc.">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="logradouro">Numero</label>
                                            <input type="text" class="form-control" id="number" name="number" value="{{ $user->number }}" placeholder="Digite o número.">
                                    </div>
                                   <div class="col-md-3">
                                       <label for="logradouro">Bairro</label>
                                       <input type="text" class="form-control" id="district" name="district" value="{{ $user->district }}" placeholder="Digite seu bairro.">
                                    </div>
                               </div>
                               <div class="row">
                                    <div class="col-md-7">
                                        <label for="logradouro">Cidade</label>
                                        <input type="text" class="form-control" id="city" name="city" value="{{ $user->city }}" placeholder="Digite a cidade onde você mora.">
                                    </div>
                                    <div class="col-md-5">
                                        <label for="logradouro">Estado / UF</label>
                                        <input type="text" class="form-control" id="state" name="state" value="{{ $user->state }}" placeholder="Digite o estado onde você mora.">
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

@endsection
