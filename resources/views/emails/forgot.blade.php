<img src="{{asset('images/psite7_logo_small.png')}}" alt="PSITE-7 logo" style="height: 100px">
<h1>Hello, {{$user->fname}}!</h1>
<p>
    You have received this email because you indicated that you have forgotten your password
    in our PSITE-7 convention web site. Please click on the link below to proceed with
    the passsword recovery process.
</p>
<p>
    If you did not request this password recovery, please ignore this email. Thank you!
</p>
<hr>
<p>
    Password recovery link: <a href="https://regcon.psite7.org/password-recovery/{{$user->email_token}}">Click Here</a> to recover your password.
</p>
