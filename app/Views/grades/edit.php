<?= $this->include('templates/header') ?>

<div class="container p-5">
    <h1>Edit Grade</h1>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form method="post" action="<?= site_url('grades/update/' . $grade['grades_id']) ?>">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label class="form-label" for="student_id">Student</label>
            <select name="student_id" id="student_id" class="form-control" required>
                <option value="">Select a student</option>
                <?php foreach ($students as $student): ?>
                    <option value="<?= $student['students_id']; ?>" <?= $student['students_id'] == $grade['student_id'] ? 'selected' : ''; ?>>
                        <?= $student['first_name'] . ' ' . $student['last_name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">First Semester Grade</label>
            <input type="number" name="grade_first_sem" class="form-control" min="1" max="100" value="<?= $grade['grade_first_sem'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Second Semester Grade</label>
            <input type="number" name="grade_second_sem" class="form-control" min="1" max="100" value="<?= $grade['grade_second_sem'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Year Start</label>
            <input type="date" name="year_start" class="form-control" value="<?= $grade['year_start'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Year End</label>
            <input type="date" name="year_end" class="form-control" value="<?= $grade['year_end'] ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="<?= site_url('grades') ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>
