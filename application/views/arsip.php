<?php $this->load->view('layouts/header'); ?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" 
                >Arsip Surat >> Unggah</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <p>Unggah surat yang telah terbit pada form ini untuk diarsipkan. <br>
                    Catatan:
                </p>
                <ul><li>Gunakan file berformat PDF</li></ul>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-6">
                <?php echo form_open_multipart('Home/TambahSurat'); ?>
                    <div class="form-group">
                        <label>Nomor Surat</label>
                        <input class="form-control" name="nomor" required>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select class="form-control" name="kategori" required>
                            <option></option>
                            <option value="Undangan">Undangan</option>
                            <option value="Pengumuman">Pengumuman</option>
                            <option value="Nota Dinas">Nota Dinas</option>
                            <option value="Pemberitahuan">Pemberitahuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Judul</label>
                        <input class="form-control" name="judul" required>
                    </div>
                    <div class="form-group">
                        <label>File</label>
                        <input class="form-control" name="file" type="file" required accept="application/pdf,application/vnd.ms-excel">
                    </div>
                    <br>
                    <div class="row">
                        <button type="button" class="btn btn-warning" onclick="window.location.href='<?= base_url(); ?>'"><< Kembali</button>
                        <button type="submit" class="btn btn-primary" style="margin-left: 20px;" >Simpan</button>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('layouts/footer'); ?>
