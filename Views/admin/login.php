<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>SignIn Boxed | CORK - Multipurpose Bootstrap Dashboard Template </title>
    <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL; ?>Assets/admin/src/assets/img/favicon.ico" />
    <link href="<?php echo BASE_URL; ?>Assets/admin/layouts/vertical-dark-menu/css/light/loader.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL; ?>Assets/admin/layouts/vertical-dark-menu/css/dark/loader.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo BASE_URL; ?>Assets/admin/layouts/vertical-dark-menu/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>Assets/admin/src/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo BASE_URL; ?>Assets/admin/layouts/vertical-dark-menu/css/light/plugins.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL; ?>Assets/admin/src/assets/css/light/authentication/auth-boxed.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo BASE_URL; ?>Assets/admin/layouts/vertical-dark-menu/css/dark/plugins.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL; ?>Assets/admin/src/assets/css/dark/authentication/auth-boxed.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>Assets/admin/src/plugins/src/sweetalerts2/sweetalerts2.css">
    
    <link href="<?php echo BASE_URL; ?>Assets/admin/src/assets/css/light/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL; ?>Assets/admin/src/plugins/css/light/sweetalerts2/custom-sweetalert.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo BASE_URL; ?>Assets/admin/src/assets/css/dark/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL; ?>Assets/admin/src/plugins/css/dark/sweetalerts2/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
</head>

<body class="form">

    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <div class="auth-container d-flex">

        <div class="container mx-auto align-self-center">

            <div class="row">

                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
                    <div class="card mt-3 mb-3">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12 mb-3">

                                    <h2>Iniciar Sesión</h2>
                                    <p>Ingrese su correo electrónico y contraseña para iniciar sesión</p>

                                </div>
                                <form role="form" id="frm_login">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Correo Electrónico</label>
                                            <input type="email" id="email" name="email" value="bryanASXD@gmail.com" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label class="form-label">Contraseña</label>
                                            <input type="password" id="password" name="password" value="admin" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <div class="form-check form-check-primary form-check-inline">
                                                <input class="form-check-input me-3" type="checkbox" id="form-check-default">
                                                <label class="form-check-label" for="form-check-default">
                                                    Recordar sesión
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <button type="submit" class="btn btn-secondary w-100">Acceso</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-center">
                                            <p class="mb-0">¿olvidaste tu contraseña? <a href="javascript:void(0);" class="text-warning">clik aquí!</a></p>
                                        </div>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="<?php echo BASE_URL; ?>Assets/admin/src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <!-- js para admin -->
    <script>
        const base_url = '<?php echo BASE_URL; ?>';
    </script>
    <!-- <script src="<//?php echo BASE_URL; ?>Assets/js/sweetalert2.all.min.js"></script> -->
    <script src="<?php echo BASE_URL; ?>Assets/js/modulos/login.js"></script>

    <!-- BEGIN THEME GLOBAL STYLE -->
    <script src="<?php echo BASE_URL; ?>Assets/admin/src/assets/js/scrollspyNav.js"></script>
    <script src="<?php echo BASE_URL; ?>Assets/admin/src/plugins/src/sweetalerts2/sweetalerts2.min.js"></script>
    <script src="<?php echo BASE_URL; ?>Assets/admin/src/plugins/src/sweetalerts2/custom-sweetalert.js"></script>
    <!-- END THEME GLOBAL STYLE -->    
</body>

</html>