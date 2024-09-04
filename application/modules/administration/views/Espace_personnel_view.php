<!DOCTYPE html>
<html lang="en">

<head>
  <?php include VIEWPATH . 'includes/head.php'; ?>

  <style type="text/css">

  </style>
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
                  <?=$breadcrumbs?>
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
               <center>
                <h3>Informations personnelles de : <span style="color: blue"> <?= $infos_perso['NOM'] ?>  <?= $infos_perso['PRENOM'] ?></span></h3><hr>
              </center>
              <div class="col-md-12 row"> 

                <div class="col-md-6">
                  <!-- <center><h3>Identifications</h3></center><hr> -->
                  <div class="row">
                    <div class="col-md-6">
                      <table>
                        <tr>
                          <th>Nom</th>
                        </tr>
                        <tr>
                          <td>Prénom</td>
                        </tr>
                        <tr>
                          <td>Sexe</td>
                        </tr>
                        <tr>
                          <td>Handicap</td>
                        </tr>
                         <tr>
                          <td>Province</td>
                        </tr>
                         <tr>
                          <td>Commune</td>
                        </tr>
                         <tr>
                          <td>Zone</td>
                        </tr>
                         <tr>
                          <td>Colline</td>
                        </tr>
                        <tr>
                          <td>Date de naissance</td>
                        </tr>
                         <tr>
                          <td>Situation matrimoniale</td>
                        </tr>
                      </table>
                    </div>
                    <div class="col-md-6">
                      <table>
                        <tr>
                          <th><font color="#000000">: <?= $NOM = (!empty($infos_perso['NOM'])) ? $infos_perso['NOM'] : 'N/A' ; ?></font></th>
                        </tr>
                        <tr>
                          <td><font color="#000000">: <?= $PRENOM = (!empty($infos_perso['PRENOM'])) ? $infos_perso['PRENOM'] : 'N/A' ; ?></font></td>
                        </tr>
                         <tr>
                          <td><font color="#000000">: <?= $SEXE = (!empty($infos_perso['SEXE'])) ? $infos_perso['SEXE'] : 'N/A' ; ?></font></td>
                        </tr>
                        <tr>
                          <td><font color="#000000">: <?= $HANDICAP = (!empty($infos_perso['HANDICAP'])) ? $infos_perso['HANDICAP'] : 'N/A' ; ?></font></td>
                        </tr>
                        <tr>
                          <td><font color="#000000">: <?= $PROVINCE = (!empty($infos_perso['PROVINCE'])) ? $infos_perso['PROVINCE'] : 'N/A' ; ?></font></td>
                        </tr>
                         <tr>
                          <td><font color="#000000">: <?= $COMMUNE = (!empty($infos_perso['COMMUNE'])) ? $infos_perso['COMMUNE'] : 'N/A' ; ?></font></td>
                        </tr>
                         <tr>
                          <td><font color="#000000">: <?= $ZONE = (!empty($infos_perso['ZONE'])) ? $infos_perso['ZONE'] : 'N/A' ; ?></font></td>
                        </tr>
                         <tr>
                          <td><font color="#000000">: <?= $COLLINE = (!empty($infos_perso['COLLINE'])) ? $infos_perso['COLLINE'] : 'N/A' ; ?></font></td>
                        </tr>
                         <tr>
                          <td><font color="#000000">: <?= $DATE_NAISSANCE = (!empty($infos_perso['DATE_NAISSANCE'])) ? $infos_perso['DATE_NAISSANCE'] : 'N/A' ; ?></font></td>
                        </tr>
                         <tr>
                          <td><font color="#000000">: <?= $MATRIMONIAL = (!empty($infos_perso['MATRIMONIAL'])) ? $infos_perso['MATRIMONIAL'] : 'N/A' ; ?></font></td>
                        </tr>
                      </table>
                    </div>

                  </div>
                </div>


                <div class="col-md-6">
                  <!-- <center><h3>Informations de contacts</h3></center><hr> -->
                  <div class="row">
                    <div class="col-md-6">
                      <table>
                        <tr>
                          <th>Téléphone 1</th>
                        </tr>
                        <tr>
                          <td>Téléphone 2</td>
                        </tr>
                        <tr>
                          <td>E-mail personnel</td>
                        </tr>
                        <tr>
                          <td>E-mail professionnel</td>
                        </tr>
                        <tr>
                          <td>CNI/Passport</td>
                        </tr>
                        <tr>
                          <td>Carte Professionnelle</td>
                        </tr>
                         
                        <tr>
                          <td>Province actuelle</td>
                        </tr>
                        <tr>
                          <td>Commune actuelle</td>
                        </tr>
                        <tr>
                          <td>Zone actuelle</td>
                        </tr>
                        <tr>
                          <td>Colline actuelle</td>
                        </tr>
                      </table>
                    </div>
                    <div class="col-md-6">
                      <table>
                        <tr>
                          <th><font color="#000000">: <?= $TELEPHONE1 = (!empty($infos_perso['TELEPHONE1'])) ? $infos_perso['TELEPHONE1'] : 'N/A' ; ?></font></th>
                        </tr>
                        <tr>
                          <td><font color="#000000">: <?= $TELEPHONE2 = (!empty($infos_perso['TELEPHONE2'])) ? $infos_perso['TELEPHONE2'] : 'N/A' ; ?></font></td>
                        </tr>
                        <tr>
                          <td><font color="#000000">: <?= $EMAIL = (!empty($infos_perso['EMAIL'])) ? $infos_perso['EMAIL'] : 'N/A' ; ?></font></td>
                        </tr>
                        <tr>
                          <td><font color="#000000">: <?= $EMAIL_PRO = (!empty($infos_perso['EMAIL_PRO'])) ? $infos_perso['EMAIL_PRO'] : 'N/A' ; ?></font></td>
                        </tr>
                        <tr>
                          <td><font color="#000000">: <?= $CNI = (!empty($infos_perso['CNI'])) ? $infos_perso['CNI'] : 'N/A' ; ?></font></td>
                        </tr>
                        <tr>
                          <td><font color="#000000">: <?= $NUM_CARTE = (!empty($infos_perso['NUM_CARTE'])) ? $infos_perso['NUM_CARTE'] : 'N/A' ; ?></font></td>
                        </tr>
                        
                        <tr>
                          <td><font color="#000000">: <?= $PROINCE1 = (!empty($infos_perso['PROINCE1'])) ? $infos_perso['PROINCE1'] : 'N/A' ; ?></font></td>
                        </tr>
                        <tr>
                          <td><font color="#000000">: <?= $COMMUNE1 = (!empty($infos_perso['COMMUNE1'])) ? $infos_perso['COMMUNE1'] : 'N/A' ; ?></font></td>
                        </tr>
                        <tr>
                          <td><font color="#000000">: <?= $ZONE1 = (!empty($infos_perso['ZONE1'])) ? $infos_perso['ZONE1'] : 'N/A' ; ?></font></td>
                        </tr>
                        <tr>
                          <td><font color="#000000">: <?= $COLLINE1 = (!empty($infos_perso['COLLINE1'])) ? $infos_perso['COLLINE1'] : 'N/A' ; ?></font></td>
                        </tr>

                      </table>
                    </div>
                  </div>
                </div>

                                <div class="col-md-6">
                  <center><h3>Informations professionnelles</h3></center><hr>
                  <div class="row">
                    <div class="col-md-6">
                      <table>
                        <tr>
                          <th>Niveau de qualification</th>
                        </tr>
                        <tr>
                          <td>Métiers</td>
                        </tr>
                        <tr>
                          <td>Date d’embauche</td>
                        </tr>
                        <tr>
                          <td>Lieu d’embauche</td>
                        </tr>
                         <tr>
                          <td>Catégorie du dossier d’embauche </td>
                        </tr>
                         <tr>
                          <td>Position hiérarchique</td>
                        </tr>
                         <tr>
                          <td>Compétence professionnelle </td>
                        </tr>
                        <tr>
                          <td>Emplacement des prestations </td>
                        </tr>
                      </table>
                    </div>
                    <div class="col-md-6">
                      <table>
                        <tr>
                          <th><font color="#000000">: <?= $DESC_NIVEAU = (!empty($infos_perso['DESC_NIVEAU'])) ? $infos_perso['DESC_NIVEAU'] : 'N/A' ; ?></font></th>
                        </tr>
                        <tr>
                          <td><font color="#000000">: <?= $METIER = (!empty($infos_perso['METIER'])) ? $infos_perso['METIER'] : 'N/A' ; ?></font></td>
                        </tr>
                        <tr>
                          <td><font color="#000000">: <?= $DATE_EMBAUCHE = (!empty($infos_perso['DATE_EMBAUCHE'])) ? $infos_perso['DATE_EMBAUCHE'] : 'N/A' ; ?></font></td>
                        </tr>
                        <tr>
                          <td><font color="#000000">: <?= $LIEU_EMBAUCHE = (!empty($infos_perso['LIEU_EMBAUCHE'])) ? $infos_perso['LIEU_EMBAUCHE'] : 'N/A' ; ?></font></td>
                        </tr>
                        
                        <tr>
                          <td><font color="#000000">: <?= $EMBAUCHE = (!empty($infos_perso['EMBAUCHE'])) ? $infos_perso['EMBAUCHE'] : 'N/A' ; ?></font></td>
                        </tr>
                        <tr>
                          <td><font color="#000000">: <?= $POSITION = (!empty($infos_perso['POSITION'])) ? $infos_perso['POSITION'] : 'N/A' ; ?></font></td>
                        </tr>
                        <tr>
                          <td><font color="#000000">: <?= $COMPETENCE = (!empty($infos_perso['COMPETENCE'])) ? $infos_perso['COMPETENCE'] : 'N/A' ; ?></font></td>
                        </tr>
                        <tr>
                          <td><font color="#000000">: <?= $EMPL_PRESTA = (!empty($infos_perso['EMPL_PRESTA'])) ? $infos_perso['EMPL_PRESTA'] : 'N/A' ; ?></font></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>

                                <div class="col-md-6">
                  <center><h3>Informations d'utilité managériale</h3></center><hr>
                  <div class="row">
                    <div class="col-md-6">
                      <table>
                        <tr>
                          <th>Personne de référence (Nom)</th>
                        </tr>
                        <tr>
                          <td>Personne de référence (Prénom)</td>
                        </tr>
                        <tr>
                          <td>Personne de référence (E-mail)</td>
                        </tr>
                        <tr>
                          <td>Personne de référence (Télephone)</td>
                        </tr>
                        <tr>
                          <td>Divertissements déclarés</td>
                        </tr>
                        <tr>
                          <td>Plan de développement personnel </td>
                        </tr>
                        
                        <tr>
                          <td>Santé et société</td>
                        </tr>
                        <tr>
                          <td>Culture d’entreprise </td>
                        </tr>
                        <tr>
                          <td>Mise à niveau recommandé</td>
                        </tr>
                      </table>
                    </div>
                    <div class="col-md-6">
                      <table>
                        <tr>
                          <th ><b><font color="#000000">: <?= $NOM_REF = (!empty($infos_perso['NOM_REF'])) ? $infos_perso['NOM_REF'] : 'N/A' ; ?></font></b></th>
                        </tr>
                        <tr>
                          <td><b><font color="#000000">: <?= $PRENOM_REF = (!empty($infos_perso['PRENOM_REF'])) ? $infos_perso['PRENOM_REF'] : 'N/A' ; ?></font></b></td>
                        </tr>
                         <tr>
                          <td><font color="#000000">: <?= $MAIL_REF = (!empty($infos_perso['MAIL_REF'])) ? $infos_perso['MAIL_REF'] : 'N/A' ; ?></font></td>
                        </tr>
                        <tr>
                          <td><font color="#000000">: <?= $TEL_REF = (!empty($infos_perso['TEL_REF'])) ? $infos_perso['TEL_REF'] : 'N/A' ; ?></font></td>
                        </tr>
                        <tr>
                          <td><font color="#000000">: <?= $DIVERTISSEMENT = (!empty($infos_perso['DIVERTISSEMENT'])) ? $infos_perso['DIVERTISSEMENT'] : 'N/A' ; ?></font></td>
                        </tr>
                         <tr>
                          <td><font color="#000000">: <?= $SPDP = (!empty($infos_perso['SPDP'])) ? $infos_perso['SPDP'] : 'N/A' ; ?></font></td>
                        </tr>
                         
                        <tr>
                          <td><font color="#000000">: <?= $SASO = (!empty($infos_perso['SASO'])) ? $infos_perso['SASO'] : 'N/A' ; ?></font></td>
                        </tr>
                        <tr>
                          <td><font color="#000000">: <?= $NACE = (!empty($infos_perso['NACE'])) ? $infos_perso['NACE'] : 'N/A' ; ?></font></td>
                        </tr>
                        <tr>
                          <td><font color="#000000">: <?= $MNRS = (!empty($infos_perso['MNRS'])) ? $infos_perso['MNRS'] : 'N/A' ; ?></font></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>

              </div>
            </div> <!-- end card-body -->
          </div> <!-- end card -->
        </div> <!-- end col -->
      </div>
      <!-- end row -->
    </div> <!-- container -->
  </div> <!-- content -->

  <!-- Footer Start -->
  <footer class="footer">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <script>
            document.write(new Date().getFullYear())
          </script>
          <!-- 2021 © Hyper - Coderthemes.com -->
        </div>

      </div>
    </div>
  </footer>
  <!-- end Footer -->

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

