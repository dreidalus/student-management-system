<?= $this->include('templates/header') ?>

<div class="container p-5">
    <h1>Edit Course</h1>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form method="post" action="/courses/update/<?= $course['course_id'] ?>">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label class="form-label">Course Name</label>
            <input type="text" name="course_name" class="form-control" value="<?= old('course_name', $course['course_name']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Course Code</label>
            <input type="text" name="course_code" class="form-control" value="<?= old('course_code', $course['course_code']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Course Information</label>
            <input type="text" name="course_information" class="form-control" value="<?= old('course_information', $course['course_information']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Course Description</label>
            <input type="text" name="course_description" class="form-control" value="<?= old('course_description', $course['course_description']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Course College</label>
            <input type="text" name="course_college" class="form-control" value="<?= old('course_college', $course['course_college']) ?>" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="/courses" class="btn btn-secondary">Cancel</a>
    </form>
</div>

