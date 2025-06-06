<?= $this->include('templates/header') ?>
<div class="container p-5">
    <h1>Add New Student</h1>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    <form method="post" action="/students/store">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control" value="<?= old('first_name') ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" value="<?= old('last_name') ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Phone Number</label>
            <input type="text" name="phone_number" class="form-control" value="<?= old('phone_number') ?>" pattern="(\+63|09)\d{9}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= old('email') ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Age</label>
            <input type="number" name="age" class="form-control" value="<?= old('age') ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="address" class="form-control" value="<?= old('address') ?>" required>
        </div>

        <div class="mb-3">
        <label class="form-label">Course</label>
    <select name="courses_id" class="form-control" required>
        <option value="">Select Course</option>
        <?php foreach ($courses as $course): ?>
            <option value="<?= $course['course_id'] ?>" <?= old('courses_id') == $course['course_id'] ? 'selected' : '' ?>>
                <?= $course['course_name'] ?>
            </option>
        <?php endforeach; ?>
    </select>
    </select>


        <button type="submit" class="btn btn-primary">Save</button>
        <a href="/students" class="btn btn-secondary">Cancel</a>
    </form>
</div>
