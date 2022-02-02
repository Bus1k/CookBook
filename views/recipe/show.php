<div class='singleRecipe'>
    <div class='mainPanelSingleRecipe'>
    <main class='recipe'>
        <div class='recipeTitle'>
            <h1><?php echo $recipe['TITLE']; ?></h1>

            <?php if(\app\core\Session::isLogin() && \app\core\Session::get('user')['ID'] === $recipe['USER_ID']): ?>
                <a href="/recipe/edit?id=<?php echo $recipe['ID']; ?>"><i class="fa-solid fa-pen"></i></a>
            <span></span>
                <a href="/recipe/delete?id=<?php echo $recipe['ID']; ?>"><i class="fa-solid fa-trash-can"></i></a>
            <?php endif; ?>
        </div>
        
        <div class='recipePhoto'>
            <img src="<?php echo $recipe['IMAGE']; ?>" alt="">
        </div>
        <div class='recipeDescription'>
            <div class='col1'>
                <table>
                    <tr>
                        <td><i class="fa-regular fa-user"></i></td>
                        <td><?php echo $user['NICKNAME']; ?></td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-hourglass-end"></i></td>
                        <td><?php echo $recipe['PREP_TIME']; ?> min</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-tachometer-alt"></i></td>
                        <td><?php echo $recipe['LEVEL']; ?></td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-basket-shopping"></i></td>
                        <td><?php echo $recipe['INGREDIENTS']; ?></td>
                    </tr>
                </table>
            </div>
            <div class='col2'>
                <h2>How to prepare</h2>
                <?php echo $recipe['DESCRIPTION']; ?>
            </div>
        </div>
        <div class='goback'>
            <a href="/"><i class="fa-solid fa-arrow-left"></i> Go back to main page</a>
        </div>
   </div>
    </main>
</div>