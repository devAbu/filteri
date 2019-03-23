<?php

//fetch_data.php

include('connection/connect.php');

if(isset($_POST["action"]))
{
	$query = "
		SELECT * FROM product WHERE product_status = '1'
	";
	if(isset($_POST["brand"]))
	{
		$brand_filter = implode("','", $_POST["brand"]);
		$query .= "
		 AND product_brand IN('".$brand_filter."')
		";
	}
    
    $result = $dbc->query($query);

    $count = $result->num_rows;

	/* $statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount(); */
	$output = '';
	if($count > 0)
	{
		foreach($result as $row)
		{
			$output .= '
			<div class="col-sm-4 col-lg-3 col-md-3">
				<div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:200px;">
					
					<p align="center"><strong>'. $row['product_name'] .'</strong></p>
					<h4 style="text-align:center;" class="text-danger" >'. $row['product_price'] .'</h4>
					<p>Camera : '. $row['product_camera'].' MP<br />
					Brand : '. $row['product_brand'] .' <br />
					RAM : '. $row['product_ram'] .' GB<br />
					Storage : '. $row['product_storage'] .' GB </p>
				</div>

			</div>
			';
		}
	}
	else
	{
		$output = '<h3>No Data Found</h3>';
	}
	echo $output;
}

?>