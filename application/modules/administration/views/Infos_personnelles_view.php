<!DOCTYPE html>
<html lang="en">

<head>
  <?php include VIEWPATH . 'includes/head.php'; ?>
  <style type="text/css">
    label {
      color: black;
    }
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

              <div>
                <form method="POST" action="<?=base_url()?>index.php/administration/infos_personnelles/ajouter" id="fromm">
                 <div class="col-md-12 row">
                   <center><h2>Informations personnelles</h2></center>

                   <div class="col-md-4">
                    <div class="form-group">
                      <div class="mb-3">
                        <label for="NOM" style="font-weight: 900;">Nom<span style ="color: red;">*</span></label>
                        <input type="text" autocomplete="off" class="form-control" name="NOM" id="NOM" placeholder="" required>
                      </div>
                    </div>
                  </div> 
                  <div class="col-md-4">
                    <div class="form-group">
                      <div class="mb-3">
                        <label for="PRENOM" style="font-weight: 900;">Prénom<span style ="color: red;">*</span></label>
                        <input type="text" autocomplete="off" class="form-control" name="PRENOM" id="PRENOM" placeholder="" required >
                      </div>
                    </div>
                  </div>
                  <!-- SELECT `ID_INFO_PERSONNEL`, `ID_SEXE`, `NOM`, `PRENOM`, `ID_HANDICAP`, `PROVINCE_ID`, `COMMUNE_ID`, `ZONE_ID`, `COLLINE_ID`, `DATE_NAISSANCE`, `ID_MATRIMONIAL`, `TELEPHONE1`, `TELEPHONE2`, `EMAIL`, `EMAIL_PRO`, `CNI`, `RESIDENCE`, `ID_DIPLOME`, `METIER`, `DATE_EMBAUCHE`, `LIEU_EMBAUCHE`, `ID_EMBAUCHE`, `COMPETENCE`, `ID_EMPL_PRESTA`, `NUM_CARTE`, `NOM_REF`, `PRENOM_REF`, `TEL_REF`, `MAIL_REF`, `DIVERTISSEMENT`, `ID_SPDP`, `ID_MNRS`, `ID_SASO`, `ID_NACE`, `DATE_CREATION` FROM `infos_personnel` WHERE 1 -->
                  <div class="col-md-4">
                    <div class="form-group">
                      <div class="mb-3">
                        <label>Sexe</label>
                        <select name="ID_SEXE" id="ID_SEXE" class="form-control" required>

                          <option value="">---Séléctionner---</option>
                          <?php
                          foreach($sexe as $value)
                          {
                            if ($value['ID_SEXE']==set_value('ID_SEXE'))
                            {
                              ?>
                              <option value="<?=$value['ID_SEXE'] ?>" selected><?=$value['SEXE'];?></option>
                              <?php
                            }
                            else
                            {
                              ?>
                              <option value="<?= $value['ID_SEXE'] ?>"><?=$value['SEXE'];?></option>
                              <?php
                            }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <div class="mb-3">
                        <label>Handicap déclaré</label>
                        <select name="ID_HANDICAP" id="ID_HANDICAP" class="form-control" required>

                          <option value="">---Séléctionner---</option>
                          <?php
                          foreach($handicap as $value)
                          {
                            if ($value['ID_HANDICAP']==set_value('ID_HANDICAP'))
                            {
                              ?>
                              <option value="<?=$value['ID_HANDICAP'] ?>" selected><?=$value['HANDICAP'];?></option>
                              <?php
                            }
                            else
                            {
                              ?>
                              <option value="<?= $value['ID_HANDICAP'] ?>"><?=$value['HANDICAP'];?></option>
                              <?php
                            }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <div class="mb-3">
                        <label>Province de naissance</label>
                        <select name="PROVINCE_ID" id="PROVINCE_ID"  class="form-control" required onchange="get_communes();">

                          <option value="">---Séléctionner---</option>
                          <?php 
                          foreach ($provinces as $value) 
                          {
                           if ($value['PROVINCE_ID']==set_value('PROVINCE_ID')) 
                            {?>
                             <option value="<?=$value['PROVINCE_ID']?>" selected=''><?=$value['PROVINCE_NAME']?></option>
                             <?php 
                           }else{?>
                            <option value="<?=$value['PROVINCE_ID']?>"><?=$value['PROVINCE_NAME']?></option>
                            <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <div class="mb-3">
                      <label>Commune de naissance</label>
                      <select name="COMMUNE_ID" id="COMMUNE_ID" class="form-control" required onchange="get_zones();">
                        <option value="">Sélectionner</option>
                       
                       </select>
                     </div>
                   </div>
                 </div>

                 <div class="col-md-4">
                  <div class="form-group">
                    <div class="mb-3">
                      <label>Zone de naissance</label>
                      <select name="ZONE_ID" id="ZONE_ID" class="form-control" required onchange="get_collines();">
                     <option value="">Sélectionner</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <div class="mb-3">
                      <label>Colline de naissance</label>
                      <select name="COLLINE_ID" id="COLLINE_ID" class="form-control" required>

                       <option value="">Sélectionner</option>
               
                      </select>
                    </div>
                  </div>
                </div>


                <div class="col-md-4">
                  <div class="form-group">
                    <div class="mb-3">
                      <label for="DATE_NAISSANCE" style="font-weight: 900;">Date de naissance<span style ="color: red;">*</span></label>
                      <input type="date" autocomplete="off" class="form-control" name="DATE_NAISSANCE" id="DATE_NAISSANCE" placeholder="" required>
                    </div>
                  </div>
                </div>  
                <div class="col-md-4">
                  <div class="form-group">
                    <div class="mb-3">
                      <label>Situation matrimoniale</label>
                      <select name="ID_MATRIMONIAL" id="ID_MATRIMONIAL" class="form-control" required>

                        <option value="">---Séléctionner---</option>
                        <?php
                        foreach($matrimonial as $value)
                        {
                          if ($value['ID_MATRIMONIAL']==set_value('ID_MATRIMONIAL'))
                          {
                            ?>
                            <option value="<?=$value['ID_MATRIMONIAL'] ?>" selected><?=$value['MATRIMONIAL'];?></option>
                            <?php
                          }
                          else
                          {
                            ?>
                            <option value="<?= $value['ID_MATRIMONIAL'] ?>"><?=$value['MATRIMONIAL'];?></option>
                            <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <div class="mb-3">
                      <label for="TEL1" style="font-weight: 900;">Téléphone 1<span style ="color: red;">*</span></label>
                      <input type="text" autocomplete="off" class="form-control" name="TEL1" id="TEL1" placeholder="" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <div class="mb-3">
                      <label style="font-weight: 900;">Téléphone 2<span style ="color: red;">*</span></label>
                      <input type="text" autocomplete="off" class="form-control" name="TEL2" id="TEL2" placeholder="" required>
                    </div>
                  </div>
                </div> 
                <div class="col-md-4">
                  <div class="form-group">
                    <div class="mb-3">
                      <label style="font-weight: 900;">E-mail personnel<span style ="color: red;">*</span></label>
                      <input type="text" autocomplete="off" class="form-control" name="EMAIL1" id="EMAIL1" placeholder="" required max="6">
                    </div>
                  </div>
                </div>   
                <div class="col-md-4">
                  <div class="form-group">
                    <div class="mb-3">
                      <label style="font-weight: 900;">E-mail Professionnel 2<span style ="color: red;">*</span></label>
                      <input type="text" autocomplete="off" class="form-control" name="EMAIL2" id="EMAIL2" placeholder="" required >
                    </div>
                  </div>
                </div>            
                <div class="col-md-4">
                  <div class="form-group">
                    <div class="mb-3">
                      <label style="font-weight: 900;">CNI/Passport<span style ="color: red;">*</span></label>
                      <input type="text" autocomplete="off" class="form-control" name="CNI" id="CNI" placeholder="" required >
                    </div>
                  </div>
                </div> 
                 <div class="col-md-3">
                    <div class="form-group">
                      <div class="mb-3">
                        <label>Province de résidence</label>
                        <select name="PROVINCE_ID1" id="PROVINCE_ID1"  class="form-control" required onchange="get_communes1();">

                          <option value="">---Séléctionner---</option>
                          <?php 
                          foreach ($provinces as $value) 
                          {
                           if ($value['PROVINCE_ID']==set_value('PROVINCE_ID')) 
                            {?>
                             <option value="<?=$value['PROVINCE_ID']?>" selected=''><?=$value['PROVINCE_NAME']?></option>
                             <?php 
                           }else{?>
                            <option value="<?=$value['PROVINCE_ID']?>"><?=$value['PROVINCE_NAME']?></option>
                            <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <div class="mb-3">
                      <label>Commune de résidence</label>
                      <select name="COMMUNE_ID1" id="COMMUNE_ID1" class="form-control" required onchange="get_zones1();">
                        <option value="">Sélectionner</option>
                       
                       </select>
                     </div>
                   </div>
                 </div>

                 <div class="col-md-3">
                  <div class="form-group">
                    <div class="mb-3">
                      <label>Zone de résidence</label>
                      <select name="ZONE_ID1" id="ZONE_ID1" class="form-control" required onchange="get_collines1();">
                     <option value="">Sélectionner</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <div class="mb-3">
                      <label>Colline de résidence</label>
                      <select name="COLLINE_ID1" id="COLLINE_ID1" class="form-control" required>

                       <option value="">Sélectionner</option>
               
                      </select>
                    </div>
                  </div>
                </div>
                <center><h2>Informations professionnelles en liaison avec la société</h2></center>

                <div class="col-md-4">
                  <div class="form-group">
                    <div class="mb-3">
                      <label>Niveau de qualification </label>
                      <select name="ID_NIVEAU" id="ID_NIVEAU" class="form-control" required>
                        <option value="">---Séléctionner---</option>
                        <?php
                        foreach($niveau as $value)
                        {
                          if ($value['ID_NIVEAU']==set_value('ID_NIVEAU'))
                          {
                            ?>
                            <option value="<?=$value['ID_NIVEAU'] ?>" selected><?=$value['DESC_NIVEAU'];?></option>
                            <?php
                          }
                          else
                          {
                            ?>
                            <option value="<?= $value['ID_NIVEAU'] ?>"><?=$value['DESC_NIVEAU'];?></option>
                            <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <div class="mb-3">
                      <label for="METIER" style="font-weight: 900;">Métier<span style ="color: red;">*</span></label>
                      <input type="text" autocomplete="off" class="form-control" name="METIER" id="METIER" placeholder="" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <div class="mb-3">
                      <label for="DATE_EMBAUCHE" style="font-weight: 900;">Date d'embauche<span style ="color: red;">*</span></label>
                      <input type="date" autocomplete="off" class="form-control" name="DATE_EMBAUCHE" id="DATE_EMBAUCHE" placeholder="" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <div class="mb-3">
                      <label for="LIEU_EMBAUCHE" style="font-weight: 900;">Lieu d'embauche<span style ="color: red;">*</span></label>
                      <input type="text" autocomplete="off" class="form-control" name="LIEU_EMBAUCHE" id="LIEU_EMBAUCHE" placeholder="" required>
                    </div>
                  </div>
                </div>


                <div class="col-md-4">
                  <div class="form-group">
                    <div class="mb-3">
                      <label>Dossier d'embauche </label>
                      <select name="ID_EMBAUCHE" id="ID_EMBAUCHE" class="form-control" required>

                        <option value="">---Séléctionner---</option>
                        <?php
                        foreach($embauche as $value)
                        {
                          if ($value['ID_EMBAUCHE']==set_value('ID_EMBAUCHE'))
                          {
                            ?>
                            <option value="<?=$value['ID_EMBAUCHE'] ?>" selected><?=$value['EMBAUCHE'];?></option>
                            <?php
                          }
                          else
                          {
                            ?>
                            <option value="<?= $value['ID_EMBAUCHE'] ?>"><?=$value['EMBAUCHE'];?></option>
                            <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <div class="mb-3">
                      <label for="POSITION" style="font-weight: 900;">Position hiérarchique<span style ="color: red;">*</span></label>
                      <input type="text" autocomplete="off" class="form-control" name="POSITION" id="POSITION" placeholder="" required value="<?=set_value('POSITION');?>">
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <div class="mb-3">
                      <label for="COMPETENCE" style="font-weight: 900;">Compétence professionnelle<span style ="color: red;">*</span></label>
                      <input type="text" autocomplete="off" class="form-control" name="COMPETENCE" id="COMPETENCE" placeholder="" required value="<?=set_value('COMPETENCE');?>">
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <div class="mb-3">
                      <label>Emplacements des préstations </label>
                      <select name="ID_EMPLACEMENT" id="ID_EMPLACEMENT" class="form-control" required>

                        <option value="">---Séléctionner---</option>
                        <?php
                        foreach($emplacement as $value)
                        {
                          if ($value['ID_EMPLACEMENT']==set_value('ID_EMPLACEMENT'))
                          {
                            ?>
                            <option value="<?=$value['ID_EMPLACEMENT'] ?>" selected><?=$value['EMPL_PRESTA'];?></option>
                            <?php
                          }
                          else
                          {
                            ?>
                            <option value="<?= $value['ID_EMPLACEMENT'] ?>"><?=$value['EMPL_PRESTA'];?></option>
                            <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <div class="mb-3">
                      <label for="NUM_CARTE" style="font-weight: 900;">Numéro Carte<span style ="color: red;">*</span></label>
                      <input type="text" autocomplete="off" class="form-control" name="NUM_CARTE" id="NUM_CARTE" placeholder="" required>
                    </div>
                  </div>
                </div>

                <center><h2>Informations complémentaires d'utilité manageriale</h2></center>

                <div class="col-md-4">
                  <div class="form-group">
                    <div class="mb-3">
                      <label for="NOM2" style="font-weight: 900;">Nom (Personne de contact)<span style ="color: red;">*</span></label>
                      <input type="text" autocomplete="off" class="form-control" name="NOM2" id="NOM2" placeholder="" required value="<?=set_value('NOM2');?>">
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <div class="mb-3">
                      <label for="PRENOM2" style="font-weight: 900;">Prénom (Personne de contact)<span style ="color: red;">*</span></label>
                      <input type="text" autocomplete="off" class="form-control" name="PRENOM2" id="PRENOM2" placeholder="" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <div class="mb-3">
                      <label for="TEL3" style="font-weight: 900;">Téléphone (Personne de contact)<span style ="color: red;">*</span></label>
                      <input type="text" autocomplete="off" class="form-control" name="TEL3" id="TEL3" placeholder="" required >
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <div class="mb-3">
                      <label for="EMAIL3" style="font-weight: 900;">E-mail (Personne de contact)<span style ="color: red;">*</span></label>
                      <input type="mail" autocomplete="off" class="form-control" name="EMAIL3" id="EMAIL3" placeholder="" required value="<?=set_value('EMAIL3');?>">
                    </div>
                  </div>
                </div>


                
                <div class="col-md-4">
                  <div class="form-group">
                    <div class="mb-3">
                      <label for="DIVERTISSEMENT" style="font-weight: 900;">Divertissements déclarés préférés<span style ="color: red;">*</span></label>
                      <input type="text" autocomplete="off" class="form-control" name="DIVERTISSEMENT" id="DIVERTISSEMENT" placeholder="" required value="<?=set_value('DIVERTISSEMENT');?>">
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <div class="mb-3">
                      <label>Plan de développement personnel </label>
                      <select name="ID_SPDP" id="ID_SPDP" class="form-control" required>

                        <option value="">---Séléctionner---</option>
                        <?php
                        foreach($spdp as $value)
                        {
                          if ($value['ID_SPDP']==set_value('ID_SPDP'))
                          {
                            ?>
                            <option value="<?=$value['ID_SPDP'] ?>" selected><?=$value['SPDP'];?></option>
                            <?php
                          }
                          else
                          {
                            ?>
                            <option value="<?= $value['ID_SPDP'] ?>"><?=$value['SPDP'];?></option>
                            <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <div class="mb-3">
                      <label>Mise à niveau</label>
                      <select name="ID_MNRS" id="ID_MNRS" class="form-control" required>

                        <option value="">---Séléctionner---</option>
                        <?php
                        foreach($mnrs as $value)
                        {
                          if ($value['ID_MNRS']==set_value('ID_MNRS'))
                          {
                            ?>
                            <option value="<?=$value['ID_MNRS'] ?>" selected><?=$value['MNRS'];?></option>
                            <?php
                          }
                          else
                          {
                            ?>
                            <option value="<?= $value['ID_MNRS'] ?>"><?=$value['MNRS'];?></option>
                            <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <div class="mb-3">
                      <label>Santé et société</label>
                      <select name="ID_SASO" id="ID_SASO" class="form-control" required>

                        <option value="">---Séléctionner---</option>
                        <?php
                        foreach($saso as $value)
                        {
                          if ($value['ID_SASO']==set_value('ID_SASO'))
                          {
                            ?>
                            <option value="<?=$value['ID_SASO'] ?>" selected><?=$value['SASO'];?></option>
                            <?php
                          }
                          else
                          {
                            ?>
                            <option value="<?= $value['ID_SASO'] ?>"><?=$value['SASO'];?></option>
                            <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <div class="mb-3">
                      <label>Attachement à la culture d’entreprise  </label>
                      <select name="ID_NACE" id="ID_NACE" class="form-control" required>

                        <option value="">---Séléctionner---</option>
                        <?php
                        foreach($nace as $value)
                        {
                          if ($value['ID_NACE']==set_value('ID_NACE'))
                          {
                            ?>
                            <option value="<?=$value['ID_NACE'] ?>" selected><?=$value['NACE'];?></option>
                            <?php
                          }
                          else
                          {
                            ?>
                            <option value="<?= $value['ID_NACE'] ?>"><?=$value['NACE'];?></option>
                            <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <center><h2>Informations de connexion</h2></center>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="mb-3">
                     <label>Point de vente</label>
                     <select name="ID_BRANCHE" id="ID_BRANCHE" class="form-control" onchange="getdesignations()">
                      <option value="">---Sélectionner---</option>
                      <?php
                      foreach($branche as $bra)
                      {
                        if ($bra['ID_BRANCHE'] == set_value('ID_BRANCHE'))
                        {
                          ?>
                          <option value="<?= $bra['ID_BRANCHE'] ?>" selected><?= $bra['DESCRIPTION_BRANCH'] . ' ' . $bra['LOCALISATION'] ?></option>
                          <?php
                        }
                        else
                        {
                          ?>
                          <option value="<?= $bra['ID_BRANCHE'] ?>"><?= $bra['DESCRIPTION_BRANCH'] . ' ' . $bra['LOCALISATION'] ?></option>
                          <?php
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <div class="mb-3">
                   <label>Profile</label>
                   <select name="PROFILE_ID" id="PROFILE_ID" class="form-control" 
                   onchange="getdesignations()">

                   <option value="">---Séléctionner---</option>
                   <?php
                   foreach($profil as $pro)
                   {
                    if ($pro['PROFILE_ID']==set_value('PROFILE_ID'))
                    {
                      ?>
                      <option value="<?=$pro['PROFILE_ID'] ?>" selected><?=$pro['DESC_PROFIL']; ?></option>
                      <?php
                    }
                    else
                    {
                      ?>
                      <option value="<?= $pro['PROFILE_ID'] ?>"><?=$pro['DESC_PROFIL']; ?></option>
                      <?php
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>

                <button type="submit" style="float: right;background-color:#eda323;color:white;border-radius:15px" class="btn"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Sauvegarder</button>
              </div>
            </form>
          </div>
        </div>


        <!-- Footer Start -->
<!-- <footer class="footer">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        script>
          document.write(new Date().getFullYear())
        </script>
        <br>
        <br>
        <br>
        <br>
      </div>

    </div>
  </div>
</footer> -->
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

<script>
  function get_communes()
  {
    var ID_PROVINCE=$('#PROVINCE_ID').val();

    if(ID_PROVINCE=='')
    {
      $('#COMMUNE_ID').html('<option value="">---Sélectionner---</option>');
      $('#ZONE_ID').html('<option value="">---Sélectionner---</option>');
      $('#COLLINE_ID').html('<option value="">---Sélectionner---</option>');
    }
    else
    {
      $('#ZONE_ID').html('<option value="">---Sélectionner---</option>');
      $('#COLLINE_ID').html('<option value="">---Sélectionner---</option>');
      $.ajax(
      {
        url:"<?=base_url()?>index.php/administration/infos_personnelles/get_communes/"+ID_PROVINCE,
        type:"GET",
        dataType:"JSON",
        success: function(data)
        {
          $('#COMMUNE_ID').html(data);
        }
      });

    }
  }

  function get_zones()
  {
    var ID_COMMUNE=$('#COMMUNE_ID').val();
    if(ID_COMMUNE=='')
    {
      $('#ZONE_ID').html('<option value="">---Sélectionner---</option>');
      $('#COLLINE_ID').html('<option value="">---Sélectionner---</option>');
    }
    else
    {
      $('#COLLINE_ID').html('<option value="">---Sélectionner---</option>');
      $.ajax(
      {
        url:"<?=base_url()?>index.php/administration/infos_personnelles/get_zones/"+ID_COMMUNE,
        type:"GET",
        dataType:"JSON",
        success: function(data)
        {
          $('#ZONE_ID').html(data);
        }
      });

    }
  }


  function get_collines()
  {
    var ID_ZONE=$('#ZONE_ID').val();
    if(ID_ZONE=='')
    {
      $('#COLLINE_ID').html('<option value="">---Sélectionner---</option>');
    }
    else
    {
      $.ajax(
      {
        url:"<?=base_url()?>index.php/administration/infos_personnelles/get_collines/"+ID_ZONE,
        type:"GET",
        dataType:"JSON",
        success: function(data)
        {
          $('#COLLINE_ID').html(data);
        }
      });

    }
  }
</script>
<script>
  function get_communes1()
  {
    var ID_PROVINCE=$('#PROVINCE_ID1').val();

    if(ID_PROVINCE=='')
    {
      $('#COMMUNE_ID1').html('<option value="">---Sélectionner---</option>');
      $('#ZONE_ID1').html('<option value="">---Sélectionner---</option>');
      $('#COLLINE_ID1').html('<option value="">---Sélectionner---</option>');
    }
    else
    {
      $('#ZONE_ID1').html('<option value="">---Sélectionner---</option>');
      $('#COLLINE_ID1').html('<option value="">---Sélectionner---</option>');
      $.ajax(
      {
        url:"<?=base_url()?>index.php/administration/infos_personnelles/get_communes/"+ID_PROVINCE,
        type:"GET",
        dataType:"JSON",
        success: function(data)
        {
          $('#COMMUNE_ID1').html(data);
        }
      });

    }
  }

  function get_zones1()
  {
    var ID_COMMUNE=$('#COMMUNE_ID1').val();
    if(ID_COMMUNE=='')
    {
      $('#ZONE_ID1').html('<option value="">---Sélectionner---</option>');
      $('#COLLINE_ID1').html('<option value="">---Sélectionner---</option>');
    }
    else
    {
      $('#COLLINE_ID1').html('<option value="">---Sélectionner---</option>');
      $.ajax(
      {
        url:"<?=base_url()?>index.php/administration/infos_personnelles/get_zones/"+ID_COMMUNE,
        type:"GET",
        dataType:"JSON",
        success: function(data)
        {
          $('#ZONE_ID1').html(data);
        }
      });

    }
  }


  function get_collines1()
  {
    var ID_ZONE=$('#ZONE_ID1').val();
    if(ID_ZONE=='')
    {
      $('#COLLINE_ID1').html('<option value="">---Sélectionner---</option>');
    }
    else
    {
      $.ajax(
      {
        url:"<?=base_url()?>index.php/administration/infos_personnelles/get_collines/"+ID_ZONE,
        type:"GET",
        dataType:"JSON",
        success: function(data)
        {
          $('#COLLINE_ID1').html(data);
        }
      });

    }
  }
</script>
