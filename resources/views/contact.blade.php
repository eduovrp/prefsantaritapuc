@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12 tr-sticky">
        <div class="tr-content theiaStickySidebar">
            <div class="tr-section">
                <div class="tr-post">
                    <div class="section-title title-before">
                        <h1><a href="#">Ouvidoria</a></h1>
                    </div>
                    <div class="tr-details arqs">
                        <div class="tr-contact-section tr-section">
                            <ul class="contact-content">
                                <li>
                                    <div class="icon">
                                        <img src="images/others/cta-icon-1.png" alt="Image" class="img-responsive">
                                    </div>
                                    <span>(17) 3643-1123</span>
                                </li>
                                <li>
                                    <div class="icon">
                                        <img src="images/others/cta-icon-2.png" alt="Image" class="img-responsive">
                                    </div>
                                    <span><a href="#">tecnologia@santaritadoeste.sp.gov.br</a></span>
                                </li>
                                <li>
                                    <div class="icon">
                                        <img src="images/others/cta-icon-3.png" alt="Image" class="img-responsive">
                                    </div>
                                    <span>Rua Antonio Tavares, 107 - Centro - Santa Rita d'Oeste - SP</span>
                                </li>
                            </ul>
                        </div><!-- /.tr-contact-section -->
                            <hr>
                        <div class="tr-comment-box">
                            <form class="contact-form" name="contact-form" method="post" action="enviar.php">
                                <div class="section-title">
                                    <h1>Envie-nos uma mensagem</h1>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="one">Nome *</label>
                                            <input type="text" class="form-control" name="nome" required="required" id="one">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="two">E-mail *</label>
                                            <input type="email" class="form-control" name="email" required="required" id="two">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="three">Assunto *</label>
                                            <input type="text" class="form-control" name="assunto" required="required" id="three">
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="four">Mensagem</label>
                                            <textarea name="message" required="required" class="form-control" rows="7" id="four"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary pull-right">Enviar</button>
                                </div>
                            </form><!-- /.contact-form -->
                            </div><!-- /.tr-comment-box -->
                        </div><!-- /.tr-details -->

                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
