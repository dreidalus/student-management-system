<?= $this->include('templates/header') ?>

<div class="container p-5">
    <h1>Edit Attendance</h1>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form method="post" action="<?= site_url('attendance/update/' . $attendance['attendance_id']) ?>">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label class="form-label" for="student_id">Student</label>
            <select name="student_id" id="student_id" class="form-control" required>
                <option value="">Select a student</option>
                <?php foreach ($students as $student): ?>
                    <option value="<?= $student['students_id']; ?>" <?= $attendance['student_id'] == $student['students_id'] ? 'selected' : ''; ?>>
                        <?= $student['first_name'] . ' ' . $student['last_name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date_today" class="form-control" value="<?= $attendance['date_today'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status_student" class="form-control" required>
            <option value="Absent" <?= $attendance['status_student'] == 'Absent' ? 'selected' : '' ?>>Absent</option>
<option value="Late" <?= $attendance['status_student'] == 'Late' ? 'selected' : '' ?>>Late</option>
<option value="Present" <?= $attendance['status_student'] == 'Present' ? 'selected' : '' ?>>Present</option>

            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Remarks (Optional)</label>
            <input type="text" name="remarks" class="form-control" value="<?= $attendance['remarks'] ?>">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="<?= site_url('attendance') ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>
