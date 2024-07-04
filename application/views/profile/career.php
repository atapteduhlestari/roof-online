<section id="main-container" class="main-container">
    <div class="container">
        <div class="mb-5">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Terjadi kesalahan</strong>, mohon cek kembali form lamaran!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Terjadi kesalahan</strong>, <?= $this->session->flashdata('error'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><?= $this->session->flashdata('success'); ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <?php if ($hiring) : ?>
                <div class="row">
                    <div class="col">
                        <img class="mx-auto d-block" height="300px" src="<?= base_url(); ?>assets/images/karir-interview.png" alt="">
                        <h3 class="section-sub-title text-center">WE ARE HIRING <i class="fas fa-bullhorn"></i></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div id="module" class="card">
                            <div class="card-body">
                                <h4 class="card-title">PRODUCT ADVISOR</h4>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste sunt soluta tempore, vero fuga corrupti necessitatibus, optio quaerat eaque minima adipisci molestiae natus eius non expedita facere vitae tempora eveniet?</p>
                                <div class="collapse" id="collapseCareer1" aria-expanded="false">
                                    <strong>Tanggung Jawab :</strong>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>
                                    <br>
                                </div>
                                <div class="collapse" id="collapseCareer1" aria-expanded="false">
                                    <strong>Kualifikasi :</strong>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>
                                    <br>
                                </div>
                                <div class="collapse" id="collapseCareer1" aria-expanded="false">
                                    <strong>Benefit :</strong>
                                    <li>Gaji Pokok</li>
                                    <li>Komisi</li>
                                    <li>BPJS Ketenagakerjaan dan kesehatan</li>
                                    <br>
                                </div>
                                <div class="collapse" id="collapseCareer1" aria-expanded="false">
                                    <strong>Penempatan :</strong>
                                    Jakarta Timur
                                    <br>
                                </div>
                                <a role="button" class="small collapsed text-primary" data-toggle="collapse" href="#collapseCareer1" role="button" aria-expanded="false" aria-controls="collapseCareer1">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="module" class="card">
                            <div class="card-body">
                                <h4 class="card-title">SUPERVISOR MARKETING</h4>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste sunt soluta tempore, vero fuga corrupti necessitatibus, optio quaerat eaque minima adipisci molestiae natus eius non expedita facere vitae tempora eveniet?</p>
                                <div class="collapse" id="collapseCareer2" aria-expanded="false">
                                    <strong>Tanggung Jawab :</strong>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>
                                    <br>
                                </div>
                                <div class="collapse" id="collapseCareer2" aria-expanded="false">
                                    <strong>Kualifikasi :</strong>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>
                                    <br>
                                </div>
                                <div class="collapse" id="collapseCareer2" aria-expanded="false">
                                    <strong>Benefit :</strong>
                                    <li>Gaji Pokok</li>
                                    <li>Komisi</li>
                                    <li>BPJS Ketenagakerjaan dan kesehatan</li>
                                    <br>
                                </div>
                                <div class="collapse" id="collapseCareer2" aria-expanded="false">
                                    <strong>Penempatan :</strong>
                                    Jakarta Timur
                                    <br>
                                </div>
                                <a role="button" class="collapsed text-primary" data-toggle="collapse" href="#collapseCareer2" role="button" aria-expanded="false" aria-controls="collapseCareer1">
                                </a>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Card Row -->
                <hr class="my-5">
                <h5 class="mb-3">Lengkapi form di bawah ini apabila anda memenuhi kriteria</h5>
                <div class="row align-items-center">
                    <div class="col-8">
                        <form id="form-career" action="<?= base_url(); ?>save" enctype="multipart/form-data" method="post">
                            <div class="form-group">
                                <label for="nama">Nama lengkap</label>
                                <input type="text" class="form-control form-control-sm <?= form_error('nama') ? 'is-invalid' : '' ?>" value="<?= set_value('nama') ?>" name="nama" id="nama" autocomplete="off" required>
                                <?php echo form_error('nama', '<div class="invalid-feedback">', '</div>'); ?>

                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control form-control-sm <?= form_error('email') ? 'is-invalid' : '' ?>" value="<?= set_value('email') ?>" name="email" id="email" autocomplete="off" required>
                                <?php echo form_error('email', '<div class="invalid-feedback">', '</div>'); ?>

                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="number" class="form-control form-control-sm <?= form_error('phone') ? 'is-invalid' : '' ?>" value="<?= set_value('phone') ?>" name="phone" id="phone" autocomplete="off" required>
                                <?php echo form_error('phone', '<div class="invalid-feedback">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="position">Posisi yang dilamar</label>
                                <select class="form-control form-control-sm <?= form_error('position') ? 'is-invalid' : '' ?>" name="position" id="position" required>
                                    <option value="" disabled selected>Select your option</option>
                                    <option value="Product Advisor" <?= set_value('position') == 'Product Advisor' ? 'selected' : '' ?>>Product Advisor</option>
                                    <option value="Supervisor Marketing" <?= set_value('position') == 'Supervisor Marketing' ? 'selected' : '' ?>>Supervisor Marketing</option>
                                </select>
                                <?php echo form_error('position', '<div class="invalid-feedback">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="file_upload">Upload CV</label>
                                <div class="custom-file">
                                    <input type="file" name="file_upload" id="file_upload" class="custom-file-input form-control-sm <?= form_error('file_upload') ? 'is-invalid' : '' ?>" required>
                                    <label class="custom-file-label" for="customFile"></label>
                                    <?php echo form_error('file_upload', '<div class="invalid-feedback">', '</div>'); ?>

                                    <small class="font-weight-bolder font-italic text-danger">format: PDF | max: 1MB</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="6LffLAMqAAAAACP_TE5VBc-sCz0yzbEMneXdbU1z"></div>
                                <div class="">
                                    <?php echo form_error('g-recaptcha-response', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <button id="prevent-submit" type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </form>
                    </div>
                    <div class="col-4">
                        <img height="350px" src="<?= base_url(); ?>assets/images/karir-form.png" alt="">
                    </div>
                </div>
            <?php endif; ?>
            <?php if (!$hiring) : ?>
                <div class="row">
                    <div class="col">
                        <img class="mx-auto d-block" height="300px" src="<?= base_url(); ?>assets/images/karir-interview.png" alt="">
                        <h3 class="text-center">No Position Available! </h3>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>