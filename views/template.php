<?php
    $contenido = isset($contenido)?$contenido:'Página en Blanco...';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="./assets/img/icons/favicon-32x32.png">
    <title>
        DREMO-ERE
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

    
    <!-- CSS Files -->

    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css'>

    <link rel="stylesheet" href="css/styleprueba.css">
    <link rel="stylesheet" href="css/disenooptimizado.css">
    <!-- es la parte de las tablas. -->
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">


</head>

<body class="g-sidenav-show  bg-gray-200">
    <div class="marca" id="marca"></div>
    <div id="loader" class="loader"></div>

    <main id="content" style="display: none;"
        class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-2 px-2">
            <!-- Navbar -->
            <div id="menu"></div>
            <!-- End Navbar -->
            <div id="home">

                <?=$contenido?>

            </div>

            <!-- Footer -->
            <div id="pie"></div>

            <?php /* require_once "template/footer.php"; */ ?>
            <footer class="footer py-4  ">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col">
                            <div class="copyright text-center text-sm text-muted">
                                © <script>
                                document.write(new Date().getFullYear())
                                </script>,

                                <a href="?" class="font-weight-bold">DREMO</a> -
                                Dirección Regional de Educación - Moquegua. <br>
                                v1.0 Proyecto Educativo Virtual
                            </div>
                        </div>

                    </div>
                </div>
            </footer>

            <!-- End Footer -->

        </div>
    </main>

    <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
    if (!window.jQuery) {
        console.log('Cargando jQuery 3.7.1 localmente...');
        document.write('<script src="./assets/js/jquery.min.js"><\/script>');
    }
    </script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    
    <script src="js/jscript.js"></script>
</body>

</html>