<div class='form'>
    <form action="/recipe/add" method="POST" enctype="multipart/form-data">
        <div class="container">


            <div class='inputs'>
                <label for="title"><b>Title</b></label>
                <input type="text" placeholder="Enter name" name="title" id="title" class="">
            </div>

            <div class='inputs'>
                <label for="description"><b>Description</b></label>
                <textarea rows="4" cols="50" placeholder="Enter Description" name="description" id="description" class=""></textarea>
            </div>

            <div class='inputs'>
                <label for="ingredients"><b>Ingredients</b></label>
                <textarea rows="4" cols="50" placeholder="Enter Ingredients" name="ingredients" id="ingredients" class=""></textarea>
            </div>

            <div class='inputs'>
                <label for="prep_time"><b>Preparation time</b></label>
                <input type="number" placeholder="Set minutes" name="prep_time" id="prep_time" class="">
            </div>

            <div class='inputs'>
                <label for="level">Choose a level:</label>
                <select name="level" id="level">
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


            <button type="submit" class="registerbtn">Register</button>
            <p>Already have an account? <a href="/login">Sign in</a>.</p>
        </div>
    </form>
</div>