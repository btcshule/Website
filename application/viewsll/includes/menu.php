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
      <li class="side-nav-title side-nav-item" style="background-color:  #9EFD38">Gestion Interne</li>
      <li class="side-nav-item">
        <a data-bs-toggle="collapse" href="#Stat" aria-expanded="false" aria-controls="Stat" class="side-nav-link">
          <i class="dripicons-user-group"></i>
          <span> Raports</span>
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
    <li class="side-nav-item">
      <a data-bs-toggle="collapse" href="#admin" aria-expanded="false" aria-controls="admin" class="side-nav-link">
        <i class="dripicons-user-group"></i>
        <span> Administration</span>
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
            <span> Points de vente  </span>
          </a>
        </li>
        <li>
          <a href="<?=base_url('index.php/donnees/Occupation')?>" class="side-nav-link">
            <i class="dripicons-user-group"></i>
            <span> Postes de service </span>
          </a>
        </li>
        <li>
          <a href="<?=base_url('index.php/donnees/Imputation')?>" class="side-nav-link">
            <i class="dripicons-user-group"></i>
            <span>Imputations </span>
          </a>
        </li>

      </ul>
    </div>
  </li>
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
  <li class="side-nav-title side-nav-item" style="background-color:#9EFD38 ">Gestion commerciale </li>
  <li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#lcaisse" aria-expanded="false" aria-controls="lcaisse" class="side-nav-link">
      <i class="dripicons-archive"></i>
      <span>Caisse vente</span>
      <span class="menu-arrow"></span>
    </a>

    <div class="collapse" id="lcaisse">
     <ul class="side-nav-second-level">
      <li>
       <a href="<?=base_url('index.php/suivi/Entrees/')?>"></i>
        <span> Versement </span>
      </a>
    </li>
    <li>
      <a href="<?=base_url('index.php/suivi/Sorties/')?>">Retrait</a>
    </li>
    <li>
      <a href="<?=base_url('index.php/suivi/Histo_livre_caisse')?>" >Historique</a>
    </li>
  </ul>
</div>
</li>

<li class="side-nav-item">
  <a data-bs-toggle="collapse" href="#lbanque" aria-expanded="false" aria-controls="lbanque" class="side-nav-link">
    <i class="dripicons-archive"></i>
    <span>Banque</span>
    <span class="menu-arrow"></span>
  </a>

  <div class="collapse" id="lbanque">
   <ul class="side-nav-second-level">
  
  <li>
    <a href="<?=base_url('index.php/suivi/Banque/')?>"></i>
      <span>Versement </span>
    </a>
  </li>
  <li>
    <a href="<?=base_url('index.php/suivi/Banque_retrait/')?>">Retrait</a>
  </li>
    <li>
    <a href="<?=base_url('index.php/suivi/Histo_livre_banque')?>"></i>
        <span> Historique </span>
      </a>
  </li>
</ul>
</div>
</li>

<li class="side-nav-item">
  <a data-bs-toggle="collapse" href="#lapro" aria-expanded="false" aria-controls="lapro" class="side-nav-link">
    <i class="dripicons-archive"></i>
    <span>Approvisionnement</span>
    <span class="menu-arrow"></span>
  </a>

  <div class="collapse" id="lapro">
   <ul class="side-nav-second-level">
   
  <li>
    <a href="<?=base_url('index.php/suivi/Approvisionnement/')?>"></i>
      <span>Versement </span>
    </a>
  </li>
  <li>
    <a href="<?=base_url('index.php/suivi/Approvisionnement_sortie/')?>">Retrait</a>
  </li>
   <li>
    <a href="<?=base_url('index.php/suivi/Histo_appro')?>"></i>
        <span> Historique </span>
      </a>
  </li>
</ul>
</div>
</li>

<li class="side-nav-item">
  <a data-bs-toggle="collapse" href="#ventes" aria-expanded="false" aria-controls="ventes" class="side-nav-link">
    <i class="dripicons-archive"></i>
    <span>Gestion des ventes</span>
    <span class="menu-arrow"></span>
  </a>

  <div class="collapse" id="ventes">
   <ul class="side-nav-second-level">
    <li>
      <a href="<?=base_url('index.php/exit/Magasin_sales/')?>"></i>
        <span> Marchandises  </span>
      </a>
    </li>
   <li>
      <a href="<?=base_url('index.php/exit/Ventes_services')?>"></i>
        <span> Services </span>
      </a>
    </li>
<!--       <li>
      <a href="<?=base_url('index.php/exit/Magasin_sales')?>"></i>
        <span> Facturation </span>
      </a>
    </li> -->
      <li>
      <a href="<?=base_url('index.php/exit/Pending')?>"></i>
        <span> Factures non validées </span>
      </a>
    </li>
     <li>
      <a href="<?=base_url('index.php/exit/Factures')?>"></i>
        <span> Factures Payées</span>
      </a>
    </li>
    <li>
      <a href="<?=base_url('index.php/exit/Factures_and_sales')?>"></i>
        <span> Historique</span>
      </a>
    </li>
  </ul>
</div>
</li>
<!--  -->

<li class="side-nav-item">
  <a data-bs-toggle="collapse" href="#stock" aria-expanded="false" aria-controls="stock" class="side-nav-link">
    <i class="dripicons-archive"></i>
    <span>Stocks</span>
    <span class="menu-arrow"></span>
  </a>

  <div class="collapse" id="stock">
   <ul class="side-nav-second-level">
    <li>
      <a href="<?=base_url('index.php/stock/Categorie/')?>"> Nouvelle Catégorie</a>
    </li>
    <li>
      <a href="<?=base_url('index.php/stock/Articles/')?>"></i>Nouveau Article</a>
    </li>
    <li>
      <a href="<?=base_url('index.php/stock/Services/')?>"></i>Nouveau Service</a>
    </li>
    <li>
      <a href="<?=base_url('index.php/stock/Entrees_stock/')?>"> Approvisionnement</a>
    </li>
    <li>
      <a href="<?=base_url('index.php/stock/Stock_detail/')?>"> Stock Détaillé</a>
    </li>
    <li>
      <a href="<?=base_url('index.php/stock/Stock_global/')?>"> Stock Global</a>
    </li>
  </ul>
</div>
</li>

<li class="side-nav-item">
  <a data-bs-toggle="collapse" href="#emoney" aria-expanded="false" aria-controls="emoney" class="side-nav-link">
    <i class="dripicons-archive"></i>
    <span>E-Money</span>
    <span class="menu-arrow"></span>
  </a>

  <div class="collapse" id="emoney">
   <ul class="side-nav-second-level">
    <li>
      <a href="<?=base_url('index.php/electronique/E_Money/')?>"></i>
        <span>Versement </span>
      </a>
    </li>
    <li>
      <a href="<?=base_url('index.php/suivi/E_sorties/')?>">Retrait</a>
    </li>
    <li>
      <a href="<?=base_url('index.php/suivi/Electronics/')?>">Historique</a>
    </li>
  </ul>
</div>
</li>


<li class="side-nav-item">
  <a data-bs-toggle="collapse" href="#dettes" aria-expanded="false" aria-controls="dettes" class="side-nav-link">
    <i class="dripicons-archive"></i>
    <span>Créances et dettes</span>
    <span class="menu-arrow"></span>
  </a>

  <div class="collapse" id="dettes">
   <ul class="side-nav-second-level">
    <li>
      <a href="<?=base_url('index.php/suivi/Dettes_internes/')?>"></i>
        <span> Dettes </span>
      </a>
    </li>
    <li>
      <a href="<?=base_url('index.php/suivi/Dettes_externes/')?>">Créances</a>
    </li>
  </ul>
</div>
</li>

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