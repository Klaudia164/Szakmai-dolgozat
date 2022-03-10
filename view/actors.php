<body class="page">
<?php
if(!isset($_REQUEST["actorsId"])){

    foreach($actorsList as $aId){
    $actors -> set_actors($aId, $conn);
    echo '<p><a href ="index.php?page=actors&actorsId='.$aId.'">' .$actors -> get_nev().'</a></p>';
    }
} else {
    $actors -> set_actors($_REQUEST["actorsId"], $conn);
    ?>
    <div class="feloldal">
        <div class="font3">
    <?php
    echo "<body style='background-image: url(images/".$actors -> get_hatter().");background-repeat: no-repeat; background-attachment: fixed; background-size: cover;'>";
    echo '<h1>' .$actors -> get_nev().'</h1>';
    echo '<p>' .$actors -> get_nem().'</p>';
    echo '<div>' .$actors -> get_info().'</div>';
    ?>
    </div>
    </div>
    <?php
    if(isset($_SESSION['id'])){
?>


<div class="rating-stars">
    <h4 class="text-center mt-2 mb-4">
        <i class="bi bi-star submit_star mr-1 star" id="submit_star_1" data-rating="1"></i>
        <i class="bi bi-star submit_star mr-1 star" id="submit_star_2" data-rating="2"></i>
        <i class="bi bi-star submit_star mr-1 star" id="submit_star_3" data-rating="3"></i>
        <i class="bi bi-star submit_star mr-1 star" id="submit_star_4" data-rating="4"></i>
        <i class="bi bi-star submit_star mr-1 star" id="submit_star_5" data-rating="5"></i>
    </h4>
</div>
<form method="post">
    <input type="textarea" name="comment" class="comm">
    <input type="hidden" name="actorsId" value=<?=$actors->get_id()?>>
    <input type="submit" class="submit">
    </form>
    <?php
    }

    $sql = "SELECT felhasznalonev, komment FROM `sz_comment` INNER JOIN felhasznalok ON sz_comment.felhasznalo_id = felhasznalok.id WHERE szinesz_Id=".$actors -> get_id()."";

    if($result = $conn->query($sql)) {
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo $row['felhasznalonev']." ".$row['komment'];
            }
        }
    }


?>

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
            data:{action:'actors',actorsId:'<?php echo $_REQUEST['actorsId']?>'},
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
        url:"index.php?page=actors&actorsId=<?php echo $_REQUEST["actorsId"]?>",
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