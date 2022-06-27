@extends('layouts.app')

@section('content')

            <div class="row">
                <div class="col-sm-12 tr-sticky">
                    <div class="tr-content theiaStickySidebar">
                        <div class="tr-section">
                            <div class="tr-post">
                            <div class="tr-details arqs">
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
                                <x-jet-validation-errors class="alert alert-warning" role="alert" />
                            <div class="ragister-account text-center tr-section">
            <div class="account-content">
            <div class="logo text-center">
                <a class="navbar-brand" href="#"><img class="img-responsive" src="{{ asset('images/logosr.png') }}" style="left: 0" alt="Logo"></a>
            </div>
            <div class="section-title">
                <h1>Seja Bem-vindo</h1>
            </div>
            <form method="POST" class="contact-form contact-form-two" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <x-jet-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus placeholder="e-mail" />
                    <x-jet-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password"  placeholder="Senha" />

                    <button type="submit" class="btn btn-primary">Entrar</button>
                    <span><a href="{{route('auth.forgot-password')}}">Esqueci minha senha</a></span>
                </div>
                <span>Ou</span>
                <div class="buttons">
                    <a href="{{route('social.login', ['provider' =>'google'])}}" class="btn btn-primary google">Entre usando o Google</a>
                    <a href="{{route('social.login', ['provider' =>'github'])}}" class="btn btn-primary twitter">Entre usando o Github</a>
                    <a href="{{route('register')}}" class="btn btn-primary pass">Registre-se usando uma senha</a>
                </div>
               </form><!-- /.contact-form -->

            </div><!-- /.account-content -->
            </div><!-- /.tr-page-content -->

                            </div><!-- /.tr-details -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div><!-- /.container-fulid -->
            </div><!-- /.main-wrapper -->

@endsection
