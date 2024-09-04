<?php
  ini_set('max_execution_time', 0);
  ini_set('memory_limit','12048M');
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Fait par @Advaxe designs.bi
 * le 12/01/2024
 */
class Dashboard extends CI_Controller
{
  
  function __construct()
  {
    # code...
    parent::__construct();    
        $this->load->helper('form');    
        $this->load->library('table');   
        $this->load->library('form_validation');   
        $this->load->model('Model');
  }

  public function index(){
      $data['page_title']="Gestionnaire des statistiques";
    $data['breadcrumbs'] = '<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light-lighten p-2 mb-0">
    <li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Accueil</a></li>
    <li class="breadcrumb-item"><a href="#">Rapport</a></li>
    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
    </nav>';

      $filtre = array(
      '1' =>'CENTRALE',
      '2'=>'SOUS TUTELLE'
    );

    $data['filtre'] = $filtre;

        $this->load->view('Dashboard_view',$data);
       }

    public function get_rapport(){ 

      $filtre=$this->input->post('FILTRE');

      if ($filtre==1) {
        # code...
      $total=2037;
      $nbre_fonctionnaire="{name:'Nombre fx 1405(dont 21 sans salaire dans CTI)->(416 913 738 FBU/Mois)', y:1405,key:1},{name:'Nombre de CTI 127->(39 551 985 FBU/Mois)', y:127,key:2},{name:'Nombre de fonctionnaires au niveau central mal affecté dans les institutions mais présents dans les fichiers 480(dont 3 sans salaire dans CTI)->(150 967 964 FBU/Mois)', y:480,key:3}, {name:'Nombre de fonctionnaires au niveau central sans matricules avec correspondance(sur base du n°CNI) dans les fichiers de paie(actifs et inactifs) 25(dont 22 sans salaire dans CTI)->(1 302 470 FBU/Mois)', y:25,key:3},";
    } else if ($filtre==2) {
      # code...
      $total=285;
      $nbre_fonctionnaire="{name:'Nombre de fonctionnaires déclarés actifs dans les fichiers de paie sans correspondance sur le terrain 98->(49 016 473 FBU/Mois)', y:98,key:1},{name:'Nombre de fonctionnaires du MENRS absents lors du recensement mais présents dans les fichiers de paie 63->(45 201 997 FBU/Mois)', y:63,key:2}, {name:'Nombre de fonctionnaires sans matricules avec correspondance dans les fichiers de paie 124, ce ne sont pas des fictifs car le CFPP ne donne pas de matricule', y:124,key:4},";
    }else{
    $stock=$this->Model->getRequeteOne("SELECT COUNT(PRODUCT_ID) AS produits FROM `products` WHERE 1");
    $dachats=$this->Model->getRequeteOne('SELECT SUM(TOTAL_ACHAT) AS somme FROM `gros_entrees_stock` WHERE  YEAR(`DATE_INSERTION`) ='.$filtre); 

   $Emax = $this->Model->getRequeteOne("SELECT MAX(ID_SUIVI_EBANK) AS MAXIMUM FROM suivi_ebank");

    if (is_array($Emax) && isset($Emax['MAXIMUM'])) {
      $idmax = $Emax['MAXIMUM'];
      $solde = $this->Model->getRequeteOne("SELECT ELECTRONIQUE FROM suivi_ebank WHERE ID_SUIVI_EBANK=".$idmax);
    } else {
      $solde = array('ELECTRONIQUE' => 0);
    }
    $soldee = $solde;
    
    // print_r($data['soldee']);die();
     $smax = $this->Model->getRequeteOne("SELECT MAX(ID_SUIVI_EBANK) AS MAXIMUM FROM suivi_ebank");
    if (is_array($smax) && isset($smax['MAXIMUM'])) {
      $idmax = $smax['MAXIMUM'];
      $soldes = $this->Model->getRequeteOne("SELECT CASH FROM suivi_ebank WHERE ID_SUIVI_EBANK=".$idmax);
    } else {
      $soldes = array('CASH' => 0);
    }
    $soldes = $soldes;
     
      $x=$filtre; //2024
      $xx=$x-1; //2023
    $cs1_max = $this->Model->getRequeteOne("SELECT MAX(ID_LIVRE_CAISSE) AS MAXIMUM FROM data_livre_caisse WHERE YEAR(`DATE_ENTREE`)=".$xx);
    if (is_array($cs1_max) && isset($cs1_max['MAXIMUM'])) {
      $idmax = $cs1_max['MAXIMUM'];
      $caisse = $this->Model->getRequeteOne("SELECT SOLDE FROM data_livre_caisse WHERE ID_LIVRE_CAISSE=".$idmax);
    } else {
      $caisse = array('SOLDE' => 0);
    }
    $caisse_old = $caisse;//154800

    $cs_max = $this->Model->getRequeteOne("SELECT MAX(ID_LIVRE_CAISSE) AS MAXIMUM FROM data_livre_caisse WHERE YEAR(`DATE_ENTREE`)=".$x);
    if (is_array($cs_max) && isset($cs_max['MAXIMUM'])) {
      $idmax = $cs_max['MAXIMUM'];
      $caisse_1 = $this->Model->getRequeteOne("SELECT SOLDE FROM data_livre_caisse WHERE ID_LIVRE_CAISSE=".$idmax);
    } else{
      $caisse_1 = array('SOLDE' => 0);
    }
    //caisse=2023
$caisse_new = $caisse_1; //0

if ($caisse_new['SOLDE']==0) 
{
  $ventes=$caisse_old;
}else
{
  $ventes=$caisse_new;
}

    // print_r($ventes);die();

$bq_max = $this->Model->getRequeteOne("SELECT MAX(ID_LIVRE_BANQUE) AS MAXIMUM FROM data_livre_banque WHERE YEAR(`DATE_ENTREE`)=".$x);
if (is_array($bq_max) && isset($bq_max['MAXIMUM'])) {
  $idmax = $bq_max['MAXIMUM'];
  $banque1 = $this->Model->getRequeteOne("SELECT SOLDE FROM data_livre_banque WHERE ID_LIVRE_BANQUE=".$idmax);
} else {
  $banque1 = array('SOLDE' => 0);
}
$banque1 = $banque1;

$bq_max1 = $this->Model->getRequeteOne("SELECT MAX(ID_LIVRE_BANQUE) AS MAXIMUM FROM data_livre_banque WHERE YEAR(`DATE_ENTREE`)=".$xx);
if (is_array($bq_max1) && isset($bq_max1['MAXIMUM'])) {
  $idmax1 = $bq_max1['MAXIMUM'];
  $banque2 = $this->Model->getRequeteOne("SELECT SOLDE FROM data_livre_banque WHERE ID_LIVRE_BANQUE=".$idmax1);
} else {
  $banque2 = array('SOLDE' => 0);
}
$banque2 = $banque2;

if ($banque1['SOLDE'] == 0) {
  $banque = $banque2;
} else {
  $banque = $banque1;
}



$app_max = $this->Model->getRequeteOne("SELECT MAX(ID_LIVRE_APPRO) AS MAXIMUM FROM data_livre_approvisionnement WHERE YEAR(`DATE_ENTREE`)=".$x);
if (is_array($app_max) && isset($app_max['MAXIMUM'])) {
  $idmax = $app_max['MAXIMUM'];
  $appro1 = $this->Model->getRequeteOne("SELECT SOLDE FROM data_livre_approvisionnement WHERE ID_LIVRE_APPRO=".$idmax);
} else {
  $appro1 = array('SOLDE' => 0);
}
$appro1 = $appro1;

$app_max2 = $this->Model->getRequeteOne("SELECT MAX(ID_LIVRE_APPRO) AS MAXIMUM FROM data_livre_approvisionnement WHERE YEAR(`DATE_ENTREE`)=".$xx);
if (is_array($app_max2) && isset($app_max2['MAXIMUM'])) {
  $idmax1 = $app_max2['MAXIMUM'];
  $appro2 = $this->Model->getRequeteOne("SELECT SOLDE FROM data_livre_approvisionnement WHERE ID_LIVRE_APPRO=".$idmax1);
} else {
  $appro2 = array('SOLDE' => 0);
}
$appro2 = $appro2;

if ($appro1['SOLDE'] == 0) {
  $appro = $appro2;
} else {
  $appro = $appro1;
}

     $dettes=$this->Model->getRequeteOne('SELECT SUM(MONTANT) AS somme2 FROM `dettes_internes`  WHERE YEAR(`DATE_DETTE`) ='.$filtre);
    //$dettes=$this->Model->getRequeteOne('SELECT SUM(MONTANT) AS somme2 FROM `dettes_internes` WHERE 1 ');
    $creances=$this->Model->getRequeteOne('SELECT SUM(MONTANT) AS creance FROM `dettes_externes` WHERE YEAR(`DATE_DETTE`) ='.$filtre); 
    // $creances=$this->Model->getRequeteOne("SELECT SUM(MONTANT) AS creance FROM `dettes_externes` WHERE 1"); 
    $clients=$this->Model->getRequeteOne('SELECT COUNT(GROS_CLIENT_ID) AS somme4 FROM `gros_client` WHERE YEAR(`DATE_INSERTION`) ='.$filtre);
    $frss=$this->Model->getRequeteOne('SELECT COUNT(ID_FOURNISSEUR) AS frss FROM `fournisseurs_sanya` WHERE YEAR(`DATE_INSERTION`) ='.$filtre);

    $services=$this->Model->getRequeteOne('SELECT SUM(NET_PAID) AS somme3 FROM `mag_ventes_services` WHERE  YEAR(`DATE_CREATION`) ='.$filtre);
    $produits_achetes=$this->Model->getRequeteOne('SELECT SUM(TOTAL_ACHAT) AS stocks FROM `gros_entrees_stock` WHERE  YEAR(`DATE_INSERTION`) ='.$filtre);
    $produits_vendus=$this->Model->getRequeteOne('SELECT SUM(PRIX_TOTAL) AS ventes FROM `mag_ventes_produits` WHERE  YEAR(`DATE_ACTION`) ='.$filtre); 
    $consommables=$this->Model->getRequeteOne('SELECT SUM(`PC`) AS CONSOMMABLES FROM `services` WHERE  YEAR(`DATE_CREATION`) ='.$filtre); 
    $stock_dispo=$produits_achetes['stocks']-$produits_vendus['ventes']-$consommables['CONSOMMABLES'];
    $total_vente=$services['somme3']+$produits_vendus['ventes'];
    $total_serv=$services['somme3'];
       $nbre_fonctionnaire="
        {name:'Cash disponibles :".number_format($soldes['CASH'],0,',',' ')."', y:".$soldes['CASH'].",key:1},
        {name:'Electroniques  disponibles : ".number_format($soldee['ELECTRONIQUE'],0,',',' ')."', y:".$soldee['ELECTRONIQUE'].",key:1},
        {name:'Caisse ventes :".number_format($ventes['SOLDE'],0,',',' ')."', y:".$ventes['SOLDE'].",key:1},
        {name:'Caisse Banque :".number_format($banque['SOLDE'],0,',',' ')."', y:".$banque['SOLDE'].",key:1},
        {name:'Caisse Approvisionnement :".number_format($appro['SOLDE'],0,',',' ')."', y:".$appro['SOLDE'].",key:1},
        {name:'Dettes :".number_format($dettes['somme2'],0,',',' ')."', y:".$dettes['somme2'].",key:1},
        {name:'Créances :".number_format($creances['creance'],0,',',' ')."', y:".$creances['creance'].",key:1},
        {name:'Produit en stock :".number_format($stock['produits'],0,',',' ')."', y:".$stock['produits'].",key:1},
        {name:'Produit vendus :".number_format($produits_vendus['ventes'],0,',',' ')."', y:".$produits_vendus['ventes'].",key:1},
        {name:'Services vendus :".number_format($services['somme3'],0,',',' ')."', y:".$services['somme3'].",key:1},
        ";
    }


$vt=$ventes['SOLDE'];
$bq=$banque['SOLDE'];
$app=$appro['SOLDE'];
$caisse='';
$banque='';
$appro='';
$caisse.="{name:'Caisse', y:".$vt.",key:1,color:'#370bf7'},";
$banque.="{name:'Banque', y:".$bq.",key:2,color:'#ea3a91'},";
$appro.="{name:'Approvisionnement', y:".$app.",key:3,color:'#0bf3e5'},";

$cash='';
$electro='';

$cash.="{name:'Cash : ".number_format($soldes['CASH'],0,',',' ')."', y:".$soldes['CASH'].",key:4,color:'#00008B'},";

$electro.="{name:'Electronique : ".number_format($soldee['ELECTRONIQUE'],0,',',' ')."', y:".$soldee['ELECTRONIQUE'].",key:5,color:'#818181'},";

$produits='';
$services='';

// $montap = ($cti_paye['monta']>0) ? $cti_paye['monta'] : 0 ;
$produits="{name:'Produits : (".number_format($produits_vendus['ventes'],0,'',' ')." FBU ) ',y:".$produits_vendus['ventes'].",key:90,color:'#42f70b'},";

$services.="{name:'Services : (".number_format($total_serv,0,',',' ')." FBU)', y:".$total_serv.",key:7,color:'#f77a0b'},";

    $rapp="<script type=\"text/javascript\">
    Highcharts.chart('container', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: '<b>Dashboard Général (Provisoire) </b><br>',
        align: 'center'
    },
    subtitle: {
        text: '',
        align: 'left'
    },
    accessibility: {
        point: {
            valueSuffix: ''
        }
    },
    tooltip: {
        pointFormat: '{series.name}: </b>'
    },
    plotOptions: {
    pie: {
        allowPointSelect: true,
        cursor: 'pointer',
        depth: 35,
        point:{
            events: {
               click: function(){
        $(\"#id\").html(\"Montant\");
        $(\"#titre\").html(\"Détails\");   
        $(\"#myModal1\").modal();
        var row_count ='1000000';
        $(\"#mytable\").DataTable({
        \"processing\":true,
        \"serverSide\":true,
        \"bDestroy\": true,
        \"oreder\":[],
        \"ajax\":{
        url:\"".base_url('rapport/Dashboard/detail')."\",
        type:\"POST\",
        data:{
          key:this.key,

        }
      },
      lengthMenu: [[10,50, 100, row_count], [10,50, 100, \"All\"]],
      pageLength: 10,
      \"columnDefs\":[{
      \"targets\":[],
      \"orderable\":false
      }],
      dom: 'Bfrtlip',
      buttons: [
      'excel', 'print','pdf'
      ],
      language: {
        \"sProcessing\":     \"Traitement en cours...\",
        \"sSearch\":         \"Rechercher&nbsp;:\",
        \"sLengthMenu\":     \"Afficher _MENU_ &eacute;l&eacute;ments\",
        \"sInfo\":           \"Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments\",
        \"sInfoEmpty\":      \"Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment\",
        \"sInfoFiltered\":   \"(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)\",
         \"sInfoPostFix\":    \"\",
        \"sLoadingRecords\": \"Chargement en cours...\",
        \"sZeroRecords\":    \"Aucun &eacute;l&eacute;ment &agrave; afficher\",
        \"sEmptyTable\":     \"Aucune donn&eacute;e disponible dans le tableau\",
        \"oPaginate\": {
        \"sFirst\":      \"Premier\",
        \"sPrevious\":   \"Pr&eacute;c&eacute;dent\",
        \"sNext\":       \"Suivant\",
        \"sLast\":       \"Dernier\"
        },
         \"oAria\": {
        \"sSortAscending\":  \": activer pour trier la colonne par ordre croissant\",
         \"sSortDescending\": \": activer pour trier la colonne par ordre d&eacute;croissant\"
        }
      }
                                    
      });

      }
     }
   },
    dataLabels: {
        enabled: true,
        format: '{point.name}'
    }
}
},
credits: {
  enabled: true,
  href: \"\",
  text: \"Advaxe designs\"
},
series: [
{
   type: 'pie', 
    name: '',
    data: [".$nbre_fonctionnaire."],
    }]
});
</script>
";
$rapp1="<script type=\"text/javascript\">
Highcharts.chart('container1', {

    chart: {
        type: 'column'
    },
    title: {
       text: '<b>Rapport comparatif des caisses </b><br>',
        align: 'center'
    },
    subtitle: {
        text:
            '',
        align: 'center'
    },
    xAxis: {
        type: 'category',
        crosshair: true,
        accessibility: {
            description: 'Countries'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: ''
        }
    },
    tooltip: {
        valueSuffix: ' '
    },
    plotOptions: {
column: {
pointPadding: 0.2,
borderWidth: 0,
depth: 40,
cursor:'pointer',
point:{
events: {
click: function(){
$(\"#idfin\").html(\"Date&nbspnaissance&nbspcollectée\");
$(\"#titre1\").html(\"Détails\");   
$(\"#myModal1\").modal();
var row_count ='1000000';
$(\"#mytable1\").DataTable({
\"processing\":true,
\"serverSide\":true,
\"bDestroy\": true,
\"oreder\":[],
\"ajax\":{
url:\"".base_url('rapport/Dashboard_Fictif/detail_cti')."\",
type:\"POST\",
data:{
key:this.key,

}
},
lengthMenu: [[10,50, 100, row_count], [10,50, 100, \"All\"]],
pageLength: 10,
\"columnDefs\":[{
\"targets\":[],
\"orderable\":false
}],
dom: 'Bfrtlip',
buttons: [
'excel', 'print','pdf'
],
language: {
\"sProcessing\":     \"Traitement en cours...\",
\"sSearch\":         \"Rechercher&nbsp;:\",
\"sLengthMenu\":     \"Afficher _MENU_ &eacute;l&eacute;ments\",
\"sInfo\":           \"Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments\",
\"sInfoEmpty\":      \"Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment\",
\"sInfoFiltered\":   \"(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)\",
 \"sInfoPostFix\":    \"\",
\"sLoadingRecords\": \"Chargement en cours...\",
\"sZeroRecords\":    \"Aucun &eacute;l&eacute;ment &agrave; afficher\",
\"sEmptyTable\":     \"Aucune donn&eacute;e disponible dans le tableau\",
\"oPaginate\": {
\"sFirst\":      \"Premier\",
\"sPrevious\":   \"Pr&eacute;c&eacute;dent\",
\"sNext\":       \"Suivant\",
\"sLast\":       \"Dernier\"
},
 \"oAria\": {
\"sSortAscending\":  \": activer pour trier la colonne par ordre croissant\",
 \"sSortDescending\": \": activer pour trier la colonne par ordre d&eacute;croissant\"
}
}
                              
});

                   }
               }
           },
dataLabels: {
enabled: true,
format: '{point.y:,f} '
},
showInLegend: false
}
}, 
credits: {
enabled: true,
href: \"\",
text: \"Advaxe designs\"
},

    series: [
        {
            name: 'Disponible ',
            color:'#FFC0CB',
           data: [".$caisse.$banque.$appro."],
        }
    ]
});
</script>";
$rapp2="<script type=\"text/javascript\">
Highcharts.chart('container2', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: '<b>Situation E-banking  </b>',
        align: 'center'
    },
    subtitle: {
        text: '',
        align: 'left'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
                        point:{
                            events: {
                               click: function(){
$(\"#idfin\").html(\"Montant\");
$(\"#titre1\").html(\"Détails\");   
$(\"#myModal1\").modal();
var row_count ='1000000';
$(\"#mytable1\").DataTable({
\"processing\":true,
\"serverSide\":true,
\"bDestroy\": true,
\"oreder\":[],
\"ajax\":{
url:\"".base_url('rapport/Dashboard_Fictif/detail_cti')."\",
type:\"POST\",
data:{
key:this.key,

}
},
lengthMenu: [[10,50, 100, row_count], [10,50, 100, \"All\"]],
pageLength: 10,
\"columnDefs\":[{
\"targets\":[],
\"orderable\":false
}],
dom: 'Bfrtlip',
buttons: [
'excel', 'print','pdf'
],
language: {
\"sProcessing\":     \"Traitement en cours...\",
\"sSearch\":         \"Rechercher&nbsp;:\",
\"sLengthMenu\":     \"Afficher _MENU_ &eacute;l&eacute;ments\",
\"sInfo\":           \"Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments\",
\"sInfoEmpty\":      \"Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment\",
\"sInfoFiltered\":   \"(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)\",
 \"sInfoPostFix\":    \"\",
\"sLoadingRecords\": \"Chargement en cours...\",
\"sZeroRecords\":    \"Aucun &eacute;l&eacute;ment &agrave; afficher\",
\"sEmptyTable\":     \"Aucune donn&eacute;e disponible dans le tableau\",
\"oPaginate\": {
\"sFirst\":      \"Premier\",
\"sPrevious\":   \"Pr&eacute;c&eacute;dent\",
\"sNext\":       \"Suivant\",
\"sLast\":       \"Dernier\"
},
 \"oAria\": {
\"sSortAscending\":  \": activer pour trier la colonne par ordre croissant\",
 \"sSortDescending\": \": activer pour trier la colonne par ordre d&eacute;croissant\"
}
}
                              
});

                   }
               }
           },
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
    credits: {
  enabled: true,
  href: \"\",
  text: \"Advaxe designs\"
},
    series: [
{
   type: 'pie',
    name: 'Share',
    data: [".$electro.$cash."],
    }]
});
</script>
";

$rapp3="<script type=\"text/javascript\">
    Highcharts.chart('container3', {
    chart: {
        type: 'pie'
    },

    legend: {
        symbolWidth: 40
    },

    title: {
        text: '<b>Rapport comparé Produits vs Services </b><br>'
    },

    subtitle: {
        text: ''
    },

    yAxis: {
        title: {
            text: ' '
        },
        accessibility: {
            description: ''
        }
    },

    xAxis: {
        title: {
            text: ''
        },
        accessibility: {
            description: ''
        },
                        type: 'category'

                    },

   tooltip: {
        pointFormat: '{series.name}: <b>{series.y:.0f}</b>'
    },

    plotOptions: {
        pie: {
       cursor:'pointer',
                  point:{
                    events: {
click: function(){
  if(this.key2==1){
$(\"#titreed\").html(\"Liste des fonctionnaires\");   
$(\"#myModaled\").modal();
var row_count ='1000000';
$(\"#mytableed\").DataTable({
\"processing\":true,
\"serverSide\":true,
\"bDestroy\": true,
\"oreder\":[],
\"ajax\":{
url:\"".base_url('rapport/Dashboard_Fictif/detail_cti1')."\",
type:\"POST\",
data:{
key:this.key,
key2:this.key2,

}
},
lengthMenu: [[10,50, 100, row_count], [10,50, 100, \"All\"]],
pageLength: 10,
\"columnDefs\":[{
\"targets\":[],
\"orderable\":false
}],
dom: 'Bfrtlip',
buttons: [
'excel', 'print','pdf'
],
language: {
\"sProcessing\":     \"Traitement en cours...\",
\"sSearch\":         \"Rechercher&nbsp;:\",
\"sLengthMenu\":     \"Afficher _MENU_ &eacute;l&eacute;ments\",
\"sInfo\":           \"Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments\",
\"sInfoEmpty\":      \"Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment\",
\"sInfoFiltered\":   \"(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)\",
 \"sInfoPostFix\":    \"\",
\"sLoadingRecords\": \"Chargement en cours...\",
\"sZeroRecords\":    \"Aucun &eacute;l&eacute;ment &agrave; afficher\",
\"sEmptyTable\":     \"Aucune donn&eacute;e disponible dans le tableau\",
\"oPaginate\": {
\"sFirst\":      \"Premier\",
\"sPrevious\":   \"Pr&eacute;c&eacute;dent\",
\"sNext\":       \"Suivant\",
\"sLast\":       \"Dernier\"
},
 \"oAria\": {
\"sSortAscending\":  \": activer pour trier la colonne par ordre croissant\",
 \"sSortDescending\": \": activer pour trier la colonne par ordre d&eacute;croissant\"
}
}
                              
});
  }else if(this.key2==3){
$(\"#titreub\").html(\"Liste des fonctionnaires\");   
$(\"#myModalub\").modal();
var row_count ='1000000';
$(\"#mytableub\").DataTable({
\"processing\":true,
\"serverSide\":true,
\"bDestroy\": true,
\"oreder\":[],
\"ajax\":{
url:\"".base_url('rapport/Dashboard_Fictif/detail_cti1')."\",
type:\"POST\",
data:{
key:this.key,
key2:this.key2,

}
},
lengthMenu: [[10,50, 100, row_count], [10,50, 100, \"All\"]],
pageLength: 10,
\"columnDefs\":[{
\"targets\":[],
\"orderable\":false
}],
dom: 'Bfrtlip',
buttons: [
'excel', 'print','pdf'
],
language: {
\"sProcessing\":     \"Traitement en cours...\",
\"sSearch\":         \"Rechercher&nbsp;:\",
\"sLengthMenu\":     \"Afficher _MENU_ &eacute;l&eacute;ments\",
\"sInfo\":           \"Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments\",
\"sInfoEmpty\":      \"Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment\",
\"sInfoFiltered\":   \"(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)\",
 \"sInfoPostFix\":    \"\",
\"sLoadingRecords\": \"Chargement en cours...\",
\"sZeroRecords\":    \"Aucun &eacute;l&eacute;ment &agrave; afficher\",
\"sEmptyTable\":     \"Aucune donn&eacute;e disponible dans le tableau\",
\"oPaginate\": {
\"sFirst\":      \"Premier\",
\"sPrevious\":   \"Pr&eacute;c&eacute;dent\",
\"sNext\":       \"Suivant\",
\"sLast\":       \"Dernier\"
},
 \"oAria\": {
\"sSortAscending\":  \": activer pour trier la colonne par ordre croissant\",
 \"sSortDescending\": \": activer pour trier la colonne par ordre d&eacute;croissant\"
}
}
                              
});
  }else{
$(\"#titre\").html(\"Liste des fonctionnaires\");   
$(\"#myModal\").modal();
var row_count ='1000000';
$(\"#mytable\").DataTable({
\"processing\":true,
\"serverSide\":true,
\"bDestroy\": true,
\"oreder\":[],
\"ajax\":{
url:\"".base_url('rapport/Dashboard_Fictif/detail_cti')."\",
type:\"POST\",
data:{
key:this.key,

}
},
lengthMenu: [[10,50, 100, row_count], [10,50, 100, \"All\"]],
pageLength: 10,
\"columnDefs\":[{
\"targets\":[],
\"orderable\":false
}],
dom: 'Bfrtlip',
buttons: [
'excel', 'print','pdf'
],
language: {
\"sProcessing\":     \"Traitement en cours...\",
\"sSearch\":         \"Rechercher&nbsp;:\",
\"sLengthMenu\":     \"Afficher _MENU_ &eacute;l&eacute;ments\",
\"sInfo\":           \"Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments\",
\"sInfoEmpty\":      \"Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment\",
\"sInfoFiltered\":   \"(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)\",
 \"sInfoPostFix\":    \"\",
\"sLoadingRecords\": \"Chargement en cours...\",
\"sZeroRecords\":    \"Aucun &eacute;l&eacute;ment &agrave; afficher\",
\"sEmptyTable\":     \"Aucune donn&eacute;e disponible dans le tableau\",
\"oPaginate\": {
\"sFirst\":      \"Premier\",
\"sPrevious\":   \"Pr&eacute;c&eacute;dent\",
\"sNext\":       \"Suivant\",
\"sLast\":       \"Dernier\"
},
 \"oAria\": {
\"sSortAscending\":  \": activer pour trier la colonne par ordre croissant\",
 \"sSortDescending\": \": activer pour trier la colonne par ordre d&eacute;croissant\"
}
}
                              
});
    }             
  }
               }
           },
          dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>',
                          connectorColor: 'silver'
             },
            showInLegend: false
        }
    }, 
 credits: {
              enabled: true,
              href: \"\",
              text: \"Advaxe designs\"
      },

series: [

 {    name: 'Produits vs Services',
   data: [".$produits.$services."],
    color: \"green\"
 },

],
 
    responsive: {
        rules: [{
            condition: {
                maxWidth: 550
            },
            chartOptions: {
                chart: {
                    spacingLeft: 3,
                    spacingRight: 3
                },
                legend: {
                    itemWidth: 150
                },
                xAxis: {
                    type: 'category',
                    title: ''
                },
                yAxis: {
                    visible: false
                }
            }
        }]
    }
});
</script>
";

 echo json_encode(array('rapp'=>$rapp,'rapp1'=>$rapp1,'rapp2'=>$rapp2,'rapp3'=>$rapp3));

    }

public function detail(){

  $KEY=$this->input->post('key');

  $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;  

    if ($KEY==1) {
      # code...
       $query_principal="SELECT CONCAT(cti_administration.NOM,' ',cti_administration.PRENOM) IDENTIFICATION,cti_administration.MATRICULE,cti_salaire.BRUT_CAST MONTANT FROM cti_administration LEFT JOIN cti_salaire ON cti_salaire.MATRICULE=cti_administration.MATRICULE WHERE FONCTIONNAIRE_ID_CORRIGER IS NULL AND IS_AEDUCATION=1 UNION SELECT NOM AS IDENTIFICATION,MATRICULE, SALAIREBASE AS MONTANT FROM cti_ub WHERE cti_ub.FONCTIONNAIRE_ID_CORRIGER IS NULL UNION SELECT cti_ens.MATRICULE, cti_ens.NOM, cti_ens.SALAIREDEBASE FROM cti_ens WHERE cti_ens.FONCTIONNAIRE_ID_CORRIGER IS NULL UNION SELECT cti_chuck.MATRICULE, cti_chuck.NOM, cti_chuck.SALAIREDEBASE FROM cti_chuck WHERE cti_chuck.FONCTIONNAIRE_ID_CORRIGER IS NULL UNION SELECT cti_cfpp.MATRICULE, cti_cfpp.NOM, cti_cfpp.SAL_BASE AS SALAIREDEBASE FROM cti_cfpp WHERE cti_cfpp.FONCTIONNAIRE_ID_CORRIGER IS NULL UNION SELECT cti_rpp.MATRICULE,cti_rpp.NOM,cti_rpp.SALAIREDEBASE FROM cti_rpp WHERE cti_rpp.FONCTIONNAIRE_ID_CORRIGER IS NULL ";
      } else if ($KEY==2) {
        # code...

      } else if ($KEY==3) {
        # code...

      }else{

      }

        $limit='LIMIT 0,10';
        if($_POST['length'] != -1)
        {
            $limit='LIMIT '.$_POST["start"].','.$_POST["length"];
        }
        $order_by='';
        if($_POST['order']['0']['column']!=0)
        {
        $order_by = isset($_POST['order']) ? ' ORDER BY '.$_POST['order']['0']['column'] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY cti_administration.MATRICULE  DESC'; 
        }

        $search = !empty($_POST['search']['value']) ? ("AND (CONCAT(cti_administration.NOM, ' ', cti_administration.PRENOM)  LIKE '%$var_search%'  OR IDENTIFICATION LIKE '%$var_search%' OR cti_administration.MATRICULE LIKE '%$var_search%' OR MONTANT LIKE '%$var_search%' ) ") : '';


            $critaire=" ";
            // if ($KEY2==1) {
            //  $critaire = ' AND cti_administration.id='.$KEY ;
            // }else {
            //  $critaire =' ' ;
            // }
        
        $query_secondaire=$query_principal.'  '.$critaire.' '.$search.' '.$order_by.'   '.$limit;
        $query_filter=$query_principal.'  '.$critaire.' '.$search;

        $fetch_data = $this->Model->datatable($query_secondaire);
        $u=0;
        $data = array();
        foreach ($fetch_data as $row) 
        {

         $u++;
         $fictif=array();
         $fictif[] ='<center><font color="#000000" size=2><label>'.$u.'</label></font> </center>';
         $fictif[] ='<center><font color="#000000" size=2><label>'.$row->IDENTIFICATION.'</label></font> </center>';
         $fictif[] ='<center><font color="#000000" size=2><label>'.$row->MATRICULE.'</label></font> </center>';
         // $fictif[] ='<center><font color="#000000" size=2><label>'.$row->MONTANT.'</label></font> </center>';
         $fictif[] ='<center><font color="#000000" size=2><label>'.number_format($row->MONTANT,0,',',' ').'</label></font> </center>';   
         $data[] = $fictif;
          }

         $output = array(
            "draw" => intval($_POST['draw']),
            "recordsTotal" =>$this->Model->all_data($query_principal),
            "recordsFiltered" => $this->Model->filtrer($query_filter),
            "data" => $data
        );

        echo json_encode($output);

    }


}

?>