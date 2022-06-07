@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12 tr-sticky">
        <div class="tr-content theiaStickySidebar">
            <div class="tr-section">
                    <canvas id="myChart"></canvas>
            </div><!-- /.tr-section -->


        <div class="row">
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right">Total</span>
                        <h5>Arquivos Enviados</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{$countArch}}</h1>
                        <div class="stat-percent font-bold text-navy"><i class="fa fa-file"></i></div>
                        <small><strong>{{$countArchYear}}</strong> Enviados este ano</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-info pull-right">Total</span>
                        <h5>Usuários Cadastrados</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{$countUsers}}</h1>
                        <div class="stat-percent font-bold text-s"> <i class="fa fa-user"></i></div>
                        <small><strong>{{$countUsersMounth}}</strong> cadastrados este mês</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-warning pull-right">Total</span>
                        <h5>Notícias Publicadas</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{$countPosts}}</h1>
                        <div class="stat-percent font-bold text-y"> <i class="fa fa-newspaper-o"></i></div>
                        <small><strong>{{$countPostsMonth}}</strong> publicadas este mês</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-danger pull-right">Atual</span>
                        <h5>Mensagens Recebidas</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{$countContacts}}</h1>
                        <div class="stat-percent font-bold text-r"> <i class="fa fa-envelope"></i></div>
                        <small><strong>{{$countContactsUnread}}</strong> mensagens não lidas</small>
                    </div>
                </div>
            </div>
        </div>


        </div><!-- row -->
        </div>
      </div><!-- /.row -->

@endsection

@section('script')
    <script>
        const countY = {!! json_encode($countY) !!};
        const labels = {!! json_encode($yArr) !!};

        const data = {
        labels: labels,
        datasets: [{
            label: 'Arquivos enviados por ANO',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: countY,
        }]
        };

        const config = {
        type: 'line',
        data: data,
        options: {
            tension: 0.4,
        }
        };

        const myChart = new Chart(
        document.getElementById('myChart'),
        config
  );
    </script>



@endsection
