<!DOCTYPE html>
<html lang="es">

<head>
<meta name="robots" content="noindex"/>
     <meta name="robots" content="nofollow"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="<?= base_url("assets/images/logosis.png")?>">
	<title> LOGIN | SIVEM</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/login.css')?>">
    	
	
</head>

<body>

<div class="container mt-2">
    <div class="mx-auto mt-5 align-items-center">
        <div class="d-flex justify-content-center">
            <img src="<?= base_url('assets/images/logosis.svg')?>" alt="Logo sivem" class="responsive">
        </div>
        <div class="col-md-6 col-lg-4 col-sm-8 mx-auto my-4">
            <form action="<?= base_url("login/validate")?>" id="loginForm" method="POST" class="p-4">
                <h3 class="text-center mb-4" >Iniciar sesion</h3>
                    <div class="col-md-12 mx-auto">
                            <div class="form-group" id="correo">
                                <label for="correo">Correo electrónico</label>
                                <input type="email" name="correo" class="form-control" id="correo" autofocus aria-describedby="emailHelp">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-md-12 mx-auto">
                        <div class="form-group" id="contrasena">
                            <label for="exampleInputPassword1">Contraseña</label>
                            <input type="password" name="contrasena" id="contrasena" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary btn-block ">Iniciar sesion</button><br>
                        <div id="alert"></div>
                    </div>
                    <div class="foot">
                            <p>© 2019. TODOS LOS DERECHOS RESERVADOS.</p>
                    </div>                 
            </form> 
        </div>            
	</div>
</div>

</body>
<script src="<?php echo base_url('assets/js/login.js')?>"></script>

</html>