<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hoja Vida Patron</title>

	<link rel="canonical" href="https://keenthemes.com/metronic" />
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body>

    <section class="container my-5">
        <div class="row">
            <div class="col text-center">
                <a href="{{ route('panel.patrones.show', $patron->id) }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
                <a href="#" class="btn btn-blue"><i class="fas fa-print"></i> Imprimir PDF</a>
            </div>
        </div>
    </section>

    <section class="container my-5">
        <div class="row mt-5 d-flex justify-content-center">
            <div class="col-md-3 py-4 mx-0">
               <img src="{{ asset('media/logos/logo_color_large.png') }}" alt="logo-labsol" class="img-fluid">
            </div>
            <div class="col-md-3 mx-1 px-0 d-flex justify-content-center align-items-center bg-light">
                <span class="text-center w-100">HOJA DE VIDA DEL PATRÓN</span>
            </div>
            <div class="col-md-2 px-0 mx-1 d-flex flex-column justify-content-center align-items-center">
                <span class="text-center py-2 bg-light w-100">Código</span>
                <span class="text-center py-2 my-2 bg-light w-100">Revision</span>
                <span class="text-center py-2 bg-light w-100">Vigencia</span>
            </div>
            <div class="col-md-2 px-0 mx-1 d-flex flex-column justify-content-center align-items-center">
                <span class="text-center py-2 bg-light w-100">-</span>
                <span class="text-center py-2 my-2 bg-light w-100">-</span>
                <span class="text-center py-2 bg-light w-100">-</span>
            </div>
        </div>
    </section>

    <section class="container box">
        <div class="row mt-2">
            <div class="col-3 bg-gray py-2">
                <span>Identificación</span>
            </div>
            <div class="col-9 bg-light py-2">
                <span>{{ $patron->code }}</span>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-3 bg-gray py-2">
                <span>Descripción</span>
            </div>
            <div class="col-9 bg-light py-2">
                <span>{{ $patron->description }}</span>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-3 bg-gray py-2">
                <span>Ubicación</span>
            </div>
            <div class="col-9 bg-light py-2">
                <span>-</span>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-3 bg-gray py-2">
                <span>Marca</span>
            </div>
            <div class="col-9 bg-light py-2">
                <span>{{ $patron->brand }}</span>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-3 bg-gray py-2">
                <span>Modelo</span>
            </div>
            <div class="col-9 bg-light py-2">
                <span></span>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-3 bg-gray py-2">
                <span>Tipo</span>
            </div>
            <div class="col-9 bg-light py-2">
                <span></span>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-3 bg-gray py-2">
                <span>Nro. de Serie* </span>
            </div>
            <div class="col-9 bg-light py-2">
                <span></span>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-3 bg-gray py-2">
                <span>Manual de Usuario</span>
            </div>
            <div class="col-9 px-0 d-flex text-center align-items-stretch">
                    <div class="w-100 d-flex flex-column">
                        <span class="bg-gray mb-1 py-2">SI</span>
                        <span class="bg-gray py-2">NO</span>
                    </div>
                    <div class="w-100 d-flex flex-column">
                        <span class="bg-light mb-1 py-2">-</span>
                        <span class="bg-light py-2">-</span>
                    </div>
                    <div class="w-100 bg-gray d-flex justify-content-center align-items-center">
                        <span>Idioma del Manual*</span>
                    </div>
                    <div class="w-100 bg-light d-flex justify-content-center align-items-center">
                        <span>-</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-3 bg-gray py-2">
                <span>Magnitud de medición</span>
            </div>
            <div class="col-9 bg-light py-2">
                <span class="text-uppercase">{{ $patron->magnitude->name }}</span>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-3 bg-gray py-2">
                <span>Precisión</span>
            </div>
            <div class="col-9 bg-light py-2">
                <span></span>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-3 bg-gray py-2">
                <span>Tolerancia</span>
            </div>
            <div class="col-9 bg-light py-2">
                <span>{{ $patron->rank[0] }}</span>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-3 bg-gray py-2">
                <span>Incertidumbre</span>
            </div>
            <div class="col-9 bg-light py-2">
                <span></span>
            </div>
        </div>
    </section>

</body>
</html>
