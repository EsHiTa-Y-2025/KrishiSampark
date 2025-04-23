<?php 
require('private/database.php');
if(isset($_GET['type']) && isset($_GET['id'])){
    $type=$_GET['type'];
    $id=$_GET['id'];
    
    if($type=='Listing'){
       $delete = "UPDATE `listings` set is_deleted=:is_deleted WHERE  id=:id";
            $stm = $con->prepare($delete);
            if($stm->execute(['id'=>$id,'is_deleted'=>1])){
                echo "<script>window.history.back();</script>";
            }
    }else if($type=='Menu'){
        $delete = "DELETE FROM `header_menus` WHERE  id=:id";
            $stm = $con->prepare($delete);
            if($stm->execute(['id'=>$id])){
                echo "<script>window.history.back();</script>";
            }
            
    }else if($type=='Category'){
        // $deletepos = "DELETE FROM `posts` WHERE  cat_id=:id";
        //     $stmp = $con->prepare($deletepos);
        //     if($stmp->execute(['id'=>$id])){
                    $delete = "DELETE FROM `categories` WHERE  id=:id";
                    $stm = $con->prepare($delete);
                    if($stm->execute(['id'=>$id])){
                        echo "<script>window.history.back();</script>";
                    }
            // }  
    }
    else if($type=='Blogs'){
        $delete = "DELETE FROM `blogs` WHERE  id=:id";
            $stm = $con->prepare($delete);
            if($stm->execute(['id'=>$id])){
                echo "<script>window.history.back();</script>";
            }
    }
    else if($type=='Footermenu'){
        $delete = "DELETE FROM `footer` WHERE  id=:id";
            $stm = $con->prepare($delete);
            if($stm->execute(['id'=>$id])){
                echo "<script>window.history.back();</script>";
            }
    }
    else if($type=='Service'){
        $delete = "DELETE FROM `services` WHERE  id=:id";
            $stm = $con->prepare($delete);
            if($stm->execute(['id'=>$id])){
                echo "<script>window.history.back();</script>";
            }
    }
    else if($type=='Banner'){
        $delete = "DELETE FROM `banners` WHERE  id=:id";
            $stm = $con->prepare($delete);
            if($stm->execute(['id'=>$id])){
                echo "<script>window.history.back();</script>";
            }
    }
    else if($type=='MarketPrice'){
        $delete = "DELETE FROM `market_price` WHERE  id=:id";
            $stm = $con->prepare($delete);
            if($stm->execute(['id'=>$id])){
                echo "<script>window.history.back();</script>";
            }
    }

    else if($type=='Admin'){
        $delete = "DELETE FROM `admin` WHERE  id=:id";
            $stm = $con->prepare($delete);
            if($stm->execute(['id'=>$id])){
                echo "<script>window.history.back();</script>";
            }
    }

    else if($type=='Gallery'){
        $delete = "DELETE FROM `gallery` WHERE  id=:id";
            $stm = $con->prepare($delete);
            if($stm->execute(['id'=>$id])){
                echo "<script>window.history.back();</script>";
            }
    }

    else if($type=='Variety'){
        $delete = "DELETE FROM `more_varieties` WHERE  id=:id";
            $stm = $con->prepare($delete);
            if($stm->execute(['id'=>$id])){
                echo "<script>window.history.back();</script>";
            }
    }
    else if($type=='Consultation'){
        $delete = "DELETE FROM `consultation` WHERE  id=:id";
            $stm = $con->prepare($delete);
            if($stm->execute(['id'=>$id])){
                echo "<script>window.history.back();</script>";
            }
    }else if($type=='Section'){
        $delete = "DELETE FROM `home_sections` WHERE  id=:id";
            $stm = $con->prepare($delete);
            if($stm->execute(['id'=>$id])){
                echo "<script>window.history.back();</script>";
            }
    }
    
    
        
}
?>