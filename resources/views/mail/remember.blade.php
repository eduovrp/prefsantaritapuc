@component('mail::message')
    <h4>Olá, tudo bem?</h4>

    <p>Recebemos sua solicitação para <strong>recuperação de senha </strong>.
        É só clicar no botão abaixo e seguir o passo a passo:</p> </br>

        <a href="http://127.0.0.1:8000/login/reset-password/{{$data}}" style="background-color:#ff7900;border:1px solid #ff7900;border-color:#ff7900;border-radius:15px;border-width:1px;color:#ffffff;display:inline-block;font-size:14px;font-weight:bold;letter-spacing:0px;line-height:normal;padding:12px 30px 12px 30px;text-align:center;text-decoration:none;border-style:solid;font-family:arial,helvetica,sans-serif">
            Definir nova senha</a>
        </br>
    <p>Caso você não tenha solicitado a redefinição, ignore este email e verifique as configurações de sua conta.</p>
@endcomponent

