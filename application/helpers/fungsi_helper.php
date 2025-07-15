<?php
function check_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('id');
    if ($user_session) {
        redirect('Artikel');
    }
}
function check_not_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('id');
    if (!$user_session) { 
        redirect('Auth');
    }
}

function check_admin()
{
    $ci = &get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_login()->level == 3) {
        redirect('Artikel');
    }
}

function check_admin_1()
{
    $ci = &get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_login()->level != 1) {
        redirect('Artikel');
    }
}

if (!function_exists('get_status_buka')) {
    function get_status_buka($isBuka)
    {
        if ($isBuka == 1) {
            return "Buka";
        } elseif ($isBuka == 0) {
            return "Tutup";
        } else {
            return "Unknown";
        }
    }
}

if (!function_exists('get_status_badge')) {
    function get_status_badge($status)
    {
        if ($status == 'tampil') {
            return '<div class="badge badge-success">Tampil</div>';
        } else {
            return '<div class="badge badge-secondary">Draft</div>';
        }
    }
}
