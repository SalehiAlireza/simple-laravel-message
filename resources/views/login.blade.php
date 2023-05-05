<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN</title>
    <style>
        body{
            background-image: url("/walpaper.jpg");
            background-position: center;
            background-origin: content-box;
            background-repeat: no-repeat;
            background-size: cover;
            min-height:100vh;
            font-family: 'Noto Sans', sans-serif;
        }
        .text-center{
            color:#fff;
            text-transform:uppercase;
            font-size: 23px;
            margin: -50px 0 80px 0;
            display: block;
            text-align: center;
        }
        .box{
            position:absolute;
            left:50%;
            top:50%;
            transform: translate(-50%,-50%);
            background-color: rgba(0, 0, 0, 0.89);
            border-radius:3px;
            padding:70px 100px;
        }
        .input-container{
            position:relative;
            margin-bottom:25px;
        }
        .input-container label{
            position:absolute;
            top:0px;
            left:0px;
            font-size:16px;
            color:#fff;
            pointer-event:none;
            transition: all 0.5s ease-in-out;
        }
        .input-container input{
            border:0;
            border-bottom:1px solid #555;
            background:transparent;
            width:100%;
            padding:8px 0 5px 0;
            font-size:16px;
            color:#fff;
        }
        .input-container input:focus{
            border:none;
            outline:none;
            border-bottom:1px solid #e74c3c;
        }
        .btn{
            color:#fff;
            background-color:#e74c3c;
            outline: none;
            border: 0;
            color: #fff;
            padding:10px 20px;
            text-transform:uppercase;
            margin-top:50px;
            border-radius:2px;
            cursor:pointer;
            position:relative;
        }
        /*.btn:after{
            content:"";
            position:absolute;
            background:rgba(0,0,0,0.50);
            top:0;
            right:0;
            width:100%;
            height:100%;
        }*/
        .input-container input:focus ~ label,
        .input-container input:valid ~ label{
            top:-12px;
            font-size:12px;

        }
    </style>
</head>
<body>
<div class="box">
    <form action="{{ route('ticket.login.submit') }}" method="Post"  autocomplete="off">
        <span class="text-center">login</span>
        <div class="input-container">
            <input name="username"  autocomplete="off" placeholder="نام کاربری" />
            <label>username</label>
        </div>
        <div class="input-container">
            <input type="password" name="password" autocomplete="off" placeholder="رمز عبور"  />
            <label>password</label>
        </div>
        @csrf
        <button type="submit" class="btn">ورود</button>
    </form>

    @if($errors->any())
        @foreach($errors->all() as $err)
            <p style="color: red;">
                {{ $err }}
            </p>
        @endforeach
    @endif


</div>
</body>
</html>
