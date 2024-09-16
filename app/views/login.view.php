<h1>Login View Page</h1>
<form method="post">
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
        <button>Login</button>
    </div>
</form>