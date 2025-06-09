<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>System Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="jquery.min.js"></script>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url("keretainka.png");
            background-position: center;
            background-size: cover; /* Ensure the background covers the entire page */
            background-repeat: no-repeat;
        }

        @media screen and (max-width: 600px) {
            h4 {
                font-size: 85%;
            }
        }

        .white-background {
            background-color: white;
            display: inline-block; 
            padding: 20px; 
            border-radius: 10px; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
            width: 40%; 
            margin-top: -5%;
        }

        .btn-full-width {
            width: 100%;
        }
    </style>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
</head>

<body>
    <div align="center">
        <div class="container white-background col-12">
            <img src="{{ asset('logoinka.png') }}" width=80%" style="margin-top:5%">
            <div class="container">
                <h3>Sistem Informasi Monitoring Tindak Lanjut</h3>
            </div>

            <br \><br \>
            <div class="container">
                <div style="color:white">
                </div><br>
                <form action="{{ url('login') }}" method="post">
                    @csrf
                    @if (session()->has('loginError'))
                        <div class="form-group col-4">
                            <div class="alert alert-danger alert-dismissable fade show" role="alert">
                                {{ session('loginError') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif
                    <div class="form-group col-6">
                        <input type="text" class="form-control @error('username' || 'nip') is-invalid @enderror"
                            placeholder="Username" name="username" autofocus required
                            value="{{ old('username' || 'nip') }}">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="Password" name="password" required value="{{ old('password') }}">
                    </div>
                    <div style="color:red">
                        <p>Lupa username atau password hubungi admin1
                        </p>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary btn-full-width" name="btn-login">Masuk</button>
                    </div>
                </form>
                <br>
            </div>
        </div>
    </div>
</body>

</html>
