@extends('layouts.app')


@section('content')

<div class="row">
    <div class="col-sm-12 tr-sticky">
        <div class="tr-content theiaStickySidebar">
            <div class="tr-section">
                <div class="tr-post">
                    <div class="section-title title-before">
                        <h1><a>Ouvidoria</a></h1>
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
                                    <th class="print">Nome do Requerente</th>
                                    <th class="print">E-Mail</th>
                                    <th class="print">Assunto</th>
                                    <th class="print">Data do Envio</th>
                                    <th class="print">Lido?</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                        <tbody>
                            @foreach($contacts as $contact)
                            <tr id="row_{{ $contact->id }}">
                                <td>{{$contact->id}}</td>
                                <td class="print">{{ $contact->name }}</td>
                                <td class="print">{{ $contact->email }}</td>
                                <td class="print">{{ $contact->subject }}</td>
                                <td class="print">{{ date('d/m/Y', strtotime($contact->created_at)); }}</td>
                                <td class="print">
                                    @if($contact->read == 'yes')
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
                                            <li><a href="{{ route('contact.view', ['contact' => $contact->id]) }}"><i class="fas fa-search-plus"></i> Visualizar</a></li>
                                            <li>
                                                <a href="javascript:void(0)" onClick="deleteMessage({{ $contact->id }})">
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

        function deleteMessage(id) {
                var id  = id;
                let _url = `/contact/delete/${id}`;

                Swal.fire({
                title: 'Deseja realmente excluir esta mensagem?',
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
                            'Mensagem exlcluida!',
                            'Tudo certo, a mensagem foi excluido do sistema.',
                            'success'
                        )
                    }
                });
            }
        })
    }

        </script>

@endsection
