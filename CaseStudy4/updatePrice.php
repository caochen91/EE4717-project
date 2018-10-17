<?php
    // $searchtype=$_POST['searchtype'];
    //$checkboxCAL = $_POST['checkboxCAL'];

    $checkboxJJ = $_POST['checkboxJJ'];
    $priceJJ = $_POST['priceJJ'];

     
    $checkboxCAL = $_POST['checkboxCAL'];
    $priceCAL = $_POST['priceCAL'];
    $CALsgl = $_POST['CALsgl'];

    $checkboxIC = $_POST['checkboxIC'];
    $priceIC = $_POST['priceIC'];
    $ICsgl = $_POST['ICsgl'];

    
    //echo "CALsgl : {$CALsgl}";
    //echo "ICsgl  : {$ICsgl}";
    
    
    $message = "";
    @ $db = new mysqli('localhost', 'f33ee', 'f33ee', 'f33ee');
    if (mysqli_connect_errno()) {
        echo 'Error: Could not connect to database.  Please try again later.';
        exit;
    }

    if($checkboxJJ == true){
        if($priceJJ >0 && $priceJJ < 100){
            $query = "UPDATE products SET price = {$priceJJ} WHERE abbre_name = 'JJ'";
            //echo $query;
            $results = $db->query($query);
            if ($results) {
                //echo  $db->affected_rows." prices updated.";
                $message = "{$message} Product JJ has been updated to $ {$priceJJ}. ";
            } else {
                $message = "An error has occurred.  The prices are not updated." . $db->error;
            }
        }
    }

    if($checkboxCAL == true){
        if($priceCAL >0 && $priceCAL < 100){
            if($CALsgl == true){
                $query = "UPDATE products SET price = {$priceCAL} WHERE abbre_name = 'CALsgl'";
                $message =  "{$message} Product CALsgl has been updated to $ {$priceCAL}." ;
            }  
            else{
                $query = "UPDATE products SET price = {$priceCAL} WHERE abbre_name = 'CALdbl'";
                $message = "{$message} Product CALdbl has been updated to $ {$priceCAL}.";
            }

            //echo $query;
            $results = $db->query($query);
            if ($results) {
                //echo  $db->affected_rows." prices updated.";
            } else {
                $message =  "An error has occurred.  The prices are not updated." . $db->error;
            }
        }
    }

    if($checkboxIC == true){
        if($priceIC >0 && $priceIC < 100){
            if($ICsgl == true){
                $query= "UPDATE products SET price = {$priceIC} WHERE abbre_name = 'ICsgl'";
                $message = "{$message} Product ICsgl has been updated to $ {$priceIC}. ";
            }
            else{
                $query = "UPDATE products SET price = {$priceIC} WHERE abbre_name = 'ICdbl'";
                $message = "{$message} Product ICsgl has been updated to $ {$priceIC}.";
            }
            //echo $query;
            $results = $db->query($query);
            if ($results) {
                //echo  $db->affected_rows." prices updated.";
            } else {
                $message  = "An error has occurred.  The prices are not updated." . $db->error;
            }
        }
    }
    //header('Location: '.$_SERVER['REQUEST_URI']);
    //$results->free();
    $db->close();

    if($message !=""){
    echo "<script>
    alert('{$message}');
    window.location.href ='admin.php'; 
</script>";
    }

    //sleep(1);
    //Moving back to admin.php
    // header("Location: admin.php");
    // exit;


    
    
?>