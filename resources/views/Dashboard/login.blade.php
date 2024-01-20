<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Dashboard</title>
    <link rel="stylesheet" href="/css/dashboard/login.css">
    <link rel="icon" href="/assets/image/Lofinz_transparent.png" type="image/x-icon">
</head>
<body>
    
<div class="container">
    <div class="content">
        <div class="box_login">
            <div class="logo_web">
                <img src="/assets/image/Lofinz.png" alt="Lofinz Logo">
            </div>
            <div class="header">
                <img src="/assets/image/profil_default2.png" alt="profil default">
                <div class="text">Masuk</div>
                <div class="hor_line"></div>
            </div>

            @if (session()->has('loginInvalid'))
                <div class="invalid_login">Username / Password salah!</div>
            @endif

            <form class="form_login" method="POST" action="/dashboard/login">
                @csrf
                <div class="form_input">
                    <input type="text" name="username" placeholder="Username" value="{{ old('username') }}" @error('username') style="border:1px solid red;"  @enderror >
                    @error('username')
                        <div class="invalid_validation">{{$message}}</div>
                    @enderror
                </div>
                <div class="form_input form_input_password">
                    <input id="input_password" type="password" name="password" placeholder="Password" @error('password') style="border:1px solid red;"  @enderror>
                    @error('password')
                        <div class="invalid_validation">{{$message}}</div>
                    @enderror
                    <div class="toggle_show_password">
                        <input id="toggle_show_password_input" type="checkbox">
                        <span>Tampilkan password</span>
                    </div>
                </div>
                <div class="confirm_login">
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.querySelector('#toggle_show_password_input').addEventListener('click', function(e){
        if(e.target.checked){
            document.querySelector('#input_password').setAttribute('type', 'text')
        }else{
            document.querySelector('#input_password').setAttribute('type', 'password')
        }
    })
</script>

</body>
</html>