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
    
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <!-- <link rel="stylesheet" href="./assets/css/style.css"> -->
    <link rel="stylesheet" href="css/styleprueba.css">
    <link rel="stylesheet" href="css/disenooptimizado.css">

</head>

<body class="g-sidenav-show  bg-gray-200">
    <div class="marca" id="marca"></div>
    <div id="loader" class="loader"></div>
    
    <main id="content" style="display: none;" class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
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

    <?php /* require_once "template/js.php"; */ ?>
    <script src="./assets/js/jscript.js"></script>
</body>

</html>