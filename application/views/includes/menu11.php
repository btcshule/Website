<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">
  <!-- LOGO -->
  <a hidden="">
    <span class="logo-lg">
      <img src="<?= base_url() ?>upload/sanya.png" alt="" style="width: 100%;height:15%;">
    </span>
  </a>
  <div class="h-100" id="leftside-menu-container" data-simplebar>
    <!--- Sidemenu -->
    <ul class="side-nav">
      <li class="side-nav-title side-nav-item" style="background-color:  blue">Gestion Interne</li>
      <li class="side-nav-item">
        <a data-bs-toggle="collapse" href="#Stat" aria-expanded="false" aria-controls="Stat" class="side-nav-link">
          <i class="dripicons-user-group"></i>
          <span> Rapports</span>
          <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="Stat">
         <ul class="side-nav-second-level">
          <li>
            <a href="<?=base_url('index.php/rapport/Statistiques')?>" class="side-nav-link">
              <i class="dripicons-user-group"></i>
              <span> Statistiques </span>
            </a>
          </li>

        </ul>
      </div>
    </li>
     <?php if ($this->session->userdata('PROFILE_ID')==6 || $this->session->userdata('PROFILE_ID')==1){?>
    <li class="side-nav-item">
      <a data-bs-toggle="collapse" href="#admin" aria-expanded="false" aria-controls="admin" class="side-nav-link">
        <i class="dripicons-user-group"></i>
        <span> Admin</span>
        <span class="menu-arrow"></span>
      </a>
      <div class="collapse" id="admin">
       <ul class="side-nav-second-level">
        <li>
          <a href="<?=base_url('index.php/administration/Utilisateurs')?>" class="side-nav-link">
            <i class="dripicons-user-group"></i>
            <span> Employés </span>
          </a>
        </li>
          <li>
            <a href="<?=base_url('index.php/donnees/Branches')?>" class="side-nav-link">
              <i class="mdi mdi-basket"></i>
              <span> Branches  </span>
            </a>
          </li>
          <li>
            <a href="<?=base_url('index.php/donnees/Occupation')?>" class="side-nav-link">
              <i class="dripicons-user-group"></i>
              <span> Postes de service </span>
            </a>
          </li>
      </ul>
    </div>
  </li>
  <?php }?>
  <?php if ($this->session->userdata('PROFILE_ID')!=4){?>
  <li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#cli" aria-expanded="false" aria-controls="cli" class="side-nav-link">
      <i class="dripicons-archive"></i>
      <span>Clients & Fournisseurs</span>
      <span class="menu-arrow"></span>
    </a>

    <div class="collapse" id="cli">
     <ul class="side-nav-second-level">
      <li>
        <a href="<?=base_url('index.php/donnees/Clients_sanya/')?>"></i>
          <span> Clients </span>
        </a>
      </li>
      <li>
        <a href="<?=base_url('index.php/donnees/Fournisseurs/')?>">Fournisseurs</a>
      </li>
    </ul>
  </div>
</li>
<?php }?>
<li class="side-nav-title side-nav-item" style="background-color:blue ">Gestion commerciale </li>
<li class="side-nav-item">
  <a data-bs-toggle="collapse" href="#lcaisse" aria-expanded="false" aria-controls="lcaisse" class="side-nav-link">
   <i class="dripicons-archive"></i>
   <!--<i class="fa fa-database" aria-hidden="true"></i>-->
   <span>Caisse</span>
   <span class="menu-arrow"></span>
 </a>
 <div class="collapse" id="lcaisse">
   <ul class="side-nav-second-level">
    <?php if ($this->session->userdata('PROFILE_ID')==4){?>
    <li>
     <a href="<?=base_url('index.php/suivi/Entrees/')?>"></i>
      <span> Entrées </span>
    </a>
  </li>
  <li>
    <a href="<?=base_url('index.php/suivi/Sorties/')?>">Sorties</a>
  </li>
  <?php }?>
  <li>
    <a href="<?=base_url('index.php/suivi/Histo_livre_caisse')?>" >Historique</a>
  </li>
</ul>
</div>
</li>


 <?php if ($this->session->userdata('PROFILE_ID')==4){?>
<li class="side-nav-item">
  <a data-bs-toggle="collapse" href="#ventes" aria-expanded="false" aria-controls="ventes" class="side-nav-link">
    <i class="dripicons-archive"></i>
    <span>Ventes</span>
    <span class="menu-arrow"></span>
  </a>

  <div class="collapse" id="ventes">
   <ul class="side-nav-second-level">
    <li>
      <a href="<?=base_url('index.php/exit/Magasin_sales')?>"></i>
        <span> Marchandises </span>
      </a>
    </li>
    <li>
      <a href="<?=base_url('index.php/exit/Ventes_services')?>"></i>
        <span> Services </span>
      </a>
    </li>   
  </ul>
</div>
</li>
<?php }?>
<li class="side-nav-item">
  <a data-bs-toggle="collapse" href="#fact" aria-expanded="false" aria-controls="fact" class="side-nav-link">
    <i class="dripicons-archive"></i>
    <span>Facturation </span>
    <span class="menu-arrow"></span>
  </a>

  <div class="collapse" id="fact">
   <ul class="side-nav-second-level">
<?php if ($this->session->userdata('PROFILE_ID')==7){?>
       <li>
      <a href="<?=base_url('index.php/exit/Pending')?>"></i>
        <span> Factures marchandises </span>
      </a>
    </li> 
             <li>
      <a href="<?=base_url('index.php/exit/Pending_s')?>"></i>
        <span> Factures  services</span>
      </a>
    </li> 
<?php }?>
    <li>
      <a href="<?=base_url('index.php/exit/Factures')?>"></i>
        <span> Marchandises</span>
      </a>
    </li>

    <li>
      <a href="<?=base_url('index.php/exit/Facture_s')?>"></i>
        <span>Services</span>
      </a>
    </li>
  </ul>
</div>
</li>
<!--  -->

<li class="side-nav-item">
  <a data-bs-toggle="collapse" href="#stock" aria-expanded="false" aria-controls="stock" class="side-nav-link">
    <i class="dripicons-archive"></i>
    <span>Stock </span>
    <span class="menu-arrow"></span>
  </a>

  <div class="collapse" id="stock">
   <ul class="side-nav-second-level">
    <?php if ($this->session->userdata('PROFILE_ID')==5){?>
  
    <li>
      <a href="<?=base_url('index.php/stock/Categorie/')?>"> Nouvelle Catégorie</a>
    </li>
    <li>
      <a href="<?=base_url('index.php/stock/Articles/')?>"></i>Nouvel Article</a>
    </li>
        <li>
      <a href="<?=base_url('index.php/stock/Entrees_stock/')?>"> Gestion des achats </a>
    </li>
  <?php }?> 
  <?php if ($this->session->userdata('PROFILE_ID')==3){?>
    <li>
      <a href="<?=base_url('index.php/stock/Services/')?>"></i>Nouveau Service</a>
    </li>
  <?php }?> 
    <li>
      <a href="<?=base_url('index.php/stock/Stock_detail/')?>"> Stock Détaillé</a>
    </li>
    <li>
      <a href="<?=base_url('index.php/stock/Stock_global/')?>"> Stock Global</a>
    </li>
  </ul>
</div>
</li>
<?php if ($this->session->userdata('PROFILE_ID')==4){?>
<li class="side-nav-item">
  <a data-bs-toggle="collapse" href="#emoney" aria-expanded="false" aria-controls="emoney" class="side-nav-link">
    <i class="dripicons-archive"></i>
    <span>E-Banking</span>
    <span class="menu-arrow"></span>
  </a>

  <div class="collapse" id="emoney">
   <ul class="side-nav-second-level">

    <li>
      <a href="<?=base_url('index.php/electronique/E_Money/')?>"></i>
        <span>Dépôt </span>
      </a>
    </li>
    <li>
      <a href="<?=base_url('index.php/electronique/S_Money/')?>"></i>
        <span>Retrait </span>
      </a>
    </li>
  </ul>
</div>
</li>
 <?php }?> 
 <?php if ($this->session->userdata('PROFILE_ID')==4){?>
 <li class="side-nav-item">
        <a data-bs-toggle="collapse" href="#test" aria-expanded="false" aria-controls="test" class="side-nav-link">
          <i class="dripicons-user-group"></i>
          <span> Gestion des dettes et créances</span>
          <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="test">

         <ul class="side-nav-second-level">

           <li>
            <a data-bs-toggle="collapse" href="#testo" aria-expanded="false" aria-controls="testo" class="side-nav-link">
              <i class="dripicons-user-group"></i>
              <span> Dettes</span>
              <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="testo">

             <ul class="side-nav-third-level">
              <li>
                <a href="<?=base_url('index.php/suivi/Dettes_internes/')?>" class="side-nav-link">
                  <i class="dripicons-user-group"></i>
                  <span> Impayées</span>
                </a>
              </li>

              <li>
                <a href="<?=base_url('index.php/suivi/De_payes/')?>" class="side-nav-link">
                  <i class="dripicons-user-group"></i>
                  <span> Payées </span>
                </a>
              </li>
            </ul>

          </div>
        </li>

        <li>
          <a data-bs-toggle="collapse" href="#testo" aria-expanded="false" aria-controls="testo" class="side-nav-link">
            <i class="dripicons-user-group"></i>
            <span> Créances</span>
            <span class="menu-arrow"></span>
          </a>
          <div class="collapse" id="testo">

           <ul class="side-nav-third-level">
            <li>
              <a href="<?=base_url('index.php/suivi/Dettes_externes/')?>" class="side-nav-link">
                <i class="dripicons-user-group"></i>
                <span> Impayées</span>
              </a>
            </li>
            <li>
              <a href="<?=base_url('index.php/suivi/Payes/')?>" class="side-nav-link">
                <i class="dripicons-user-group"></i>
                <span> Payées </span>
              </a>
            </li>

            <li>
            <a href="<?=base_url('index.php/suivi/Recouvrement/')?>" class="side-nav-link">
                <i class="dripicons-user-group"></i>
                <span> Historique </span>
              </a>
            </li>
          </ul>

        </div>
      </li>
    </ul>
  </div>
</li>
<?php }?>
</ul>
<!-- Help Box -->
<div class="help-box text-white text-center" style="display: none;">
  <a href="javascript: void(0);">
    <!-- <i class="mdi mdi-close"></i> -->
  </a>

</div>
<!-- end Help Box -->
<!-- End Sidebar -->

<div class="clearfix"></div>

</div>
<!-- Sidebar -left -->

</div>
            <!-- Left Sidebar End -->
