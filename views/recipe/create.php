<div class='form addRecipe'>
    <form action="/recipe/add" method="POST" enctype="multipart/form-data">
        <div class="container">
            <h1>Create new recipe </h1>

            <div class='inputs'>
                <label for="name"><b>Name</b></label>
                <input type="text" placeholder="" name="name" id="name" required>
                <div class='validAlert'></div>
            </div>
            <div class='inputs'>
                <label for="description"><b>Description</b></label>
                <textarea name="description" id="description" cols="30" rows="4" required></textarea>
                <div class='validAlert'></div>
            </div>
            <div class='inputs'>
                <label for="ingredients"><b>Ingredients</b></label>
                <textarea name="ingredients" id="ingredients" cols="30" rows="3" required></textarea>
                <div class='validAlert'></div>
            </div>
            <div class='inputs'>
                <label for="time"><b>Cooking time</b></label>
                <input type="number" name="time" id="time" required>
                <div class='validAlert'></div>
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
            </div>
            <div class='inputs'>
                <label for="photo"><b>Add photo</b></label>
                <input type="file" placeholder="Add photo" name="photo" id="photo" class="">
            </div>
            <button type="submit" class="registerbtn">Add new recipe</button>
        </div>
    </form>
</div>