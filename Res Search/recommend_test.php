<!DOCTYPE html>
<html>
<title>Recommendation</title>
    <head>
    <style>
        #content{
            padding-top: 100px;
            padding-left: 50%;
        } 
        
    </style>
        
    </head>
<body>
<div id="content">
<?php
include("header.php");
require_once("recommend.php");
require_once("restaurant_list.php");
$name=$_GET['username'];
$name=strtolower($name);
$re=new Recommend();
$ratinglist=$re->getRecommendations($restaurants,$name);
arsort($ratinglist);
echo "<pre>";
print_r($ratinglist);
echo "</pre>";
$i=1;
 echo "<strong>We recommend you the top three restaurants:</strong><br>";
foreach($ratinglist as $key=>$value){   
    if($i<4)    
    {  echo $i.":".$key."<br/>";    }
    $i++;}

?>  
<script>
        window.onload=function(){
	var welcomeStr = "Hello <?php echo $name;?>,I'll recommend you the top three restaurants.";
	saysomething(welcomeStr);
}
        </script>
</div>
</body>
</html>
