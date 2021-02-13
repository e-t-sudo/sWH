<?php
if(isset($_POST['cat_id'])){//for editing categories
    $cat_id = $_POST['cat_id'];
    $conn = mysqli_connect("localhost", "root", "", "newbase");
    $sql_query = "select * from categories where `cat_id` = $cat_id";
    $query_result = mysqli_query($conn, $sql_query);
    if(mysqli_num_rows($query_result)>0){
        $row = mysqli_fetch_assoc($query_result);
        $category_name = $row['category'];
        $parent_id = $row['parent'];
        $display = $row['display'];
        $parent_query = "select * from categories where `cat_id` = $parent_id";
        $parent_result = mysqli_query($conn, $parent_query);
        if(mysqli_num_rows($parent_result)>0){
            $parent_name = mysqli_fetch_assoc($parent_result)['category'];
        }else{
            $parent_name = "NONE";
        }
        $response = $category_name.'<br>'.$parent_name.'<br>'.$display;
    }else{
        echo "NO RESULTS";
    }
    echo $response;
    exit;
}

if(isset($_POST['add_id'])){//for editing office addresses
    $add_id = $_POST['add_id'];
    $conn = mysqli_connect("localhost", "root", "", "newbase");
    $add_query = "select * from addresses where `address_id` = $add_id";
    $add_result = mysqli_query($conn, $add_query);
    $add_array = mysqli_fetch_assoc($add_result);
    $office_name = $add_array['office_name'];
    $city_name = $add_array['city_name'];
    $state_name = $add_array['state'];
    $pincode = $add_array['pin_code'];
    $display = $add_array['display'];
    $response = $office_name.'<br>'.$city_name.'<br>'.$state_name.'<br>'.$pincode.'<br>'.$display;
echo $response;
}
if(isset($_POST['timing_id'])){//for editing timing and schedules
    $timing_id = $_POST['timing_id'];
    $conn = mysqli_connect("localhost", "root", "", "newbase");
    $time_query = "select * from timings where `timing_id` = $timing_id";
    $time_result = mysqli_query($conn, $time_query);
    $time_array = mysqli_fetch_assoc($time_result);
    $day = $time_array['day'];
    $time_range = $time_array['time_range'];
    $display = $time_array['display'];
    $response = $day.'<br>'.$time_range.'<br>'.$display;
echo $response;
}
?>