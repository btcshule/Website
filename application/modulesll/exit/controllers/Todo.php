<?php
/**
* 
*/
class Todo extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->out_application();
	}
	function out_application()
	{
		if(empty($this->session->userdata('USER_ID')))
		{
			redirect(base_url(''));
		}
	}
	//todo imprimerie call
	function index()
	{

		$data['service_commande']=$this->Model->getRequete('SELECT * FROM `service_commande` WHERE 1');
		$this->load->view('Todo_view',$data);
	}
//call todo design interface
function design()
	{

		$data['service_commande']=$this->Model->getRequete('SELECT * FROM `service_commande` WHERE 1');
		$this->load->view('Todo_design_view',$data);
	}
	//save data from imprimerie
	public function save()
	{
		$this->form_validation->set_rules('ID_SERV_COMMANDE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">*Required</font>'));
		$this->form_validation->set_rules('QNTY', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">*Required</font>'));
		$this->form_validation->set_rules('CLIENT', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">*Required</font>'));
		$this->form_validation->set_rules('DATE_LIVR', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">*Required</font>'));

		if ($this->form_validation->run() == FALSE) {
			$data['service_commande']=$this->Model->getRequete('SELECT * FROM `service_commande` WHERE 1');
			$this->load->view('Todo_view',$data);
		}
		else
		{

			$ID_SERV_COMMANDE=$this->input->post('ID_SERV_COMMANDE');
			$QNTY=$this->input->post('QNTY');
			$CLIENT=$this->input->post('CLIENT');
			$DATE_LIVR=$this->input->post('DATE_LIVR');
			$table='todo';
			$data= array(
				"LIBELLE_TODO"=>$ID_SERV_COMMANDE, "QNTY"=>$QNTY, "CLIENT"=>$CLIENT, "DATE_PREV_LIVRAIS"=>$DATE_LIVR,"SERVICE_EMSI_ID"=>1);

			$creation=$this->Model->insert_last_id($table,$data);
			if ($creation)
			{

				$data['message']='<div class="alert alert-success alert-dismissible alert-alt solid fade show">
				<button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close text-white" style="color:white"></i></span>
				</button>
				<strong><i class="fa fa-check"> </i>Operation done,Activity created.</strong>
				</div>';
				$this->session->set_flashdata($data);
			}

			redirect(base_url('exit/Todo'));
		}
	}
	//save data from design
	public function register()
	{
		$this->form_validation->set_rules('ID_SERV_COMMANDE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">*Required</font>'));
		$this->form_validation->set_rules('QNTY', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">*Required</font>'));
		$this->form_validation->set_rules('CLIENT', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">*Required</font>'));
		$this->form_validation->set_rules('DATE_LIVR', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">*Required</font>'));

		if ($this->form_validation->run() == FALSE) {
			$data['service_commande']=$this->Model->getRequete('SELECT * FROM `service_commande` WHERE 1');
			$this->load->view('Todo_design_view',$data);
		}
		else
		{

			$ID_SERV_COMMANDE=$this->input->post('ID_SERV_COMMANDE');
			$QNTY=$this->input->post('QNTY');
			$CLIENT=$this->input->post('CLIENT');
			$DATE_LIVR=$this->input->post('DATE_LIVR');
			$table='todo';
			$data= array(
				"LIBELLE_TODO"=>$ID_SERV_COMMANDE, "QNTY"=>$QNTY, "CLIENT"=>$CLIENT, "DATE_PREV_LIVRAIS"=>$DATE_LIVR,"SERVICE_EMSI_ID"=>2);

			$creation=$this->Model->insert_last_id($table,$data);
			if ($creation)
			{

				$data['message']='<div class="alert alert-success alert-dismissible alert-alt solid fade show">
				<button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close text-white" style="color:white"></i></span>
				</button>
				<strong><i class="fa fa-check"> </i>Operation done,Activity created.</strong>
				</div>';
				$this->session->set_flashdata($data);
			}

			redirect(base_url('exit/Todo/design'));
		}
	}
//liste
	function todo_imprim(){
		// $today=date("Y-m-d");AND date_format(DATE_ACTION,"%Y-%m-%d")="'.$today.'"
		$data['todo']=$this->Model->getRequete('SELECT `TODO_ID`,LIBELLE_TODO,SERVICE_EMSI_ID,`QNTY`,`CLIENT`,`DATE_PREV_LIVRAIS`,`DATE_ACTION` FROM `todo` WHERE SERVICE_EMSI_ID=1  ORDER BY TODO_ID DESC');
		$this->load->view('Todo_liste_view',$data);
	}
	function todo_design(){
		// $today=date("Y-m-d");AND date_format(DATE_ACTION,"%Y-%m-%d")="'.$today.'"
		$data['todo']=$this->Model->getRequete('SELECT `TODO_ID`,LIBELLE_TODO,SERVICE_EMSI_ID,`QNTY`,`CLIENT`,`DATE_PREV_LIVRAIS`,`DATE_ACTION` FROM `todo` WHERE SERVICE_EMSI_ID=2  ORDER BY TODO_ID DESC');
		$this->load->view('Todo_designliste_view',$data);
	}

}?>