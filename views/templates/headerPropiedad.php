<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Proyecto Examen</title>
    <link rel="stylesheet" href="asset/css/misEstilos.css"><!--enlace al css-->
    <link rel="stylesheet" href="asset/css/normalize.css"><!--enlace al css-->
</head>
<header>
    <div class="contenedor-header">
        <header>
            <nav class="navbar">
                <div class="contenedor-navbar">
                    <div class="contenedor-logo"><!--logo, el logo presenta una imagen tipo svg y que a la vez es una enlace que te lleva
                a la vista principal-->
                        <a class="logo" href="index.php?accion=pagInicio"><img src="asset/img/logoInm.svg" alt="Logo Inmobiliaria"></a>
                    </div>
                    <div class="contenedor-link">
                        <ul class="link">
                            <li class="nav-item"><!--enlace que permite cerrar la session del usuario y destruirla-->
                                <a class="cerrarSession" href="index.php?accion=pagInicio">Cerrar Sesión</a>
                            </li>
                        </ul>
                    </div>
                </div> <!-- final contenedor-navbar-->
            </nav> <!-- final navbar-->
        </header>
    </div><!-- final contenedor header-->
</header>
<body class="body">