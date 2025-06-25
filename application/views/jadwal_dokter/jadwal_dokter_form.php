<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $page ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="#">Forms</a></div>
                <div class="breadcrumb-item"><?= $page ?></div>
            </div>
        </div>

        <div class="section-body col-xs-12">
            <h2 class="section-title"><?= $page ?></h2>
            <p class="section-lead"></p>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <?= form_open($action) ?>
                        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                            <div class="card-body">
                                <?= $this->session->flashdata('message'); ?>

                                <div class="form-group">
                                    <label for="dokter_id">Nama Dokter *</label>
                                    <select name="dokter_id" id="dokter_id" class="form-control" required>
                                        <option value="">-- Pilih Dokter --</option>
                                        <?php foreach ($dokter_data as $dokter) : ?>
                                            <option value="<?= $dokter->id ?>" <?= set_select('dokter_id', $dokter->id, ($dokter->id == $dokter_id)); ?>><?= $dokter->nama ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('dokter_id', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <label>Hari *</label>
                                    <div class="row ml-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="hari_senin" name="hari[]" value="Senin" <?= (isset($hari) && strpos($hari, 'Senin') !== false) ? 'checked' : '' ?>>
                                            <label class="custom-control-label mr-4" for="hari_senin">Senin</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="hari_selasa" name="hari[]" value="Selasa" <?= (isset($hari) && strpos($hari, 'Selasa') !== false) ? 'checked' : '' ?>>
                                            <label class="custom-control-label mr-4" for="hari_selasa">Selasa</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="hari_rabu" name="hari[]" value="Rabu" <?= (isset($hari) && strpos($hari, 'Rabu') !== false) ? 'checked' : '' ?>>
                                            <label class="custom-control-label mr-4" for="hari_rabu">Rabu</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="hari_kamis" name="hari[]" value="Kamis" <?= (isset($hari) && strpos($hari, 'Kamis') !== false) ? 'checked' : '' ?>>
                                            <label class="custom-control-label mr-4" for="hari_kamis">Kamis</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="hari_jumat" name="hari[]" value="Jumat" <?= (isset($hari) && strpos($hari, 'Jumat') !== false) ? 'checked' : '' ?>>
                                            <label class="custom-control-label mr-4" for="hari_jumat">Jumat</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="hari_sabtu" name="hari[]" value="Sabtu" <?= (isset($hari) && strpos($hari, 'Sabtu') !== false) ? 'checked' : '' ?>>
                                            <label class="custom-control-label" for="hari_sabtu">Sabtu</label>
                                        </div>
                                    </div>
                                    <?= form_error('hari[]', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="jam_mulai">Jam Mulai *</label>
                                    <input type="time" class="form-control" name="jam_mulai" id="jam_mulai" value="<?= $jam_mulai ?>" required>
                                    <?= form_error('jam_mulai', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="jam_selesai">Jam Selesai *</label>
                                    <input type="time" class="form-control" name="jam_selesai" id="jam_selesai" value="<?= $jam_selesai ?>" required>
                                    <?= form_error('jam_selesai', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <input type="hidden" name="id" value="<?= $id ?>" />
                                <button type="submit" class="btn btn-primary"><?= $button ?></button>
                                <a href="<?= site_url('Jadwal_dokter') ?>" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view('dist/_partials/footer'); ?>
