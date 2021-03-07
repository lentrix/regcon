<h1>Hello, {{$user->fname}}!</h1>
<p>Thank you very much for registering to our PSITE-7 Regional Convention.</p>
<p>Please confirm your email by clicking on the link below to complete your registration</p>
<p>
    <a href="http://localhost:8000/confirm-email/{{$user->id}}/{{$user->email_token}}">Sample Link Only</a>
</p>
