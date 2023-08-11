<?php require "../admin/include/header.php"; ?>
<?php $users = User::getAll($pdo); ?>
<div class="container mt-5" style="height: 450px;">
    <div class="row mb-3">
        <div class="col">
            <a href="new-user.php" class="btn btn-success">New account</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $user): ?>
                        <tr>
                            <td><?= $user->username ?></td>
                            <td><?= $user->password ?></td>
                            <?php if($user->username != 'admin'): ?>
                            <td><a href="edit-user.php?username=<?= $user->username ?>" class="btn btn-primary">Change password</a> <a href="delete-user.php?username=<?= $user->username ?>" class="btn btn-danger">Delete</a></td>
                            <?php else: ?>
                            <td><a href="edit-user.php?username=<?= $user->username ?>" class="btn btn-primary">Change password</a></td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require "../admin/include/footer.php"?>