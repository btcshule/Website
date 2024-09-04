<!DOCTYPE html>
<html lang="en">

<head>
    <?php include VIEWPATH . 'includes/head.php'; ?>

</head>


<body class="show" data-layout-config="{&quot;leftSideBarTheme&quot;:&quot;dark&quot;,&quot;layoutBoxed&quot;:false, &quot;leftSidebarCondensed&quot;:false, &quot;leftSidebarScrollable&quot;:false,&quot;darkMode&quot;:false, &quot;showRightSidebarOnStart&quot;: true}" data-leftbar-theme="dark" style="visibility: visible;">
    <!-- Begin page -->
    <div class="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        <?php include VIEWPATH . 'includes/menu.php'; ?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <!-- Topbar Start -->
                <?php include VIEWPATH . 'includes/topbar.php'; ?>
                <!-- end Topbar -->

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <!-- <?=$breadcrumbs?> -->
                                </div>
                                <h4 class="page-title"><?=$page_title?></h4>
                            </div>
                        </div>
                    </div>  
                </div>




                <!-- Inline Form -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">

                                <!-- <?php 
                                if ($this->session->userdata('NOUVEAU')==1 && ($this->session->userdata('PROFILE_CODE')=='GESTIONNAIRE' || $this->session->userdata('PROFILE_CODE')=='ADMIN' || $this->session->userdata('PROFILE_CODE')=='DIRECTION')) {?> -->
                                    <div class="row mb-2">
                                    <div class="col-sm-5">
                                        <a href="javascript:void(0);" onclick="new_serv()" class="btn btn-primary mb-2"><i class="mdi mdi-plus-circle me-2"></i> Nouveau</a>
                                    </div>
                                    
                                </div>
                                <!-- <?php 
                                }
                                 ?> -->

                               





                                <table id="mytable" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            
                                            <th>Service</th>
                                            <?php 
                                            // if ($this->session->userdata('OPTIONS')==1) 
                                            // {
                                                echo "<th>Options</th>";
                                            // }
                                             ?>
                                        </tr>
                                    </thead>
                                </table>

                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- container -->

        </div> <!-- content -->

       

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->


<div class="rightbar-overlay"></div>
<!-- /End-bar -->


<!-- bundle -->
<?php include VIEWPATH . 'includes/foot.php'; ?>

</body>

</html>




<script>
  var save_method;
  var table;

  
  
  $(document).ready(function() {

   var row_count ="1000000";   
   table=$("#mytable").DataTable({
    "processing":true,
    "serverSide":true,
    "order":[],
    "ajax":{
      url:"<?php echo base_url('index.php/saisie/Services/liste')?>",
      type:"POST"
  },
  lengthMenu: [[10,50, 100, row_count], [10,50, 100, "All"]],
  pageLength: 10,
  "columnDefs": [
  { 
      "targets": [ 0 ],
      "orderable": false,
  },
  { 
      "targets": [ -1 ], 
      "orderable": false, 
  },
  ]

  ,

  dom: 'Bfrtlip',
  buttons: [
  'copyHtml5',
  'excelHtml5',
  'csvHtml5',
  'pdfHtml5'
  ],
  language: {
      "sProcessing":     "Traitement en cours...",
      "sSearch":         "Rechercher&nbsp;:",
      "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
      "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
      "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
      "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
      "sInfoPostFix":    "",
      "sLoadingRecords": "Chargement en cours...",
      "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
      "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
      "oPaginate": {
        "sFirst":      "Premier",
        "sPrevious":   "Pr&eacute;c&eacute;dent",
        "sNext":       "Suivant",
        "sLast":       "Dernier"
    },
    "oAria": {
        "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
        "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
    }
}

});


   $("input").change(function(){
    $(this).parent().parent().removeClass('has-error');
    $(this).next().empty();
});

   


});


</script>
<script>

    function new_serv(){

        save_method = 'add';
        $('#frms')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty(); 
        $('#famille-modal').modal('show');
        $('#btnSave').text('Enregistrer');
        $('#btnSave').attr("disabled",false);
        $('.modal-title').text('Service');
    }



    function enr()
    {

       $('#btnSave').html('<button class="btn btn-info" type="button" disabled><span class="spinner-grow spinner-grow-sm me-1" role="status" aria-hidden="true"></span>Chargement...</button>');
       $('#btnSave').attr("disabled",true);

       var url;

       if (save_method=="add") 
       {
        url="<?php echo base_url('index.php/saisie/Services/add')?>";
    }
    else
    {
        url="<?php echo base_url('index.php/saisie/Services/update')?>";
    }

    var formData = new FormData($('#frms')[0]);

    $.ajax({

        url:url,
        type:"POST",
        data:formData,
        contentType:false,
        processData:false,
        dataType:"JSON",
        success: function(data)
        {
           if(data.status) 
           {
            $('#service-modal').modal('hide');
            table.ajax.reload(null,false);
        }
        else
        {
            for (var i = 0; i < data.inputerror.length; i++) 
            {
                $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
            }
        }

        $('#btnSave').text('Enregistrer');
        $('#btnSave').attr('disabled',false); 


    },
    error: function (jqXHR, textStatus, errorThrown)
    {
      alert('Erreur s\'est produite');
      $('#btnSave').text('Enregistrer');
      $('#btnSave').attr('disabled',false);

  }


});



}




function edit_famille(id)
{
  save_method = 'update';
  $('#frms')[0].reset();
  $.ajax({
    url : "<?php echo site_url('saisie/Services/getOne')?>/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

      $('[name="SERVICE_ID"]').val(data.SERVICE_ID);
      $('[name="NOM_SERVICE"]').val(data.NOM_SERVICE);
      $('#service-modal').modal('show'); 
      $('.modal-title').text('Modifier un service'); 
      $('#btnSave').text('Modifier');


  },
  error: function (jqXHR, textStatus, errorThrown)
  {
      alert('Erreur lors de la modification');
  }
});
}


function delete_service(id)
{
 if (confirm('Voulez-vous supprimez cet élément ?')) {
  $.ajax({
    url : "<?php echo base_url('index.php/saisie/Services/del')?>/"+id,
    type: "POST",
    dataType: "JSON",
    success: function(data)
    {
        table.ajax.reload(null,false);

    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        alert('Erreur lors de la suppression');
    }
}); 
}





}





</script>







<div id="service-modal" class="modal fade" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-info">
                <h4 class="modal-title" id="info-header-modalLabel">Modal Heading</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <form id="frms" method="POST">
                            <div class="form-body">
                                <input type="hidden" name="SERVICE_ID" id="SERVICE_ID">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label class="form-label">Description <span style="color: red;">*</span></label>
                                                <input type='text' autocomplete="off" autofocus class="form-control" data-provide="typeahead" id="NOM_SERVICE" name="NOM_SERVICE">

                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button> -->
                    <button type="button" id="btnSave" onclick="enr()" class="btn btn-info">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>





































