<?php $this->load->view('layouts/header'); ?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" style="margin-top: 20px;">Arsip Surat >> Lihat</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-6">
                  <p>
                      Nomor : <?= $berita->nomor ?> <br>
                      Kategori : <?= $berita->kategori ?> <br>
                      Judul : <?= $berita->judul ?> <br>
                      Waktu : <?= $berita->waktu ?> <br>
                  </p>
                
                  <div class="frame">
                      <iframe src="<?= base_url(); ?>assets/surat/<?= $berita->file ?>" class="surat" width="100%" height="500px"></iframe>
                  </div>
                  <br>
                  <div class="row" style="margin-bottom: 30px;">
                      <button type="submit" class="btn btn-warning" onclick="window.location.href='<?= base_url(); ?>'" style="margin-left: 15px;"><< Kembali </button>
                      <button type="submit" class="btn btn-success" onclick="window.location.href='<?= base_url(); ?>/Home/UnduhSurat/<?= $berita->id?>'" style="margin-left: 350px;">Unduh</button>
                      <button type="submit" class="btn btn-info" data-toggle="modal" data-target="#edit" style="margin-left: 400px;">Edit/Ganti file</button>
                  </div>
            </div>
        </div>

        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Surat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <?php echo form_open_multipart('Home/EditSurat/'. $berita->id); ?>
                    <div class="form-group">
                        <label>Nomor Surat</label>
                        <input class="form-control" name="nomor" required value="<?= $berita->nomor ?>">
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select class="form-control" name="kategori" required>
                            <option hidden value="<?= $berita->kategori ?>"><?= $berita->kategori ?></option>
                            <option value="Undangan">Undangan</option>
                            <option value="Pengumuman">Pengumuman</option>
                            <option value="Nota Dinas">Nota Dinas</option>
                            <option value="Pemberitahuan">Pemberitahuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Judul</label>
                        <input class="form-control" name="judul" required value="<?= $berita->judul ?>">
                    </div>
                    <div class="form-group">
                        <label>File</label>
                        <input class="form-control" name="file" type="file" accept="application/pdf,application/vnd.ms-excel">
                        <p><?= $berita->file ?></p>
                        <input type="hidden" value="<?= $berita->file ?>" name="_file">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
                <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>



<?php $this->load->view('layouts/footer'); ?>
