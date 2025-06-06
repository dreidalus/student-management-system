<?= $this->include('templates/header') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Attendance Records</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active">Attendance</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Attendance</h3>
                    <div class="card-tools">
                    <?php if (in_array(session()->get('role'), ['admin', 'teacher'])): ?>
                            <a href="/attendance/add" class="btn btn-primary">Add a Record</a>
                            <?php endif; ?>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('message')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('message') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (empty($attendance)): ?>
                        <div class="alert alert-warning">
                            No attendance records found!
                        </div>
                    <?php else: ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Student Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Remarks</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($attendance as $record): ?>
                                    <tr>
                                        <td><?= $record['attendance_id'] ?></td>
                                        <td><?= $record['student_name'] ?></td>
                                        <td><?= $record['date_today'] ?></td>
                                        <td>
    <?php if ($record['status_student'] === 'Absent'): ?>
        <span class="badge badge-warning">Absent</span>
    <?php elseif ($record['status_student'] === 'Late'): ?>
        <span class="badge badge-success">Late</span>
    <?php elseif ($record['status_student'] === 'Present'): ?>
        <span class="badge badge-primary">Present</span>
    <?php endif; ?>
</td>

                                        <td><?= $record['remarks'] ?></td>
                                        <td>
                                        <?php if (in_array(session()->get('role'), ['admin', 'teacher'])): ?>
                                                    <a href="/attendance/edit/<?= $record['attendance_id'] ?>" class="btn btn-sm btn-info">Edit</a>
                                                    <?php endif; ?>

                                                    <?php if (session()->get('role') === 'admin'): ?>
                                                    <a href="/attendance/delete/<?= $record['attendance_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                                    <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</div>
