<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-light bg-dark">
        <form action="/logout" method="POST">
            @csrf
            <a href="/logout" class="navbar-brand text-primary"
                onclick="event.preventDefault();this.closest('form').submit();">SAIR</a>
        </form>
        <a class="navbar-brand text-primary" href="/listar">LISTAR</a>
    </nav>

    @if(session('get_ok'))
    <div class="alert alert-success alert-dismissible" role="alert">        
            <i class="fa fa-check-circle"></i>        
        <span class="tex-success">{{session('get_ok')}}</span>
    </div>
    @endif

    @if(session('get_fail'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <i class="fa fa-exclamation"></i>
        <span class="tex-success">{{session('get_fail')}}</span>
    </div>
    @endif

    @if(session('delete_ok'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <i class="fa fa-check-circle"></i>
        <span class="tex-success">{{session('delete_ok')}}</span>
    </div>
    @endif

    <div class="container my-5 bg-light">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="form-group ">
                    <form action="/home/submit" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-2 offset-md-3">
                                <label>Nome do carro:</label>
                            </div>
                            <div class="col-5">
                                <input class="form-control" id="termo" name="termo">
                            </div>
                            <div class="col-2">
                                <input type="submit" class="btn btn-primary"></input>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>