<div class='form'>
    <form action="action_page.php">
        <div class="container">
            <h1>Log in </h1>
            <p>Please fill in this form to log in to your account.</p>

            <div class='inputs'>
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email" id="email" required>
                <div class='validAlert'></div>
            </div>
            <div class='inputs'>
                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" id="password" required>
                <div class='validAlert'></div>
            </div>
            <button type="submit" class="registerbtn">Log in</button>

            <p>You don't have account? <a href="/register">Register</a>.</p>
        </div>
    </form>
</div>