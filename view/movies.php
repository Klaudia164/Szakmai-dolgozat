<?php
if(!isset($_REQUEST["movieId"])){
    echo "<body class='page'>";
    foreach($movieList as $mId){
    $movies -> set_movie($mId, $conn);
    echo '<p><a href ="index.php?page=movies&movieId='.$mId.'">' .$movies -> get_nev().'</a></p>';
    }
} else {
    $movies -> set_movie($_REQUEST["movieId"], $conn);
    echo "<body style='background-image: url(images/".$movies -> get_hatter().");background-repeat: no-repeat; background-attachment: fixed;'>";
    echo '<h1>' .$movies -> get_nev().'</h1>';
    echo '<p>' .$movies -> get_mufaj().'</p>';
    echo '<p>' .$movies -> get_info().'</p>';
    if(isset($_SESSION['id'])){
    ?>
    <form method="post">
    <input type="textarea" name="comment">
    <input type="hidden" name="movieId" value=<?=$movies->get_id()?>>
    <input type="submit">
    </form>
    <?php
    }

    $sql = "SELECT felhasznalonev, komment FROM `f_comment` INNER JOIN felhasznalok ON f_comment.felhasznalo_id = felhasznalok.id WHERE film_id=".$movies -> get_id()."";

    if($result = $conn->query($sql)) {
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo $row['felhasznalonev']." ".$row['komment'];
            }
        }
    }


?>

<div class="rating-stars">
    <h4 class="text-center mt-2 mb-4">
        <i class="bi bi-star submit_star mr-1" id="submit_star_1" data-rating="1"></i>
        <i class="bi bi-star submit_star mr-1" id="submit_star_2" data-rating="2"></i>
        <i class="bi bi-star submit_star mr-1" id="submit_star_3" data-rating="3"></i>
        <i class="bi bi-star submit_star mr-1" id="submit_star_4" data-rating="4"></i>
        <i class="bi bi-star submit_star mr-1" id="submit_star_5" data-rating="5"></i>
    </h4>
</div>

<script>
    var rating_data = 0;

$(document).on('mouseenter', '.submit_star', function(){

    var rating = $(this).data('rating');

    reset_background();

    for(var count = 1; count <= rating; count++)
    {
        $('#submit_star_'+count).removeClass('bi-star');

        $('#submit_star_'+count).addClass('bi-star-fill');

    }

});

$(document).on('mouseleave', '.rating-stars', function(){

reset_background();

});

function reset_background()
    {
        for(var count = 1; count <= 5; count++)
        {

            $('#submit_star_'+count).addClass('bi-star');

            $('#submit_star_'+count).removeClass('bi-star-fill');

        }
    }

</script>
<?php 
}
?>
</body>