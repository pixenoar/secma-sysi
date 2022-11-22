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

            .mt-4{ margin-top: 4rem; }

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
        <h3 class="fw-light mt-4">Este certificado acredita que</h3>
        <h1>Eduardo Viegas Custodio</h1>
        <h3 class="fw-light">ha aprobado el curso de</h3>
        <h2>Programación avanzada en Laravel</h2>
        <h3 class="fw-light">con calificación de <span class="fw-bold">90%</span> y validez del <span class="fw-bold">05/09/2022</span> al <span class="fw-bold">05/09/2023</span></h3>
        <div class="mt-5">
            <div class="d-inline-block me-5">
                <img src="http://secma.test/storage/profesores/firmas/NPpyUfUDUvnqfzDG02IpukS2zZeXVRQfechWDp1b.png" alt="Firma" width="150">
                <div class="small fw-light">Santiago Brutti</div>
            </div>
            <div class="d-inline-block">
                <img src="http://secma.test/storage/empresas/logos/qg4OeVVDzjyZDq8a6Zhn8VghTFLhdnaQgLsyci4Q.png" alt="Logo Empresa" width="100">
            </div>  
        </div>
        
    </body>
</html>