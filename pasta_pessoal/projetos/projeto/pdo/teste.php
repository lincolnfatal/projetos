
<?php
class BaseClass {
   function __construct() {
      // print "In BaseClass constructor\n";
   }
   
   function teste(){
	   echo "OK";
   }
}

class SubClass extends BaseClass {
   function __construct() {
       parent::__construct();
      // print "In SubClass constructor\n";
	   parent::teste();
   }
   
  
}

$obj = new BaseClass();
$obj->teste();

$obj = new SubClass();
?>
