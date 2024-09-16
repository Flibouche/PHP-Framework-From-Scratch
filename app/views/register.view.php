<h1>Register View Page</h1>
<form method="post">
    <!-- Username -->
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" value="<?= old_value('username') ?>" placeholder="Username" require>
        <div><?= $user->getError('username') ?></div><br>
    </div>
    <!-- Email -->
    <div>
        <label for="email">Email</label>
        <input type="text" name="email" value="<?= old_value('email') ?>" placeholder="Email" require>
        <div><?= $user->getError('email') ?></div><br>
    </div>
    <!-- Password -->
    <div>
        <label for="password">Password</label>
        <input type="text" name="password" value="<?= old_value('password') ?>" placeholder="********" require>
        <div><?= $user->getError('password') ?></div><br>
    </div>
    <!-- Submit -->
    <div>
        <button>Register</button>
    </div>
</form>