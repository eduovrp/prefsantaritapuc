@component('mail::message')
    <h1>Assunto: {{$data->subject}}</h1>
    <p><strong>Nome: </strong> {{$data->name}}, <strong>e-mail: </strong> {{$data->email}}</p>
    <p> <strong>Mensagem: </strong>  <br>
        {{$data->message}}
    </p>
@endcomponent

