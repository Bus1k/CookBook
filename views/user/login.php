<div class='form'>
    <form action="/login" method="POST">
        <div class="container">
            <h1>Log in </h1>
            <p>Please fill in this form to log in to your account.</p>

            <div class='inputs'>
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email" id="email" required class="<?php echo $model->hasErrors('email') ? 'validAlert' : ''; ?>" value="<?php echo $data['email'] ?? ''; ?>">
                <div class='validAlert'><?php echo $model->getFirstError('email'); ?></div>
            </div>

            <div class='inputs'>
                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" id="password" required class="<?php echo $model->hasErrors('password') ? 'validAlert' : ''; ?>">
                <div class='validAlert'><?php echo $model->getFirstError('password'); ?></div>
            </div>
            <button type="submit" class="registerbtn">Log in</button>

            <p>You don't have account? <a href="/register">Register</a>.</p>
        </div>
    </form>
</div>