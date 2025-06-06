<?= $this->include('templates/header') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Grades List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active">Grades</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                            <h3 class="card-title m-0">All Grades</h3>
                            <?php if (in_array(session()->get('role'), ['admin', 'teacher'])): ?>
                            <a href="/grades/add" class="btn btn-light btn-sm">Add Grade</a>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                            <?php endif; ?>

                            <?php if (empty($grades)): ?>
                                <div class="alert alert-warning">No grades found! Please add some grades.</div>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover text-center align-middle">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>Student Name</th>
                                                <th>Year Start</th>
                                                <th>Year End</th>
                                                <th>1st Sem Grade</th>
                                                <th>2nd Sem Grade</th>
                                                <th style="width: 150px;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($grades as $grade): ?>
                                            <tr>
                                                <td><?= $grade['grades_id'] ?></td>
                                                <td><?= $grade['first_name'] . ' ' . $grade['last_name'] ?></td>
                                                <td><?= $grade['year_start'] ?></td>
                                                <td><?= $grade['year_end'] ?></td>
                                                <td><?= $grade['grade_first_sem'] ?></td>
                                                <td><?= $grade['grade_second_sem'] ?></td>
                                                <td>
                                                    <?php if (in_array(session()->get('role'), ['admin', 'teacher'])): ?>
                                                    <a href="/grades/edit/<?= $grade['grades_id'] ?>" class="btn btn-sm btn-info">Edit</a>
                                                    <?php endif; ?>

                                                    <?php if (session()->get('role') === 'admin'): ?>
                                                    <a href="/grades/delete/<?= $grade['grades_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


