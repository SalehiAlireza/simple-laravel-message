<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>@yield('title')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="{{ asset('table/bootstrap.min.css' ) }} ">

    <link rel="stylesheet" type="text/css" href="{{ asset('table/font-awesome.min.css' ) }} ">

    <link rel="stylesheet" type="text/css" href="{{ asset('table/animate.css' ) }} ">

    <link rel="stylesheet" type="text/css" href="{{ asset('table/select2.min.css' ) }} ">

    <link rel="stylesheet" type="text/css" href="{{ asset('table/perfect-scrollbar.css' ) }} ">

    <link rel="stylesheet" type="text/css" href="{{ asset('table/util.css' ) }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('table/main.css' ) }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/font.css' ) }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('dropzone.css' ) }} ">
    <script src="{{ asset('dropzone.js') }}"></script>
    <style>

        .require{
            background:darkorange ;
            padding: 3px;
            color: #ffff;
            border-radius: 15px;
            border: 1px solid white;
        }

        .normal{
            background:#2d3748;
            padding: 3px;
            color: #ffff;
            border-radius: 15px;
            border: 1px solid white;
        }

        .emergency{
            background:#721c24;
            padding: 3px;
            color: #ffff;
            border-radius: 15px;
            border: 1px solid white;
        }


        /*
            inputs
        */

        #wrap {
            width: 100%;
            max-width: 900px;
            margin: 0 auto 60px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.25);
        }

        .input::before {
            content: "";
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 300px;
            background: #0f1041;
        }
        .input-header {
            position: relative;
            padding-top: 80px;
            color: #fff;
        }
        .input-header h1 {
            padding-bottom: 25px;
            font-size: 3.25em;
            font-weight: 100;
        }
        .input-content {
            position: relative;
            padding: 44px 55px;
            background: #fff;
            z-index: 10;
        }
        .input-content h2 {
            padding-bottom: 45px;
            font-size: 1.625em;
            font-weight: bold;
            vertical-align: middle;
        }
        .input-content h2 span {
            display: inline-block;
            margin-left: 10px;
            padding: 5px 6px 3px;
            border: 1px solid #ffca00;
            border-radius: 4px;
            font-size: 0.85rem;
            vertical-align: middle;
            color: #ffca00;
        }
        .input-content .inputbox {
            overflow: hidden;
            position: relative;
            padding: 15px 0 28px 200px;
        }
        .input-content .inputbox-title {
            position: absolute;
            top: 15px;
            left: 0;
            width: 200px;
            height: 30px;
            color: #666;
            font-weight: bold;
            line-height: 30px;
        }
        .input-content .inputbox-content {
            position: relative;
            width: 100%;
        }
        .input-content .inputbox-content input {
            width: 100%;
            height: 30px;
            box-sizing: border-box;
            line-height: 30px;
            font-size: 14px;
            border: 0;
            background: none;
            border-bottom: 1px solid #ccc;
            outline: none;
            border-radius: 0;
            -webkit-appearance: none;
        }
        .input-content .inputbox-content input:focus ~ label, .input-content .inputbox-content input:valid ~ label {
            color: #2962ff;
            transform: translateY(-20px);
            font-size: 0.825em;
            cursor: default;
        }
        .input-content .inputbox-content input:focus ~ .underline {
            width: 100%;
        }
        .input-content .inputbox-content label {
            position: absolute;
            top: 0;
            left: 0;
            height: 30px;
            line-height: 30px;
            color: #ccc;
            cursor: text;
            transition: all 200ms ease-out;
            z-index: 10;
        }
        .input-content .inputbox-content .underline {
            content: "";
            display: block;
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 0;
            height: 2px;
            background: #2962ff;
            transition: all 200ms ease-out;
        }
        .input-content .btns {
            padding: 30px 0 0 200px;
        }
        .input-content .btns .btn {
            display: inline-block;
            margin-right: 2px;
            padding: 10px 25px;
            background: none;
            border: 1px solid #c0c0c0;
            border-radius: 2px;
            color: #666;
            font-size: 1.125em;
            outline: none;
            transition: all 100ms ease-out;
        }
        .input-content .btns .btn:hover, .input-content .btns .btn:focus {
            transform: translateY(-3px);
        }
        .input-content .btns .btn-confirm {
            border: 1px solid #2962ff;
            background: #2962ff;
            color: #fff;
        }

        *{
            direction: rtl;
            text-align: right !important;
        }
    </style>
    <script>
        Dropzone.options.myDropzone = {
            dictDefaultMessage: "فایل خود را آپلود کنید",
            sending : function (file, xhr, formData){
                formData.append('_token', '{{ csrf_token() }}');
            },
            success : function(file,response){
                let medias = $("#medias");
                let defaultValue = medias.val();
                if (defaultValue === undefined)
                    alert('ورودی عکس موجود نمی باشد');

                if (defaultValue !== undefined && defaultValue === '' )
                    defaultValue += response;
                if (defaultValue !== undefined && defaultValue !== '' )
                    defaultValue += ";"+response;

                medias.val(defaultValue)
            }
        };
    </script>
</head>
<body>

@yield('content')

<script src="{{ asset('table/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('table/bootstrap.min.js') }}"></script>
<script src="{{ asset('table/popper.js') }}"></script>
<script src="{{ asset('validation-jquery.js') }}"></script>
<script>
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })
</script>
</body>
</html>
