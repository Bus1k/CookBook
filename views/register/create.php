<form action="/register" method="POST">
    <div class="container">
        <h1>Register</h1>
        <p>Please fill in this form to create an account.</p>

        <label for="nickname"><b>Username</b></label>
        <input type="text" placeholder="Enter Name" name="nickname" id="nickname">

        <label for="email"><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="email" id="email">

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" id="password">

        <label for="password_confirm"><b>Password again</b></label>
        <input type="password" placeholder="Enter Password" name="password_confirm" id="password_confirm">

        <button type="submit" class="registerbtn">Register</button>

        <p>Already have an account? <a href="#">Sign in</a>.</p>
    </div>
</form>