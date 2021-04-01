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
require_once(dirname(__FILE__) . '/phone2appFormDAOInterface.php');
require_once(dirname(__FILE__) . '/../DTO/phone2appFormDTO.php' );
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php' );
class form_DAO implements phone2appFormDAOInterface
{
    function __construct() {
        //echo 'aa';
    }

    public function createForm(form_DTO $form){
        global $wpdb;
        $db_name = $wpdb->prefix.'phone2app_form';
        try{
            return ($wpdb->query( $wpdb->prepare(
            	"
            		INSERT INTO $db_name
            		( id, link)
            		VALUES ( %s, %s )
            	",
                $form->getId(),
            	$form->getLink()
            ) ) == 1)? 'Form '.$form->getId().' created succesfully.' : 'Failed';

            //$sql = "INSERT INTO ".$db_name." (id, link) VALUES ('".$form->getId()."', '".$form->getLink()."');";
            //return ($wpdb->query($sql) == 1)? 'Form '.$form->getId().' created succesfully.' : 'Failed';
        }catch(Exception $e){
            return $e;
        }
    }

    public function readForm($id){
        global $wpdb;
        $db_name = $wpdb->prefix.'phone2app_form';
        if($id != null){
            $sql = "SELECT id, link FROM ".$db_name." WHERE id LIKE '".$id."';";
            $r = $wpdb->query($sql);
            return wp_json_encode($r[0]);
        } else{
            $sql = "SELECT id, link FROM ".$db_name." ;";
            $r = $wpdb->get_results($sql);
            return wp_json_encode($r[0]);
        }
    }

    public function checkTable(){
        global $wpdb;
        $db_name = $wpdb->prefix.'phone2app_form';
        $sql = "SELECT * FROM ".$db_name." ;";
        $r = $wpdb->query($sql);
        return $r;
    }

    public function updateForm(form_DTO $form){
        global $wpdb;
        $db_name = $wpdb->prefix.'phone2app_form';
        if($this->checkTable() != 0){
            //WHERE id = '".$form->getId()."'

            return $wpdb->query( $wpdb->prepare(
                "
                    UPDATE $db_name SET id = %s, link = %s
                ",
                $form->getId(),
                $form->getLink()
            ));


            //$sql = "UPDATE ".$db_name." SET id = '".$form->getId()."', link = '".$form->getLink()."' ;";
            //return $wpdb->query($sql);
        } else{
            echo $this->createForm($form);
            //echo 'Form "'.$form->getId().'" not found. Update failed.';
            //throw new RuntimeException('Form "'.$form->getId().'" not found. Update failed.');
        }
    }
/*
    public function deleteForm($id){
        global $wpdb;
        $db_name = $wpdb->prefix.'phone2app_form';
        if($this->readForm($id)){
            $sql = "DELETE FROM ".$db_name." WHERE id = '".$id."';";
            return $wpdb->query($sql);
        }
        else{
            throw new RuntimeException('Form "'.$id.'" not found. Delete failed.');
        }
    }*/

    public function deleteForm($id){
        global $wpdb;
        $db_name = $wpdb->prefix.'phone2app_form';
        if($this->readForm($id)){
            return $wpdb->query($wpdb->prepare(
            		"DELETE FROM $db_name
            		 WHERE id = %s
            		"
        	,$id));

    //        $sql = "DELETE FROM ".$db_name." WHERE id = '".$id."';";
    //        return $wpdb->query($sql);
        }
        else{
            throw new RuntimeException('Form "'.$id.'" not found. Delete failed.');
        }
    }
}
