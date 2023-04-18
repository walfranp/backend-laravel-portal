<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Extrato</title>
</head>

<body>
    <h3>Extrato de gastos</h3>
    <br>
    @foreach($dados['gastos'] as $dado)

        <p>{{ $dado->convenio }} - {{ $dado->valor }}</p>

    @endforeach

</body>

</html>
