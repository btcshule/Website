        <meta charset="utf-8" />
        <title>sanyadaytoday </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="#" name="description" />
        <meta content="Cédric & Réverien" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.ico">

        <!-- App css -->
        <link href="<?= base_url() ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
        <!-- <link href="<?= base_url() ?>assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />
         Datatables css --> 
        <link href="<?= base_url() ?>assets/css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/css/vendor/buttons.bootstrap5.css" rel="stylesheet" type="text/css" />


        <!-- CDN -->

        <link  href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
        


        <!-- Hichart -->
        <script src="<?=base_url() ?>highcharts/highcharts.js"></script>
        <script src="<?=base_url() ?>highcharts/modules/exporting.js"></script>
        <script src="<?=base_url() ?>highcharts/modules/export-data.js"></script>
        <script src="<?=base_url() ?>highcharts/modules/data.js"></script> 


        <style type="text/css">
            .help-block{color: red;}
        </style>


        <style>
          /* Chrome, Safari, Edge, Opera */
          input::-webkit-outer-spin-button,
          input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>



    <script>
        
        function alert_toast_validation(title=null,message=null,icon=null)
        {
            $.toast({

                text:message,
                heading: title,
                icon: icon,
                showHideTransition: 'fade',
                allowToastClose: true,
                hideAfter: 8000,
                stack: 5,
                width:5000,
                position: 'top-right',
                textAlign: 'top',
                loader: true,
                loaderBg: '#c60055',
                    beforeShow: function () {}, // will be triggered before the toast is shown
                    afterShown: function () {}, // will be triggered after the toat has been shown
                    beforeHide: function () {}, // will be triggered before the toast gets hidden
                    afterHidden: function () {}  // will be triggered after the toast has been hidden

                })
        }
    </script>