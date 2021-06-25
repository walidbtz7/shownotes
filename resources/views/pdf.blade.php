<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            padding: 2rem;
        }
        ul {
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            /* grid-template-columns: 1fr 1fr; */
        }
        ul li {
            margin-bottom: 5px;
            width: 50%;
        }
        h1 {
            text-align: center;
            margin-bottom: 1rem;
        }
        hr {
            margin: 1rem 0
        }
        h2 {
            margin: 10px 0;
            color: #42a5f5;
        }
        .module p {
            margin: 7px 0;
            font-size: 18px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 1rem;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even){background-color: #f2f2f2}

        th {
            background-color: #42a5f5;
            color: white;
        }
        span.v {
            color: #02b361;
        }
        span.nv {
            color: #ff1100;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td><b>nom:</b> {{ auth()->user()->etudiant->nom }}</td>
            <td><b>prenom:</b>  {{ auth()->user()->etudiant->prenom }}</td>
        </tr>
        <tr>
            <td><b>code cne:</b>  {{ auth()->user()->etudiant->code_cne }}</td>
            <td><b>code cin:</b>  {{ auth()->user()->etudiant->code_cin }}</td>
        </tr>
        <tr>
            <td><b>filiere:</b>  {{ auth()->user()->etudiant->filiere }}</td>
            <td><b>annee:</b>  {{ auth()->user()->etudiant->annee }}</td>
        </tr>
    </table>
    <hr>
    <h1>Relevé de notes</h1>
    @foreach ($semestres as $nom_semestre => $semestre)
        <div class="semestre">
            <h2>Semestre : {{ $nom_semestre }}</h2>
        @php
            $modules = collect($semestre)->groupBy('module');
        @endphp

        @foreach ($modules as $nom_module => $elements)
            @php
                $moyenne_de_module = \App\Calc::module_moyenne($elements);
            @endphp
            <div class="module">
                <p>Module de {{ $nom_module }} :
                    @if ($moyenne_de_module < 12)
                        <span class="nv">{{ $moyenne_de_module }} non validé</span>
                    @else
                        <span class="v">{{ $moyenne_de_module }} validé</span>
                    @endif 
                </p>
                
                <table>
                    <tr>
                        <th>Element</th>
                        <th>Controle</th>
                        <th>exam</th>
                        <th>moyenne</th>
                    </tr>
                    @foreach ($elements as $element)
                    <tr>
                        <td>{{ $element['element'] }}</td>
                        <td>{{ $element['controle'] }}</td>
                        <td>{{ $element['exam'] }}</td>
                        <td>{{ \App\Calc::element_moyenne($element['controle'], $element['exam']) }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        @endforeach
    @endforeach
</body>
</html>