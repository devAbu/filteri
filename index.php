<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FILTERI - UCENJE</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    
</head>
<body>
    
<div class="list-group">
    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
    <?php
    require 'connection/connect.php';

    $query = "SELECT DISTINCT(product_brand) FROM product WHERE product_status = '1' ORDER BY product_id DESC";
    $result = $dbc->query($query);

    $count = $result->num_rows;
    if($count != 0){
        echo '<h3>Brand</h3>';
    }
    foreach($result as $row)
    {
    ?>
    <div class="list-group-item checkbox">
        <label><input type="checkbox" class="common_selector brand" value="<?php echo $row['product_brand']; ?>"  > <?php echo $row['product_brand']; ?></label>
    </div>
    <?php
    }

    ?>
    </div>
</div>

<div class="row filter_data">

<script>
$(document).ready(function(){

    filter_data();

    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';

        
        var brand = get_filter('brand');
        
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action,  brand:brand},
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

});
</script>


</body>
</html>