<div class='mainpage'>
    <nav>
        <ul class='topPanel'>
            <li>
                <h1>CookBook</h1>
            </li>
            <?php if(!\app\core\Session::isLogin()): ?>
                <li><button><a href="/register">Register</a></button></li>
                <span></span>
                <li><button><a href="/login">Log in</a></button></li>
            <?php else: ?>
                <li>Welcome, <?php echo \app\core\Session::get('user')['NICKNAME'] ?></li>
                <span></span>
                <li><button><a href="/logout">Logout</a></button></li>
            <?php endif; ?>
    </nav>
    <header>
        <div>
            <h1>CookBook</h1> <br>
            <h2>Place for all your recipes. <br>
                Create, save and be inspired by others </h2>
        </div>
    </header>
    <main>
        <section class='lastRecipe'>
            <h1>Last added recipe</h1>
            <div class='lastRecipe'><img src='recipesphotos/pizza-ge5de67356_640.jpg' alt="">
                <div class='lastRecipeDescription'>
                    <h2><?php echo $lastRecipe['TITLE']; ?></h2>
                    <p><?php echo $lastRecipe['DESCRIPTION']; ?></p><br>
                    <a href="/recipe/show?id=<?php echo $lastRecipe['ID']; ?>">Show details</a>
                </div>

            </div>
        </section>
        <section>
            <h1>Previous recipes</h1>
            <div class='previousRecipes'>
                <?php foreach($allRecipes as $key => $recipe): ?>
                    <div class='previousRecipe'><img src='recipesphotos/salad-g62ccdc077_640.jpg' alt="salad">
                        <h3><?php echo $recipe['TITLE']; ?></h3>
                        <p><?php echo $recipe['DESCRIPTION']; ?></p>
                        <a href="/recipe/show?id=<?php echo $lastRecipe['ID']; ?>">Show details</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>


    </main>