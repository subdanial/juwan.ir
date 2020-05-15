<?php
Class Database{
    const HOST = "localhost";
    const USERNAME = "danial";
    const PASSWORD = "WTFIS0124";
    const DATABASE = "juwan_catalog";
    
    public $connection;

    function __construct(){
        $this->connection = mysqli_connect($this::HOST,$this::USERNAME,$this::PASSWORD,$this::DATABASE);
    }
    function product_remove($id){
        $query = "DELETE FROM `products` WHERE `products`.`id` = $id";
        $result = mysqli_query($this->connection,$query);
        return($result);
    }
    function categories_index(){
        $query = "SELECT * FROM `categories` ORDER BY `categories`.`ordering` ASC";
        mysqli_query($this->connection, "SET NAMES utf8");
        $result = mysqli_query($this->connection,$query);
        return($result);
    }
    function category_show($id){
        $query = "SELECT * FROM `categories` WHERE `id` = $id";
        mysqli_query($this->connection, "SET NAMES utf8");
        $result = mysqli_query($this->connection,$query);
        $result=mysqli_fetch_array($result);
        return($result);
    }
    function product_get($id){
        $query = "SELECT * FROM `products` WHERE `id` = $id";
        mysqli_query($this->connection, "SET NAMES utf8");
        $result = mysqli_query($this->connection,$query);
        $result = mysqli_fetch_array($result);
        return($result);
    }
    function products_index(){
        $query = "SELECT * FROM `products`";
        mysqli_query($this->connection, "SET NAMES utf8");
        $result = mysqli_query($this->connection,$query);
        return($result);
    }
    
    function category_update_ordering($newPosition,$index){
        $query =  "UPDATE categories SET ordering = '$newPosition' WHERE id='$index'";
        mysqli_query($this->connection,$query);
    }

    function category_update($id,$fild,$value){
        $query = "UPDATE categories SET $fild = '$value' WHERE id='$id' ";
        mysqli_query($this->connection,$query);
    }
    
    function find_category_name($category_id){
        $query = "SELECT * FROM `categories` WHERE `id` = $category_id";
        $result = mysqli_query($this->connection,$query);
        $result = mysqli_fetch_array($result);
    return ($result);
    }
    function number_of_results($category_id){
        $query="SELECT * FROM `products` WHERE `category_id` = $category_id";
        $result = mysqli_query($this->connection,$query);
        $number_of_results = mysqli_num_rows($result);
        return($number_of_results);
    }
    function products_show($category_id, $colors = "`color`",$materials = "`material`",$styles = "`style`",$brands = "`brand`" ,$price0 = "`0`" ,$price1 = "`100000000`" , $page = 1 ,$perpage =36){
        $page = ($page - 1)*$perpage;
        
        $query = "SELECT * FROM `products` WHERE `category_id` = $category_id AND `color` REGEXP ($colors) AND `material` in ($materials) AND `brand` in ($brands) AND `style` in ($styles) AND `price` BETWEEN $price0 AND $price1 ORDER BY `products`.`id` DESC LIMIT $page,$perpage ";
        mysqli_query($this->connection, "SET NAMES utf8");
        $result = mysqli_query($this->connection,$query);
        return($result);
    }

    function get_attributes($column,$category_id){
        $query = "SELECT `$column` FROM `products` WHERE `category_id` = $category_id GROUP BY `$column`";
        mysqli_query($this->connection, "SET NAMES utf8");
        $result = mysqli_query($this->connection,$query);
        return($result);
    }
    function get_colors($category_id){
        $colors = [];
        $query = "SELECT `color` FROM `products` WHERE `category_id` = $category_id GROUP BY `color`";
        mysqli_query($this->connection, "SET NAMES utf8");
        $result = mysqli_query($this->connection,$query);
        foreach($result as $result){
            array_push($colors,$result['color']);
        }
       $color_string = implode($colors);
       $color_string = str_replace("["," ",$color_string);
       $color_string = str_replace("]"," ",$color_string);
       $color_string = str_replace("\""," ",$color_string);
       $color_string = str_replace(","," ",$color_string);
       $color_string = preg_replace('/\s+/', '', $color_string);
       $colors = array();
       foreach(explode("#",$color_string) as $color){
           array_push($colors,"#".$color);
       }
       $colors = array_unique($colors);
       array_shift($colors);
       return($colors);
    }


    function product_add($category_id,$code,$name,$price,$material,$brand,$style,$sizes,$colors,$images){
        $query = "INSERT INTO `products` (`id`, `category_id`, `code`, `name`, `price`, `color`, `size`, `material`, `brand`, `style`, `images`)
                                 VALUES (NULL, '$category_id', '$code', '$name', '$price', '$colors', '$sizes', '$material', '$brand', '$style', '$images')";
        mysqli_query($this->connection, "SET NAMES utf8");
        $result = mysqli_query($this->connection,$query);
        if($result){
        $update_query = "UPDATE `products` SET `time`= now() WHERE `code`= '$code' ";  
        $result = mysqli_query($this->connection,$update_query);
            return($result);
        }else{
            return($result);
        }

    }

    function is_product_exist($code){
        $query = "SELECT * FROM `products` WHERE `code` = '$code'";
        $result = mysqli_query($this->connection,$query);

        if(mysqli_num_rows($result) > 0){
            return(true);
        } 
        else{
            return(false);
        }
    }



    public function deleteElement($element, &$array){
        $index = array_search($element, $array);
        if($index !== false){
            unset($array[$index]);
        }
    }

   function image_remove($address){
            $query = "SELECT * FROM `products` WHERE `images` LIKE '%$address%'";
            $result = mysqli_query($this->connection,$query);
            $result = mysqli_fetch_array($result);
            $images = $result['images'];
            
            $images_array = json_decode($images);
            $this->deleteElement($address, $images_array);
            
            $filter = function($tag){ return '"' . $tag . '"'; };
            $spannedTags = array_map($filter, $images_array);
            
            $images_parameter = "[" . implode(",",$spannedTags)."]";

            $query = "UPDATE `products` SET `images` = '$images_parameter' WHERE `images` LIKE '%$address%'";
            $result = mysqli_query($this->connection,$query);


            if($result){
                $update_query = "UPDATE `products` SET `time`= now()  WHERE `images` LIKE '%$address%'";  
                $result = mysqli_query($this->connection,$update_query);
                    return($result);
                }else{
                    return($result);
            }

            
    }
    
    function image_add($id,$addresses){
        $id = intval($id);
        mysqli_query($this->connection, "SET NAMES utf8");

        $query1 = "SELECT * FROM `products` WHERE `id` = $id";
        $result1 = mysqli_query($this->connection,$query1);
        $result1 = mysqli_fetch_array($result1);
        $images = $result1['images'];
        $images_array = json_decode($images);

        foreach(json_decode($addresses) as $address){
            array_push($images_array,$address);
        }

        $filter = function($tag){ return '"' . $tag . '"'; };
        $spannedTags = array_map($filter, $images_array);
        $images_parameter = "[" . implode(",",$spannedTags)."]";

        $query2 = "UPDATE `products` SET `images` = '$images_parameter' WHERE `id` = $id";
        $result2 = mysqli_query($this->connection,$query2);



        if($result2){
            $update_query = "UPDATE `products` SET `time`= now() WHERE `id`= '$id' ";  
            $result = mysqli_query($this->connection,$update_query);
                return($result);
            }else{
                return($result2);
            }


    }

    function product_update($id,$category_id,$code,$name,$price,$material,$brand,$style,$sizes,$colors){
    $query = "UPDATE `products`SET `category_id` = '$category_id' , `code` = '$code' , `name` = '$name' , `price` = '$price' , `material` = '$material', `brand` = '$brand', `style` = '$style', `size` = '$sizes', `color` = '$colors' , `time`= now() WHERE `id` = $id ";
    mysqli_query($this->connection, "SET NAMES utf8");
    $result = mysqli_query($this->connection,$query);
    return($result);
    }
}
    
?>
