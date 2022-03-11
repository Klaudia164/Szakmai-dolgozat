<?php
if(!isset($_REQUEST["seriesId"])){
    echo "<body class='page'>";
    foreach($seriesList as $sId){
    $series -> set_series($sId, $conn);
    echo '<p><a href ="index.php?page=series&seriesId='.$sId.'">' .$series -> get_nev().'</a></p>';
    }
} else {
    $series -> set_series($_REQUEST["seriesId"], $conn);
    ?>
    <div style='background-image: url(images/<?= $series -> get_hatter() ?>);background-repeat: no-repeat; background-attachment: scroll; background-size: cover; height: 50em; margin-top: 0;'>
        <?php
        echo '<h1 class="cim">' .$series -> get_nev().'</h1>';
        ?>
        </div>
    <div class="feloldal">
    <?php
    echo '<p>' .$series -> get_mufaj().'</p>';
    echo '<div>' .$series -> get_info().'</div>';
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
                    echo '<span class="rating">' .$series -> get_avgrating($_REQUEST["seriesId"], $conn). '</span>';
                ?>
            </h4>
        </div>
        <form method="post">
            <input type="textarea" name="comment" class="comm">
            <input type="hidden" name="seriesId" value=<?=$series->get_id()?>>
            <input type="submit" class="submit" value="Submit">
            </form>
            <?php
            }
        
            $sql = "SELECT felhasznalonev, komment FROM `s_comment` INNER JOIN felhasznalok ON s_comment.felhasznalo_id = felhasznalok.id WHERE sorozat_Id=".$series -> get_id()."";
        
            if($result = $conn->query($sql)) {
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <div class="koment">
                        <?php
                        echo $row['felhasznalonev'].": ".$row['komment'];
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
                    data:{action:'series',seriesId:'<?php echo $_REQUEST['seriesId']?>'},
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
                url:"index.php?page=series&seriesId=<?php echo $_REQUEST["seriesId"]?>",
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