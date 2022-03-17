<?php
if(!isset($_REQUEST["actorsId"])){
    echo "<body class='page'>";
    foreach($actorsList as $aId){
    $actors -> set_actors($aId, $conn);
    echo '<p><a href ="index.php?page=actors&actorsId='.$aId.'">' .$actors -> get_nev().'</a></p>';
    }
} else {
    $actors -> set_actors($_REQUEST["actorsId"], $conn);
    ?>
    <div style='background-image: url(images/<?= $actors -> get_hatter() ?>);background-repeat: no-repeat; background-attachment: scroll; background-size: cover; height: 50em; margin-top: 0;'>
        <?php
        echo '<h1 class="cim">' .$actors -> get_nev().'</h1>';
        ?>
        </div>
    <div class="feloldal">
    <?php
    echo '<p>' .$actors -> get_nem().'</p>';
    echo '<div class="info">' .$actors -> get_info().'</div>';
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
    echo '<span class="rating"> </span>';
    ?>
    </h4>
</div>
<form method="post" id="sc">
    <input type="textarea" name="comment" class="comm">
    <input type="hidden" name="actorsId" value=<?=$actors->get_id()?>>
    <input type="submit" class="submit" value="Submit" onclick="saveScroll('sc')">
    </form>
    <?php
    }

    $sql = "SELECT sz_comment.id, felhasznalo_id, felhasznalonev, komment FROM `sz_comment` INNER JOIN felhasznalok ON sz_comment.felhasznalo_id = felhasznalok.id WHERE szinesz_Id=".$actors -> get_id()."";

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
                
                if(isset($_SESSION['id'])) {
                    $felhasznalo -> set_user($_SESSION['id'], $conn);
                    if($_SESSION['id']==$row['felhasznalo_id'] || $felhasznalo->get_permission()>0){?>
                <form method="post">
                <input type="submit" value="Delete" class="kk scroll">
                <input type="hidden" value="<?php echo $row['id'] ?>" name="removeId">
                </form>
                <?php
                }
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
    load_avgrating();

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
        load_avgrating();
    }

function reset_background()
    {
        for(var count = 1; count <= 5; count++)
        {

            $('#submit_star_'+count).addClass('bi-star');

            $('#submit_star_'+count).removeClass('bi-star-fill');

        }
    }


function load_avgrating(){
    $.ajax({
            url:"controller/rating.php",
            method:"POST",
            data:{action:'actors_avgrating',actorsId:'<?php echo $_REQUEST['actorsId']?>'},
            dataType:"JSON",
            success:function(data)
            {
                $(".rating").html(data['avg']);
            }  
        })
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

/*function saveScroll(form)
    {
        const urlParams = new URLSearchParams(window.location.search);
        var path="";
        for (const [key, value] of urlParams.entries()) {
            path+=key+"="+value+"&";
        }
        path+="scroll="+window.scrollY;
        document.getElementById(form).action = "index.php?"+tomb;
    }*/
</script>
<?php 
}
?>
</body>