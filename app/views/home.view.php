<h1>Home view page</h1>
<form method="post">
    <!-- Username -->
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" value="<?= old_value('username') ?>">
        <div><?= $user->getError('username') ?></div><br>
    </div>
    <!-- Email -->
    <div>
        <label for="email">Email</label>
        <input type="text" name="email" value="<?= old_value('email') ?>">
        <div><?= $user->getError('email') ?></div><br>
    </div>
    <!-- Password -->
    <div>
        <label for="password">Password</label>
        <input type="text" name="password" value="<?= old_value('password') ?>">
        <div><?= $user->getError('password') ?></div><br>
    </div>
    <!-- Submit -->
    <div>
        <button>Signup</button>
    </div>
</form>