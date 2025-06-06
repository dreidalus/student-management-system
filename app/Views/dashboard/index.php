<?= $this->include('templates/header') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1 class="m-0">Dashboard</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title m-0">Dashboard Overview</h3>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>
                    
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>

                    <div class="row">
        
                        <div class="col-lg-6 col-12">
                            <div class="card card-widget widget-user shadow-sm">
                                <div class="card-header bg-info text-white">
                                    <h3 class="card-title">Total Students</h3>
                                </div>
                                <div class="card-body text-center">
                                    <h4><?= $studentCount ?></h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="card card-widget widget-user shadow-sm">
                                <div class="card-header bg-info text-white">
                                    <h3 class="card-title">Total Courses</h3>
                                </div>
                                <div class="card-body text-center">
                                    <h4><?= $courseCount ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="<?= site_url('auth/logout') ?>" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


