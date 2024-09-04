<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Charger la base de données
        $this->load->database();
    }

    public function get_chart_data()
    {
        // Exemple de requête pour récupérer les données du graphique
        $query = $this->db->get('gros_stock');
        return $query->result_array();
    }

}