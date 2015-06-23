<?php 

/*
=================================
 start of the common functions
================================
*/

function &get_instance(){
 return Controller::get_instance();
}


/*
==================================
 end of common functions
=================================
*/

/*
====================================
start of the loader class
====================================
*/
class Loader {


  protected function _init_class($class){
    $C = &get_instance();
    $name = strtolower($class);
    $C->$name = new $class();
  }

  public function _class($library){
    if(is_array($library)){
      foreach($library as $class){
        $this->library($class);
      }
      return;
    }

    if($library == ''){
      return false;
    }

    $this->_init_class($library);
  }

  public function view ($param) {
     echo $param;
  }
}
/*
===============================
 End of the loader class
==============================
*/

/*
===============================
 start of core controller class
==============================
*/

class Controller {

  private static  $instance;

  function __construct () {
    self::$instance = $this;
    $this->load = new Loader();
  }


  public static function &get_instance(){
    return self::$instance;
  }
}
/*
===============================
end of the core controller class
=================================== 
*/

/*
 ====================================================
  start of library sections (put all your library classes in this section)
=====================================================
*/

class MyLibrary {

 private $c;

 function __construct() {
   $this->c = &get_instance();
 }

 function say($sentence) {
   $this->c->load->view($sentence);
 }
}
/*
 ====================================================
  End of the library sections
====================================================
*/

/*
 ============================================
  start of controller section (put all your controller classes in this section)
 ===========================================
*/

class Foo extends Controller {

  function __construct () {
    parent::__construct();
    $this->load->_class('MyLibrary');
  }

  function bar() {
    $this->mylibrary->say('Hello World');
  }
}


/* 
 ==========================================
  End of the controller sections
 ==========================================
*/

$foo = new Foo();
$foo->bar();

