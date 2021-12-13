<div class='form'>
    <form action="/register" method="POST">
        <div class="container">
            <h1>Register</h1>
            <p>Please fill in this form to create an account.</p>
            <div class='inputs'>
                <label for="nickname"><b>Username</b></label>
                <input type="text" placeholder="Enter name" name="nickname" id="nickname" class="<?php echo $model->hasErrors('nickname') ? 'validAlert' : ''; ?>" value="<?php echo $data['nickname'] ?? ''; ?>">
                <div class='validAlert'><?php echo $model->getFirstError('nickname'); ?></div>
            </div>
            <div class='inputs'>
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email" id="email" class="<?php echo $model->hasErrors('email') ? 'validAlert' : ''; ?>" value="<?php echo $data['email'] ?? ''; ?>">
                <div class='validAlert'><?php echo $model->getFirstError('email'); ?></div>
            </div>
            <div class='inputs'>
                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" id="password" class="<?php echo $model->hasErrors('password') ? 'validAlert' : ''; ?>">
                <div class='validAlert'><?php echo $model->getFirstError('password'); ?></div>
            </div>
            <div class='inputs'>
                <label for="password_confirm"><b>Repeat password</b></label>
                <input type="password" placeholder="Enter Password" name="password_confirm" id="password_confirm" class="<?php echo $model->hasErrors('password_confirm') ? 'validAlert' : ''; ?>">
                <div class='validAlert'><?php echo $model->getFirstError('password_confirm'); ?></div>
            </div>
            <button type="submit" class="registerbtn">Register</button>
            <p>Already have an account? <a href="/login">Sign in</a>.</p>
        </div>
    </form>
</div>