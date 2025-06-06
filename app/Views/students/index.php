<?= $this->include('templates/header') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Student List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active">Students</li>
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
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h3 class="card-title m-0">All Students</h3>
                            <a href="<?= site_url('students/add') ?>" class="btn btn-light btn-sm">Add Student</a>
                        </div>
                        <div class="card-body">
                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success">
                                    <?= session()->getFlashdata('success') ?>
                                </div>
                            <?php endif; ?>

                            <?php if (empty($students)): ?>
                                <div class="alert alert-warning">
                                    No students found! Please add some students.
                                </div>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover text-center align-middle">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Age</th>
                                                <th>Address</th>
                                                <th>Course</th>
                                                <th style="width: 150px;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($students as $student): ?>
                                            <tr>
                                                <td><?= $student['students_id'] ?></td>
                                                <td><?= $student['first_name'] ?></td>
                                                <td><?= $student['last_name'] ?></td>
                                                <td><?= $student['phone_number'] ?></td>
                                                <td><?= $student['email'] ?></td>
                                                <td><?= $student['age'] ?></td>
                                                <td><?= $student['address'] ?></td>
                                                <td><?= $student['course_name'] ?></td>
                                                <td>
                                                    <a href="<?= site_url('students/edit/' . $student['students_id']) ?>" class="btn btn-sm btn-info">Edit</a>
                                    
                                                    <?php if (session()->get('role') === 'admin'): ?>
                                                    <a href="students/delete/<?= $student['students_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
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
