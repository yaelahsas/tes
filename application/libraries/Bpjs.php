<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '../vendor/autoload.php';
 // Pastikan autoload composer

use Bpjs\Bridging\Antrol\BridgeAntrol;
use Bpjs\Bridging\Vclaim\BridgeVclaim;


class Bpjs
{
    private $antrol;

    public function __construct()
    {
        $CI =& get_instance();
        $CI->config->load('bpjs');
        $config = $CI->config->item('bpjs');

        $this->antrol = new BridgeAntrol($config['cons_id'], $config['secret_key'], $config['user_key']);
    }

    public function getJadwalDokter($kodePoli, $tanggal)
    {
     
        $endpoint = "antrean/getlisttask";
        return $this->antrol->getRequest($endpoint);
    }
}
