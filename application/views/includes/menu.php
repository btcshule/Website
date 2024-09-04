========== Left Sidebar Start ========== -->
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
           <li>
            <a href="<?=base_url('index.php/rapport/Dashboard')?>" class="side-nav-link">
              <i class="dripicons-user-group"></i>
              <span> TBD Ventes </span>
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
            <span> Utilisateurs </span>
          </a>
        </li>
         <li>
          <a href="<?=base_url('index.php/donnees/Occupation')?>" class="side-nav-link">
            <i class="dripicons-user-group"></i>
            <span> Postes de service </span>
          </a>
        </li>
         <li>
          <a href="<?=base_url('index.php/administration/Users_profil')?>" class="side-nav-link">
            <i class="dripicons-user-group"></i>
            <span> Point de services</span>
          </a>
        </li>
         <li>
          <a href="<?=base_url('index.php/administration/Archives')?>" class="side-nav-link">
            <i class="dripicons-user-group"></i>
            <span> Archivage </span>
          </a>
        </li>
        <li>
          <a href="<?=base_url('index.php/administration/Infos_personnelles')?>" class="side-nav-link">
            <i class="dripicons-user-group"></i>
            <span> Infos Employés </span>
          </a>
        </li>
         <li>
          <a href="<?=base_url('index.php/administration/Liste_employes')?>" class="side-nav-link">
            <i class="dripicons-user-group"></i>
            <span> Liste Employés  </span>
          </a>
        </li>
        <li>
          <a href="<?=base_url('index.php/donnees/Branches')?>" class="side-nav-link">
            <i class="mdi mdi-basket"></i>
            <span> Points de vente  </span>
          </a>
        </li>
       
        <li>
          <a href="<?=base_url('index.php/donnees/Imputation')?>" class="side-nav-link">
            <i class="dripicons-user-group"></i>
            <span> Imputations </span>
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
      <!--<i class="fa fa-database" aria-hidden="true"></i>-->
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
    <!--<i class="fa fa-database"></i>-->
     <i class="dripicons-archive"></i>
    <span>Caisse Banque</span>
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
    <span>Caisse Approvisionnement</span>
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
      <a href="<?=base_url('index.php/exit/Magasin_sales')?>"></i>
        <span> Facturation Marchandises </span>
      </a>
    </li>
     <li>
      <a href="<?=base_url('index.php/exit/Ventes_services')?>"></i>
        <span> Facturation Services </span>
      </a>
    </li>
    <li>
      <a href="<?=base_url('index.php/donnees/Ventes/')?>"></i>
        <span> Marchandises  </span>
      </a>
    </li>
   <li>
      <a href="<?=base_url('index.php/suivi/Services')?>"></i>
        <span> Services </span>
      </a>
    </li>
   
  </ul>
</div>
</li>
      <li class="side-nav-item">
        <a data-bs-toggle="collapse" href="#test" aria-expanded="false" aria-controls="test" class="side-nav-link">
          <i class="dripicons-user-group"></i>
          <span> Classeur des factures</span>
          <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="test">

         <ul class="side-nav-second-level">

           <li>
            <a data-bs-toggle="collapse" href="#msess" aria-expanded="false" aria-controls="msess" class="side-nav-link">
              <i class="dripicons-user-group"></i>
              <span> Marchandises</span>
              <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="msess">

             <ul class="side-nav-third-level">
              <li>
                <a href="<?=base_url('index.php/exit/Pending/')?>" class="side-nav-link">
                  <i class="dripicons-user-group"></i>
                  <span> Factures</span>
                </a>
              </li>

              <li>
                <a href="<?=base_url('index.php/exit/Factures/')?>" class="side-nav-link">
                  <i class="dripicons-user-group"></i>
                  <span> Historique </span>
                </a>
              </li>
            </ul>

          </div>
        </li>

        <li>
          <a data-bs-toggle="collapse" href="#serv" aria-expanded="false" aria-controls="serv" class="side-nav-link">
            <i class="dripicons-user-group"></i>
            <span> Services</span>
            <span class="menu-arrow"></span>
          </a>
          <div class="collapse" id="serv">

           <ul class="side-nav-third-level">
            <li>
              <a href="<?=base_url('index.php/exit/Pending_s')?>" class="side-nav-link">
                <i class="dripicons-user-group"></i>
                <span> Factures</span>
              </a>
            </li>
            <li>
              <a href="<?=base_url('index.php/exit/Facture_s/')?>" class="side-nav-link">
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
<!--  -->

      <li class="side-nav-item">
        <a data-bs-toggle="collapse" href="#gestion_st" aria-expanded="false" aria-controls="gestion_st" class="side-nav-link">
          <i class="dripicons-user-group"></i>
          <span> Gestion du stock des  marchandises</span>
          <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="gestion_st">
          <ul class="side-nav-second-level">
           <li>
            <a data-bs-toggle="collapse" href="#creer" aria-expanded="false" aria-controls="creer" class="side-nav-link">
              <i class="dripicons-user-group"></i>
              <span> Nouveau</span>
              <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="creer">

             <ul class="side-nav-third-level">
              <li>
                <a href="<?=base_url('index.php/stock/Categorie/')?>" class="side-nav-link">
                  <i class="dripicons-user-group"></i>
                  <span> Catégorie Produit</span>
                </a>
              </li>
               <li>
                <a href="<?=base_url('index.php/stock/Cath_service/')?>" class="side-nav-link">
                  <i class="dripicons-user-group"></i>
                  <span> Catégorie Service</span>
                </a>
              </li>
              <li>
                <a href="<?=base_url('index.php/stock/Articles/')?>" class="side-nav-link">
                  <i class="dripicons-user-group"></i>
                  <span> Article </span>
                </a>
              </li>

              <li>
                <a href="<?=base_url('index.php/stock/Services/')?>" class="side-nav-link">
                  <i class="dripicons-user-group"></i>
                  <span> Service </span>
                </a>
              </li>
            </ul>

          </div>
        </li>
        <li>
          <a href="<?=base_url('index.php/stock/Entrees_stock/')?>"> <i class="dripicons-user-group"></i>
                <span> Gestion des achats</span>  </a>
        </li>

        <li>
          <a data-bs-toggle="collapse" href="#stock" aria-expanded="false" aria-controls="stock" class="side-nav-link">
            <i class="dripicons-user-group"></i>
            <span> Stocks</span>
            <span class="menu-arrow"></span>
          </a>
          <div class="collapse" id="stock">

           <ul class="side-nav-third-level">
            <li>
              <a href="<?=base_url('index.php/stock/Stock_detail/')?>" class="side-nav-link">
                <i class="dripicons-user-group"></i>
                <span> Détaillé</span>
              </a>
            </li>
            <li>
              <a href="<?=base_url('index.php/stock/Stock_global/')?>" class="side-nav-link">
                <i class="dripicons-user-group"></i>
                <span> Global </span>
              </a>
            </li>
          </ul>

        </div>
      </li>
    </ul>
  </div>
</li>

<li class="side-nav-item">
  <a data-bs-toggle="collapse" href="#emoney" aria-expanded="false" aria-controls="emoney" class="side-nav-link">
    <i class="dripicons-archive"></i>
    <span>E-Money Bank</span>
    <span class="menu-arrow"></span>
  </a>

  <div class="collapse" id="emoney">
   <ul class="side-nav-second-level">
    <li>
      <a href="<?=base_url('index.php/electronique/E_Money/')?>"></i>
        <span>Versement-Encaissement </span>
      </a>
    </li>
     <li>
      <a href="<?=base_url('index.php/electronique/S_Money/')?>"></i>
        <span>Retrait-Décaissement </span>
      </a>
    </li>
    <li>
      <a href="<?=base_url('index.php/electronique/Unites/')?>"></i>
        <span>Transactions Unités</span>
      </a>
    </li>
  </ul>
</div>
</li>

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
            <!-- Left Sidebar End