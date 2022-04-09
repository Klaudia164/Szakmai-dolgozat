<div>
    <form method="post" enctype="multipart/form-data">
        <select name="type" class="select" id="type" onchange="type_change()">
            <option value="0"> Select type </option>
            <option value="Movie">Movie</option>
            <option value="Series">Series</option>
            <option value="Actor/actress">Actor/actress</option>
        </select>
        <div id="actors" class="up">
            <label for="name" class="label">Name: </label>
            <input type="text" name="name" class="upload"><br><br>
            <label for="gender" class="label">Gender: </label>
            <input type="text" name="gender" class="upload"><br><br>
            <label for="inform" class="label">Information: </label>
            <textarea name="ainfo" rows="4"></textarea><br><br>
            <input type="file" name="abg"><br><br>
            <input type="submit" class="submit" value="Submit">
        </div>
        <div id="movie/series" class="up">
            <label for="name" class="label">Title: </label>
            <input type="text" name="title" class="upload"><br><br>
            <label for="genre" class="label">Genre: </label>
            <input type="text" name="genre" class="upload"><br><br>
            <label for="info" class="label">Information: </label>
            <textarea name="info" rows="4"></textarea><br><br>
            <input type="file" name="bg"><br><br>
            <input type="submit" class="submit" value="Submit">
        </div>
    </form>
</div>
<br>
<?php
    echo $uploadError;
?>
<script>
    document.getElementById("actors").style.display = "none";
    document.getElementById("movie/series").style.display = "none";
    function type_change(){
        var type = document.getElementById("type").value;
        if(type == "Movie" || type == "Series"){
            document.getElementById("movie/series").style.display = "block";
            document.getElementById("actors").style.display = "none";
        }else if(type == "Actor/actress"){
            document.getElementById("actors").style.display = "block";
            document.getElementById("movie/series").style.display = "none";
        }else{
            document.getElementById("actors").style.display = "none";
            document.getElementById("movie/series").style.display = "none";
        }
    }
</script>