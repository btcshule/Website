<?php include VIEWPATH . 'templates/header.php'; ?>
<style>
    .help-block {
        color: red;
    }
</style>

<body class="hold-transition layout-top-nav layout-navbar-fixed">
    <div class="wrapper">

        <!-- Navbar -->

        <?php include VIEWPATH . 'templates/navbar.php'; ?>

        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="background-image: url(<?= base_url();?>images/bgbg.jpg);">
      <!-- Content Header (Page header) -->
      <div class="content-header" style="background-color:navy">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h5 class="m-0" style="color:white;"><?= $title ?></h5>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#" style="color:white;">Sales</a></li>
                                <li class="breadcrumb-item active" style="color:white;">exit</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <br>
            <!-- /.content-header -->

            <!-- Main content -->

            <div class="container">
                <!-- <div class="row"> -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body" style="overflow-x: auto;">
                            <br>
                            <BR>
                            <div style="padding-top: 5px;" class="col-md-12">
                                <table id='mytable' class="table table-bordered table-striped table-hover table-condensed" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date&nbsp;d'action</th>
                                            <th>Numero&nbsp;Facture</th>
                                            <th>Nom&nbsp;du&nbsp;dclient</th>
                                            <th>Telephone&nbsp;du&nbsp;client</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>

                                </table>


                            </div>


                        </div>
                    </div>


                </div>

                <!-- </div> -->

            </div>
        </div>



        <?php include VIEWPATH . 'templates/footer.php'; ?>

        <script>
            var table;
            var save_method;
            $(document).ready(function() {

                var row_count = "1000000";
                table = $("#mytable").DataTable({
                    "processing": true,
                    "destroy": true,
                    "serverSide": true,
                    "oreder": [
                        [0, 'desc']
                    ],
                    "ajax": {
                        url: "<?= base_url() ?>index.php/exit/Vente_Today/vente_to_day",
                        type: "POST"
                    },
                    lengthMenu: [
                        [10, 50, 100, row_count],
                        [10, 50, 100, "All"]
                    ],
                    pageLength: 10,
                    "columnDefs": [{
                        "targets": [],
                        "orderable": false
                    }],

                    dom: 'Bfrtlip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ],
                    language: {
                        "sProcessing": "Traitement en cours...",
                        "sSearch": "Rechercher&nbsp;:",
                        "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
                        "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                        "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                        "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                        "sInfoPostFix": "",
                        "sLoadingRecords": "Chargement en cours...",
                        "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
                        "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
                        "oPaginate": {
                            "sFirst": "Premier",
                            "sPrevious": "Pr&eacute;c&eacute;dent",
                            "sNext": "Suivant",
                            "sLast": "Dernier"
                        },
                        "oAria": {
                            "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                            "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                        }
                    }

                });
            });
        </script>

        <script>
            function validate(id){
                // href="'.base_url('index.php/exit/Vente_Today/validate/'.$row->GROS_CLIENT_FACT_ID).'"
                alert(id);
            }
        </script>





</body>

</html>