<?= $this->include('templates/header') ?>

<div class="container p-5">
    <h1>Add Attendance</h1>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form method="post" action="<?= site_url('attendance/store') ?>">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label class="form-label" for="student_id">Student</label>
            <select name="student_id" id="student_id" class="form-control" required>
                <option value="">Select a student</option>
                <?php foreach ($students as $student): ?>
                    <option value="<?= $student['students_id']; ?>"><?= $student['first_name'] . ' ' . $student['last_name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date_today" class="form-control" value="<?= date('Y-m-d') ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status_student" class="form-control" required>
                <option value="Absent">Absent</option>
                <option value="Late">Late</option>
                <option value="Present">Present</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Remarks (Optional)</label>
            <input type="text" name="remarks" class="form-control" placeholder="Enter remarks if any">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="<?= site_url('attendance') ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>
