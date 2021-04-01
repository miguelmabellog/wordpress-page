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

class form_DTO{
    private $_id;
    private $_link;

    public function getId(){
        return $this->_id;
    }

    public function getLink(){
        return $this->_link;
    }

    public function setId($id){
        if(empty($id))
			throw new InvalidArgumentException('Id can not be empty');
        else
            $this->_id = $id;
    }

    public function setLink($link){
        if(empty($link))
			throw new InvalidArgumentException('Link can not be empty');
        else
            $this->_link = $link;
    }

    public function __construct($id, $link){
        try{
            $this->setId($id);
            $this->setLink($link);
            return $this;
        }catch(InvalidArgumentException $e){
            throw new Exception('Error Processing Request', $e);
        }
    }
}
