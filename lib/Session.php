<?php
class Session{
    // session start
    public static function init(){
        session_start();
    }
    // session set bitore $key ar value set kre disi
    public static function set($key, $value){
        $_SESSION[$key] = $value;
    }

    // Session get krsi
    public static function get($key){
        if(isset($_SESSION[$key])){
            $_SESSION[$key];
        }else{
            return false;
        }
    }


    // login  kra nay take  se kiso krte parbe nay

    public static function checkSession(){
        self::init();
        if(self::get('login') === false){
            self::destroy();
            header('Location:login.php');


        }
    }
    // login  kra tak check krbe
    public static function logincheck(){
        self::init();
        if(self::get('login') === true){

            header('Location:index.php');
        }
    }

    // session destroy function
    public static function destroy()
    {
        session_destroy();
        header('location:login.php');

    }
}
?>