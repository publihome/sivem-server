<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <script>
        const data = window.location.pathname;
        let i = data.lastIndexOf("/");
        let f = data.length;
        let title = data.substring(i+1,f).toUpperCase();

        window.document.title = title + " | SIVEM";
        // console.log(title)
    </script>
     <meta name="robots" content="noindex"/>
     <meta name="robots" content="nofollow"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espectaculares | SIVEM</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="icon" href="<?= base_url("assets/images/logosis.png")?>">
    <link rel="stylesheet" href="<?= base_url('assets/select2/dist/css/select2.min.css')?>">
    <!-- jQuery and JS bundle w/ Popper.js -->

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/select2/dist/js/select2.min.js')?>"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/template.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dropify/dist/css/dropify.css')?>">
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dropify/dist/fonts.css')?>"> -->


    <!--------------------------------------- D A T A  T A B L E S ------------------------------------->

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!------------------------------------- O W L  C A R R U S S E L------------------------------------------- -->
    <link rel="stylesheet" href="<?= base_url('assets/OwlCarousel/dist/assets/owl.carousel.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/OwlCarousel/dist/assets/owl.theme.default.css')?>">
    <script src="<?= base_url('assets/OwlCarousel/dist/owl.carousel.min.js')?>"></script>

    <!-------------------------------------------------------- A L E R T I F Y ------------------------------------------- -->

    <link rel="stylesheet" href="<?= base_url('assets/AlertifyJS/build/css/alertify.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/AlertifyJS/build/css/themes/default.min.css')?>">
    <script src="<?= base_url('assets/AlertifyJS/build/alertify.min.js')?>"></script>


    <!-------------------------------------------------------- F O N T A W E S O M E ------------------------------------------- -->

    <script src="https://kit.fontawesome.com/03e7806b0f.js" crossorigin="anonymous"></script>

</head>
<body>