<!DOCTYPE html>

<html>

<head>

    <title>Laravel 10 Generate PDF Example - ItSolutionStuff.com</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>

    <h1>{{ $title }}</h1>

    <p>{{ $date }}</p>

    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod

    tempor incididunt ut labore et dolore magna aliqua.</p>

  

    <table class="table table-bordered">

        <tr>

            <th>ID</th>

            <th>Name</th>

            <th>Email</th>

        </tr>

        @foreach($ordens as $ordem)

        <tr>

            <td>{{ $ordem->id }}</td>

            <td>{{ $ordem->cliente->nome }}</td>

            <td>{{ $ordem->status }}</td>

        </tr>

        @endforeach

    </table>

  

</body>

</html>