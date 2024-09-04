<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require APPPATH . 'third_party/phpqrcode/qrlib.php';
class Qrcode extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function generate() {
        $link = 'http://www.freeti.org';

        // Chemin où vous souhaitez enregistrer le code QR généré
        $path = FCPATH . 'qrcodes/';

        // Assurez-vous que le dossier de destination existe
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        // Nom du fichier de code QR (peut être personnalisé)
        $filename = 'freeti_qr.png';

        // Chemin complet du fichier de code QR
        $filepath = $path . $filename;

        // Génération du code QR
        QRcode::png($link, $filepath, QR_ECLEVEL_L, 10);

        // Affichage de l'image du code QR généré
        header("Content-Type: image/png");
        echo file_get_contents($filepath);
        exit;
    }
}