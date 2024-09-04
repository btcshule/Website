<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Raport extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Charger le modèle et la bibliothèque nécessaires
        $this->load->model('report_model');
        $this->load->library('googlecharts');
    }

    public function index()
    {
        // Récupérer les données du modèle
        $data['chart_data'] = $this->report_model->get_chart_data();

        // Configurer les options du graphique
        $chart_options = array(
            'title' => 'Exemple de graphique circulaire',
            'is3D'  => true,
            'slices' => array(
                array('color' => '#e0440e'),
                array('color' => '#e6693e'),
                array('color' => '#ec8f6e'),
                array('color' => '#f3b49f'),
                array('color' => '#f6c7b6')
            )
        );

        // Charger les données et les options du graphique
        $this->googlecharts->load('pie', 'chart_div')->get($data['chart_data'], $chart_options);
        $data['chart'] = $this->googlecharts->get_output();

        // Charger la vue
        $this->load->view('Raport_view', $data);
    }

}