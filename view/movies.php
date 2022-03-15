<?php
if(!isset($_REQUEST["movieId"])){
    echo "<body class='page'>";
    foreach($movieList as $mId){
    $movies -> set_movie($mId, $conn);
    echo '<p><a href ="index.php?page=movies&movieId='.$mId.'">' .$movies -> get_nev().'</a></p>';
    }
} else {
    $movies -> set_movie($_REQUEST["movieId"], $conn);
    ?>
    <div style='background-image: url(images/<?= $movies -> get_hatter() ?>);background-repeat: no-repeat; background-attachment: scroll; background-size: cover; height: 50em; margin-top: 0;'>
        <?php
        echo '<h1 class="cim">' .$movies -> get_nev().'</h1>';
        ?>
        </div>
    <div class="feloldal">
    <?php
    echo '<p>' .$movies -> get_mufaj().'</p>';
    echo '<div>' .$movies -> get_info().'</div>';
    if(isset($_SESSION['id'])){
?>

<div class="rating-stars">
    <h4 class="text-center mt-2 mb-4">
        <i class="bi bi-star submit_star mr-1 star" id="submit_star_1" data-rating="1"></i>
        <i class="bi bi-star submit_star mr-1 star" id="submit_star_2" data-rating="2"></i>
        <i class="bi bi-star submit_star mr-1 star" id="submit_star_3" data-rating="3"></i>
        <i class="bi bi-star submit_star mr-1 star" id="submit_star_4" data-rating="4"></i>
        <i class="bi bi-star submit_star mr-1 star" id="submit_star_5" data-rating="5"></i>
        <?php 
    echo '<span class="rating">' .$movies -> get_avgrating($_REQUEST["movieId"], $conn). '</span>';
    ?>
    </h4>
</div>
<form method="post">
<input type="textarea" name="comment" class="comm">
<input type="hidden" name="movieId" value=<?=$movies->get_id()?>>
<input type="submit" class="submit" value="Submit">
</form>
    <?php
    }

    $sql = "SELECT felhasznalonev, komment FROM `f_comment` INNER JOIN felhasznalok ON f_comment.felhasznalo_id = felhasznalok.id WHERE film_id=".$movies -> get_id()."";

    if($result = $conn->query($sql)) {
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
                <div class="koment">
                <?php
                if(isset($_REQUEST['editId'])&&$_REQUEST['editId']==$row['id']){
                    echo $row['felhasznalonev'].": ";
                    ?>
                    <form method="post">
                    <input type="textarea" name="editcomment" class="comm" value="<?=$row['komment']?>">
                    <input type="hidden" name="commentId" value=<?=$row['id']?>>
                    <input type="submit" class="submit scroll" value="Submit">
                    </form>
                    <?php
                }else{
                echo $row['felhasznalonev'].": ".$row['komment'];
                }
                $felhasznalo -> set_user($_SESSION['id'], $conn);
                if(isset($_SESSION['id']) && ($_SESSION['id']==$row['felhasznalo_id'] || $felhasznalo->get_permission()>0)){?>
                <form method="post">
                <input type="submit" value="Delete" class="kk scroll">
                <input type="hidden" value="<?php echo $row['id'] ?>" name="removeId">
                </form>
                <?php
                }
                if(isset($_SESSION['id']) && $_SESSION['id']==$row['felhasznalo_id']){
                ?>
                 <div class="kk scroll"><a href="?<?php echo $_SERVER["QUERY_STRING"]."&editId=".$row['id'] ?>"> Edit </a></div>
                 <?php
                }
                 ?>
                </div>
                <?php
            }
        }
    }
?>
</div>

<script>
    var rating_data = 0;
    load_rating_data();
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
    load_rating_data();

});

function load_rating_data()
    {
        $.ajax({
            url:"controller/rating.php",
            method:"POST",
            data:{action:'movies',movieId:'<?php echo $_REQUEST['movieId']?>'},
            dataType:"JSON",
            success:function(data)
            {
                for(var count = 1; count <= data.rating; count++)
                {
                        $('#submit_star_'+count).removeClass('bi-star');

                        $('#submit_star_'+count).addClass('bi-star-fill');

                    }
            }  
        })
    }

function reset_background()
    {
        for(var count = 1; count <= 5; count++)
        {

            $('#submit_star_'+count).addClass('bi-star');

            $('#submit_star_'+count).removeClass('bi-star-fill');

        }
    }


$('.submit_star').click(function(){
    rating_data=$(this).data('rating');
    $.ajax({
        url:"index.php?page=movies&movieId=<?php echo $_REQUEST["movieId"]?>",
        method:"POST",
        data:{rating_data:rating_data},
        success:function(data)
        {
            load_rating_data();
        }
    })

});
</script>
<?php 
}
?>
</body>