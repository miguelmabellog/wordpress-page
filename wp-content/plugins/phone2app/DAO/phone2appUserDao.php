<?php
/**
 * NOTICE OF LICENSE
 *
 * This file is licenced under the Software License Agreement.
 * With the purchase or the installation of the software in your application
 * you accept the licence agreement.
 *
 * You must not modify, adapt or create derivative works of this source code
 *
 *  @author    Alejandro Martin <alex030293@hotmail.es>
 *  @copyright 2015 Aportamedia S.L.
 *  @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 */
require_once(dirname(__FILE__) . '/phone2appUserDaoInterface.php');
require_once(dirname(__FILE__) . '/../DTO/phone2appUserDTO.php' );
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php' );
class user_DAO implements phone2appUserDAOInterface
{
    function __construct() {
        //echo 'aa';
    }

    public function createUser(user_DTO $user){
        echo 'aaa';
        global $wpdb;
        $db_name = $wpdb->prefix.'phone2app_user';
        try{
            $sql = "INSERT INTO ".$db_name." (username, password) VALUES ('".$user->getUsername()."', '".$user->getPassword()."');";
            return ($wpdb->query($sql) == 1)? 'Form '.$user->getUsername().' created succesfully.' : 'Failed';
        }catch(Exception $e){
            return $e;
        }
    }

    public function readUser(){
        global $wpdb;
        $db_name = $wpdb->prefix.'phone2app_user';
        $sql = "SELECT * FROM ".$db_name." ;";
        $r = $wpdb->get_results($sql);
        return wp_json_encode($r[0]);
    }

    public function checkTable(){
        global $wpdb;
        $db_name = $wpdb->prefix.'phone2app_user';
        $sql = "SELECT * FROM ".$db_name." ;";
        $r = $wpdb->query($sql);
        return $r;
    }

    public function updateUser(user_DTO $user){
        global $wpdb;
        $db_name = $wpdb->prefix.'phone2app_user';
        if($this->checkTable() != 0){
            //WHERE id = '".$form->getId()."'
            $sql = "UPDATE ".$db_name." SET username = '".$user->getUsername()."', password = '".$user->getPassword()."' ;";
            return $wpdb->query($sql);
        } else{
            echo $this->createUser($user);
            //echo 'Form "'.$form->getId().'" not found. Update failed.';
            //throw new RuntimeException('Form "'.$form->getId().'" not found. Update failed.');
        }
    }

    public function deleteUser(){
        global $wpdb;
        $db_name = $wpdb->prefix.'phone2app_user';
        if($this->readUser()){
            $sql = "DELETE FROM ".$db_name.";";
            return $wpdb->query($sql);
        }
        else{
            throw new RuntimeException('User not found. Delete failed.');
        }
    }
}
