<div class='mainpage'>
    <nav>
        <ul class='topPanel'>
            <li>
                <a href="/"><h1>CookBook</h1></a>
            </li>
            <li>
                <form class='seraching'action="/" method="POST">
                    <input type="text" name="search" id="search" required>
                    <button type="submit">Search</button>
                </form>
            </li>
            <?php if(!\app\core\Session::isLogin()): ?>
                <li><button><a href="/register">Register</a></button></li>
                <span></span>
                <li><button><a href="/login">Log in</a></button></li>
            <?php else: ?>
                <li>Welcome, <?php echo \app\core\Session::get('user')['NICKNAME'] ?></li>
                <span></span>
                <li><button><a href="/logout">Logout</a></button></li>
                <span></span>
                <li><button><a href="/recipe/add">Add recipe</a></button></li>
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

        <?php if(!empty($lastRecipe) && !empty($allRecipes)): ?>
        <section class='lastRecipe'>
            <h1>Last added recipe</h1>
            <div class='lastRecipe'>
                <img src='uploads/<?php echo $lastRecipe['IMAGE']; ?>' alt="">
                <div class='lastRecipeDescription'>
                    <h2><?php echo $lastRecipe['TITLE']; ?></h2>
                    <p><?php echo \app\helpers\UtilHelper::cutString($lastRecipe['DESCRIPTION'], 300, true); ?></p><br>
                    <a href="/recipe/show?id=<?php echo $lastRecipe['ID']; ?>">Show details</a>
                </div>

            </div>
        </section>
        <section>
            <h1>Previous recipes</h1>
            <div class='previousRecipes'>
                <?php foreach($allRecipes as $key => $recipe): ?>
                    <div class='previousRecipe'>
                        <img src='uploads/<?php echo $recipe['IMAGE']; ?>' alt="food picture">
                        <h3><?php echo $recipe['TITLE']; ?></h3>
                        <p><?php echo \app\helpers\UtilHelper::cutString($recipe['DESCRIPTION'], 300, true); ?></p>
                        <a href="/recipe/show?id=<?php echo $recipe['ID']; ?>">Show details</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

        <?php if(!empty($searchRecipes)): ?>
            <section>
                <h1>Search results</h1>
                <div class='previousRecipes'>
                    <?php foreach($searchRecipes as $key => $recipe): ?>
                        <div class='previousRecipe'>
                            <img src='uploads/<?php echo $recipe['IMAGE']; ?>' alt="food picture">
                            <h3><?php echo $recipe['TITLE']; ?></h3>
                            <p><?php echo \app\helpers\UtilHelper::cutString($recipe['DESCRIPTION'], 300, true); ?></p>
                            <a href="/recipe/show?id=<?php echo $recipe['ID']; ?>">Show details</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>
    </main>
</div>