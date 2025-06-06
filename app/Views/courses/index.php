<?= $this->include('templates/header') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Course List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active">Courses</li>
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
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">All Courses</h3>
                            <?php if (in_array(session()->get('role'), ['admin', 'teacher'])): ?>
                            <a href="/courses/add" class="btn btn-primary">Add a Course</a>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <?php if (session()->getFlashdata('message')): ?>
                                <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
                            <?php endif; ?>

                            <?php if (empty($courses)): ?>
                                <div class="alert alert-warning">No courses found! Please add some courses.</div>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>Course Name</th>
                                                <th>Course Code</th>
                                                <th>Description</th>
                                                <th style="width: 150px;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($courses as $course): ?>
                                            <tr>
                                                <td><?= $course['course_id'] ?></td>
                                                <td><?= $course['course_name'] ?></td>
                                                <td><?= $course['course_code'] ?></td>
                                                <td><?= $course['course_description'] ?></td>
                                                <td>
                                                <?php if (in_array(session()->get('role'), ['admin', 'teacher'])): ?>
                                                    <a href="/courses/edit/<?= $course['course_id'] ?>" class="btn btn-sm btn-info">Edit</a>
                                                    <?php endif; ?>

                                                    <?php if (session()->get('role') === 'admin'): ?>
                                                    <a href="/courses/delete/<?= $course['course_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
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
