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
        <a class="navbar-brand text-primary" href="/home">HOME</a>
    </nav>
    <div class="container">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome do veículo</th>
                    <th scope="col">Ano</th>
                    <th scope="col">Quilometragem</th>
                    <th scope="col">Combustível</th>
                    <th scope="col">Portas</th>
                    <th scope="col">Câmbio</th>
                    <th scope="col">Cor</th>
                    <th scope="col">Link</th>
                    <th scope="col">Preço</th>
                    <th scope="col">
                    <form action="/deletar/all" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Todos os dados serão removidos. Deseja continuar?')" class="btn btn-danger delete-btn"><i class="fa fa-exclamation-triangle"></i>Deletar Todos</button>
                        </form>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($carros as $carro)
                <tr>
                    <td>
                        {{$carro->nome_veiculo}}
                    </td>
                    <td>
                        {{$carro->ano}}
                    </td>
                    <td>
                        {{$carro->quilometragem}}
                    </td>
                    <td>
                        {{$carro->combustivel}}
                    </td>
                    <td>
                        {{$carro->portas}}
                    </td>
                    <td>
                        {{$carro->cambio}}
                    </td>
                    <td>
                        {{$carro->cor}}
                    </td>
                    <td>
                        {{$carro->link}}
                    </td>
                    <td>
                        R$ {{$carro->preco}}
                    </td>
                    <td>
                        <form action="/deletar/{{$carro->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn">Deletar</button>
                        </form>
                    </td>
                </tr>                
                @endforeach
            </tbody>
        </table>

    </div>
</body>

</html>