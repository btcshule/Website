<?php
class Materiels extends CI_Controller
{

  public function __construct()

  {
    parent::__construct();
    $this->out_application();
    $this->make_bread->add('Reporting', "index.php/suivi/Materiels", 0);
    $this->breadcrumb = $this->make_bread->output();
    
  }
  function out_application()
  {
    if(empty($this->session->userdata('USER_ID')))
    {
      redirect(base_url('index.php/'));
    }
  }

  function index()
  {
    $this->make_bread->add('Inventory', "index.php/suivi/Materiels", 0);
    $data['breadcrumb'] = $this->make_bread->output();
    $this->load->view('Materiels_view',$data); 
  }

function ajouter()
{
     $this->form_validation->set_rules('QTE_MATERIEL','','trim|required',array('required'=>'<font style="font-size:15px;">*required</font>'));
    $this->form_validation->set_rules('COMMENTS','','trim|required',array('required'=>'<font style="font-size:15px;">*required</font>'));

     if ($this->form_validation->run()==FALSE) 
      {
      $data['QTE_MATERIEL']=$this->input->post('QTE_MATERIEL');
      $data['COMMENTS']=$this->input->post('COMMENTS');
      $this->make_bread->add('Materiels', "suivi/Materiels", 0);
      $data['breadcrumb'] = $this->make_bread->output();
      $this->load->view('Materiels_view',$data); 
      }
      else
    {
      $table='materiels';
      $data= array(
        'DESC_MATERIEL' =>$this->input->post('COMMENTS'),
        'QTE_MATERIEL'=>$this->input->post('QTE_MATERIEL'),
        'RESP_MATERIEL'=>$this->session->userdata('USER_ID')
        ); 
    }
     $creating=$this->Model->create($table,$data);
     if ($creating)
      {
        $data['message']='<div class="alert alert-success text-center" id="message">The record of:<font style="color:red"> '.$this->input->post('COMMENTS').' </font> has been successfully saved.

</div>';
        $this->session->set_flashdata($data);
      }
      else
      {
       $data['message']='<div class="alert alert-success text-center" id="message">L\'enregistrement a echoué</div>';
       $this->session->set_flashdata($data);

     }
     
     redirect(base_url('index.php/suivi/Materiels/listing')); 
}

function listing(){

  $entrees= $this->Model->getRequete('SELECT  `DESC_MATERIEL`, `QTE_MATERIEL`,DATE_MATERIEL, users.USER_PRENOM FROM `materiels` JOIN users ON users.USER_ID=materiels.RESP_MATERIEL  WHERE 1 ORDER BY DATE_MATERIEL DESC');
     $i=0;
    foreach ($entrees as $key) {
      $i=$i+1;
      $donnee=array();
      
      $donnee[]=$i;
      // $donnee[]=$key['DATE_MATERIEL'];
      $donnee[]=$key['DESC_MATERIEL'];
      $donnee[]=$key['QTE_MATERIEL'];
      // $donnee[]=$key['USER_PRENOM'];

      $datas[]=$donnee;
    }
    $template = array(
      'table_open' => '<table id="AllStock" class="table table-bordered table-striped table-hover table-condensed table-responsive">',
      'table_close' => '</table>'
    );

    $this->table->set_heading('#','Materiel','Quantity');
    $this->table->set_template($template);
    $data['ourclient']=$datas;
    $data['breadcrumb'] = $this->make_bread->output();

  $this->load->view('Materiels_list_view',$data);
 }

 
}
?>