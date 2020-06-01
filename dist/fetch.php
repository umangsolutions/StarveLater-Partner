<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "starvelater");
//$columns = array('order_Id', 'item_ids', 'Restaurant_ID', 'Customer_ID', 'Order_Type','Order_Date','Order_Status','Net_Bill');
if($_POST["is_date_search"] == "no") {
 $query_original = "SELECT * FROM orders WHERE Restaurant_ID='".$_POST['res_id']."'";
}


$query = "SELECT *  from orders WHERE ";

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




while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = $row["order_Id"];
 $sub_array[] = $row["item_ids"];
 $sub_array[] = $row["Order_Type"];
 $sub_array[] = $row["Order_Date"];
 $sub_array[] = $row["Order_Status"];
 $sub_array[] = $row["Net_Bill"];
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM orders where Restaurant_ID='".$_POST['res_id']."'";
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