<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "starvelater");
//$columns = array('order_Id', 'item_ids', 'Restaurant_ID', 'Customer_ID', 'Order_Type','Order_Date','Order_Status','Net_Bill');
if($_POST["is_date_search"] == "no") {
 $query_original = "SELECT * FROM orders GROUP BY order_Id HAVING Restaurant_ID='".$_POST['res_id']."' ";
}


/*//Fetching order ID's in Unique Way
$sql = "SELECT * from orders WHERE Restaurant_ID='".$_POST['res_id']."'";
$result = mysqli_query($connect,$sql);
$arr = array();
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
   $arr[] = $row['order_Id'];
}
$uniq_orders = array_unique($arr);
$uniq_orderIDs = array_values($uniq_orders);*/





$query = "SELECT * FROM orders GROUP BY order_Id HAVING ";

if($_POST["is_date_search"] == "yes")
{
 $query .= 'Restaurant_ID="'.$_POST["res_id"].'" AND (Order_Date BETWEEN "'.$_POST["start_date"].'" AND "'.$_POST["end_date"].'") AND ';
}

if(isset($_POST["search"]["value"]))
{
 $query .= '
  (order_Id LIKE "%'.$_POST["search"]["value"].'%" 
  OR Customer_ID LIKE "%'.$_POST["search"]["value"].'%" 
  OR item_ids LIKE "%'.$_POST["search"]["value"].'%" 
  OR Net_Bill LIKE "%'.$_POST["search"]["value"].'%")
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY order_Id DESC ';
}




$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}


if($_POST["is_date_search"] == "yes") {
$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));
$result = mysqli_query($connect, $query . $query1);

$data = array();
} else {
 $number_filter_row = mysqli_num_rows(mysqli_query($connect, $query_original));
 $result = mysqli_query($connect, $query_original);

$data = array();
}

$destin_location="restaurant_load_order.php?order_Id=";


	while($row = mysqli_fetch_array($result))
	{
	 $sub_array = array();
	 $sub_array[] = '<a href="'.$destin_location.$row['order_Id'].'">'.$row["order_Id"].'</a>';
	 $sub_array[] = $row["Order_Type"];
	 $sub_array[] = $row["Order_Date"];
	 $sub_array[] = $row["Order_Status"];

     //Calculating Sum of Orders
	 $sql = "SELECT sum(Net_Bill) from orders where order_Id='".$row["order_Id"]."'";
	 $work = mysqli_query($connect,$sql);
     $workArr = mysqli_fetch_array($work);

	 $sub_array[] = '₹ '.number_format($workArr[0],2);
	 $data[] = $sub_array;
	}

function get_all_data($connect)
{
 $query = "SELECT * FROM orders GROUP BY order_Id HAVING Restaurant_ID='".$_POST['res_id']."' ";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>