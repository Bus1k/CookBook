<div class='form addRecipe'>
    <form action="/recipe/add" method="POST" enctype="multipart/form-data">
        <div class="container">
            <h1>Create new recipe </h1>

            <div class='inputs'>
                <label for="title"><b>Title</b></label>
                <input type="text" placeholder="" name="title" id="title" required class="<?php echo $model->hasErrors('title') ? 'validAlert' : ''; ?>" value="<?php echo $data['title'] ?? ''; ?>">
                <div class='validAlert'><?php echo $model->getFirstError('title'); ?></div>
            </div>
            <div class='inputs'>
                <label for="description"><b>Description</b></label>
                <textarea name="description" id="description" cols="30" rows="4" required><?php echo $data['description'] ?? ''; ?></textarea>
                <div class='validAlert'><?php echo $model->getFirstError('description'); ?></div>
            </div>
            <div class='inputs'>
                <label for="ingredients"><b>Ingredients</b></label>
                <textarea name="ingredients" id="ingredients" cols="30" rows="3" required><?php echo $data['ingredients'] ?? ''; ?></textarea>
                <div class='validAlert'><?php echo $model->getFirstError('ingredients'); ?></div>
            </div>
            <div class='inputs'>
                <label for="time"><b>Cooking time</b></label>
                <input type="number" min="0" step="5" name="time" id="time" required class="<?php echo $model->hasErrors('time') ? 'validAlert' : ''; ?>" value="<?php echo $data['time'] ?? ''; ?>">
                <div class='validAlert'><?php echo $model->getFirstError('time'); ?></div>
            </div>
            <div class='inputs'>
                <label for="level"><b>Choose a level</b></label>
                <select name="level" id="level" required>
                    <option value="">--Please choose an option--</option>
                    <option value="beginner">Beginner</option>
                    <option value="elementary">Elementary</option>
                    <option value="intermediate">Intermediate</option>
                    <option value="advanced">Advanced</option>
                </select>
                <div class='validAlert'><?php echo $model->getFirstError('level'); ?></div>
            </div>
            <div class='inputs'>
                <label for="photo"><b>Add photo</b></label>
                <input type="file" placeholder="Add photo" name="photo" id="photo" class="">
            </div>
            <button type="submit" class="registerbtn">Add new recipe</button>
        </div>
    </form>
</div>