<img src="{{asset('images/psite7_logo_small.png')}}" alt="PSITE-7 logo" style="height: 100px">
<h1>Hello, {{$user->fname}}!</h1>
<p>Thank you very much for registering to our PSITE-7 Regional Convention.</p>
<p>Please confirm your email by clicking on the link below to complete your registration</p>
<p>
    <a href="https://regcon.psite7.org/confirm-email/{{$user->id}}/{{$user->email_token}}">Click Here</a> to confirm your email.
</p>
