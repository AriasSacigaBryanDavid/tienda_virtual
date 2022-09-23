<!-- sirve para encriptar password -->
<!-- <//?php echo password_hash('admin', PASSWORD_DEFAULT);
exit; ?> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL . 'Assets/login/img/apple-icon.png'; ?> ">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL . 'Assets/login/img/favicon.png'; ?> ">

    <title>
        <?php echo $data['title']; ?>
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL . 'Assets/login/css/nucleo-icons.css'; ?> ">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL . 'Assets/login/css/nucleo-svg.css'; ?> ">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL . 'Assets/login/css/nucleo-svg.css'; ?> ">
    <!-- CSS Files -->
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL . 'Assets/login/css/argon-dashboard.css?v=2.0.4'; ?> ">
</head>

<body class="">

    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Iniciar Sesión</h4>
                                    <p class="mb-0">Ingrese su correo electrónico y contraseña para iniciar sesión</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" id="frm_login">
                                        <div class="mb-3">
                                            <input type="email" id="email" name="email" value="bryanASXD@gmail.com" class="form-control form-control-lg" placeholder="Correo Electronico" aria-label="Correo">
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" id="password" name="password" value="admin" class="form-control form-control-lg" placeholder="Contraseña" aria-label="Contraseña">
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">Recordar sesión</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Acceso</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        ¿olvidaste tu contraseña?
                                        <a href="javascript:;" class="text-primary text-gradient font-weight-bold">clik aquí!</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg');
          background-size: cover;">
                                <span class="mask bg-gradient-primary opacity-6"></span>
                                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Attention is the new currency"</h4>
                                <p class="text-white position-relative">The more effortless the writing looks, the more effort the writer actually put into the process.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!--   Core JS Files   -->
    <script src="<?php echo BASE_URL; ?>Assets/login/js/core/popper.min.js"></script>
    <script src="<?php echo BASE_URL; ?>Assets/login/js/core/bootstrap.min.js"></script>
    <script src="<?php echo BASE_URL; ?>Assets/login/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="<?php echo BASE_URL; ?>Assets/login/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?php echo BASE_URL; ?>Assets/login/js/argon-dashboard.min.js?v=2.0.4"></script>
    <!-- js para admin -->
    <script>
        const base_url = '<?php echo BASE_URL; ?>';
    </script>
    <script src="<?php echo BASE_URL; ?>Assets/js/sweetalert2.all.min.js"></script>
    <script src="<?php echo BASE_URL; ?>Assets/js/modulos/login.js"></script>

</body>

</html>