<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for table -->
    <link href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>vendor/datatables/jquery.data.Tables.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/sweetalert2.min.css'); ?>" rel="stylesheet">
    <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/cleave/cleave.js'); ?>"></script>
    <style>
        #load {
            width: 100%;
            height: 100%;
            position: fixed;
            text-indent: 100%;
            background: #e0e0e0 url('./assets/img/loading.gif') no-repeat center;
            z-index: 1;
            opacity: 0.4;
            background-size: 8%;
        }
    </style>
</head>

<div id="load"></div>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">