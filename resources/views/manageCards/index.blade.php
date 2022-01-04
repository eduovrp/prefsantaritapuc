@extends('layouts.app')


@section('content')

<div class="row">
    <div class="col-sm-12 tr-sticky">
        <div class="tr-content theiaStickySidebar">
            <div class="tr-section">
                <div class="tr-post">
                    <div class="section-title title-before">
                        <h1><a>Cartões</a></h1>
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
                    <a href="{{ route('manageCards.create') }}" class="btn btn-primary">Novo Cartão</a>
                <div class="tr-details">
                        <table id="dataTable-Files" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th class="print">Nome do Evento</th>
                                    <th class="print">Url Vinculada</th>
                                    <th class="print">Data Exp</th>
                                    <th class="print">Situação</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                        <tbody>
                            @foreach($cards as $card)
                            <tr id="row_{{ $card->id }}">
                                <td>{{$card->id}}</td>
                                <td class="print">{{ $card->name }}</td>
                                <td class="print"><a data-fancybox="gallery" href="/{{$card->src_img_onclick}}">{{$card->src_img_onclick}}</a></td>
                                <td class="print">{{ $card->date_exp }}</td>
                                <td class="print">
                                    @if($card->active == 1)
                                        <i class="fa fa-check" style="color:green"></i>
                                    @else
                                        <i class="fa fa-times" style="color:red"></i>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-bars"></i>
                                        <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a data-fancybox="gallery" href="{{$card->src_img}}"><i class="fas fa-search-plus fa-2x"></i> Visualizar</a></li>
                                            <li><a href="{{ route('manageCards.edit', ['card' => $card->id]) }}"><i class="fa fa-edit fa-2x"></i> Editar</a></li>
                                            <li>
                                                <a href="javascript:void(0)" onClick="deleteCard({{ $card->id }})">
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

        function deleteCard(id) {
                var id  = id;
                let _url = `/manageCard/delete/${id}`;

                Swal.fire({
                title: 'Deseja realmente excluir este cartão?',
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
                            'Cartão exlcluido!',
                            'Tudo certo, o cartão foi excluido do sistema.',
                            'success'
                        )
                    }
                });
            }
        })
    }
        </script>

@endsection
