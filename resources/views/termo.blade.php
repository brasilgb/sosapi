<!DOCTYPE html>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laravel 10 Generate PDF Example - ItSolutionStuff.com</title>
    <script src="{{base_path('public/js/tailwind.js')}}"></script>
</head>

<body>
    @foreach($empresas as $empresa)
    <table>
        <tr>
            <td class="flex items-center justify-start">
                <img src="{{ public_path('/storage/uploads/'. $empresa->logo) }}" alt="Logo">
                <h1 class="text-3xl text-red-800">{{ $empresa->razao }}</h1>
            </td>

            <td>
                dados da empresa jose
            </td>
        </tr>
    </table>
    @endforeach

</body>

</html>