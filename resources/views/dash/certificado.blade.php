<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Certificado</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
        <style>

            /*html{ margin: 0; }*/

            body{
                font-family: 'Poppins', sans-serif;
                text-align: center;
                padding: 2rem;
                border: solid 5px #7E22CE;
            }

            h1, h2, h3, h4, h5 , h6{ margin: .5rem 0; }

            h1{ font-size: 3rem; }

            .fw-light{ font-weight: 300; }

            .fw-bold{ font-weight: 700; }

            .mt-3{ margin-top: 3rem; }

            .mt-5{ margin-top: 5rem; }

            .me-5{ margin-right: 5rem; }

            .d-inline-block {
                display: inline-block;
            }

            .small{ font-size: .8rem; }


        </style>
    </head>
    <body>
        <img src="{{ asset('img/logo.svg') }}" alt="Logo Secma">
        <h3 class="fw-light mt-3">Este certificado acredita que</h3>
        <h1>{{ $evaluacion->user->name.' '.$evaluacion->user->surname }}</h1>
        <h4>DNI: {{ $evaluacion->user->dni }}</h4>
        <h3 class="fw-light">ha aprobado el curso de</h3>
        <h2>{{ $evaluacion->examen->curso->nombre }}</h2>
        <h3 class="fw-light">con calificación de <span class="fw-bold">{{ $evaluacion->calificacion }}%</span>@if($evaluacion->examen->curso->plan->frecuencia) y validez del <span class="fw-bold">{{ $evaluacion->updated_at->format('d/m/Y') }}</span> al <span class="fw-bold">{{ $evaluacion->vigencia() }}</span>@endif</h3>
        <div class="mt-5">
            <div class="d-inline-block me-5">
                <img src="{{ asset(Storage::url($evaluacion->examen->curso->profesor->firma)) }}" alt="Firma" height="50">
                <div class="small fw-light">{{ $evaluacion->examen->curso->profesor->apellido.', '.$evaluacion->examen->curso->profesor->nombre }}</div>
            </div>
            <div class="d-inline-block">
                <img src="{{ asset(Storage::url($empresa->logo)) }}" alt="Logo Empresa" height="75">
            </div>  
        </div>
    </body>
</html>