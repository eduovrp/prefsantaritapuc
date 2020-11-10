@extends('layouts.app')

@section('content')

<x-jet-validation-errors class="mb-4" />

<div class="row">
	<div class="col-sm-12 tr-sticky">
	    <div class="tr-content theiaStickySidebar">
			<div class="tr-section">
				<div class="tr-post">
                    <x-jet-validation-errors />

					<div class="tr-details arqs">
                        <div class="ragister-account text-center tr-section">
                            <div class="account-content">
                                <div class="logo text-center">
                                    <a class="navbar-brand" href="#"><img class="img-responsive" src="images/logosr.png" width="40%" style="left: 0" alt="Logo"></a>
                                </div>
                                <div class="section-title">
                                    <h1>Registre-se</h1>
                                </div>
                                <form method="POST" class="contact-form contact-form-two" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-group">
                                        <div>
                                            <x-jet-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Digite o seu nome"/>
                                            <x-jet-input id="email"  class="form-control" type="email" name="email" :value="old('email')" required placeholder="Digite o seu e-mail"/>
                                            <x-jet-input id="password"  class="form-control" type="password" name="password" required autocomplete="new-password" placeholder="Digite uma senha"/>
                                            <x-jet-input id="password_confirmation"  class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Repita a senha" />
                                        </div>

                                    <hr>
                                        <label for="news">
                                            <x-jet-input id="news" type="checkbox" checked name="news" />
                                            Desejo receber e-mails de noticias importantes e futuros eventos no município.
                                        </label>
                                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                                    </div>
                                    <span>Ou</span>
                                    <div class="buttons">
                                        <a href="{{route('login')}}" class="btn btn-primary pass">Já possui cadastro? Clique para entrar</a>
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
