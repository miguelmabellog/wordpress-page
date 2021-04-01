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

class user_DTO{
    private $_username;
    private $_password;

    public function getUsername(){
        return $this->_username;
    }

    public function getPassword(){
        return $this->_password;
    }

    public function setUsername($username){
        if(empty($username))
			throw new InvalidArgumentException('Username can not be empty');
        else
            $this->_username = $username;
    }

    public function setPassword($password){
        if(empty($password))
			throw new InvalidArgumentException('Password can not be empty');
        else
            $this->_password = $password;
    }

    public function __construct($u, $p){
        try{
            $this->setUsername($u);
            $this->setPassword($p);
            return $this;
        }catch(InvalidArgumentException $e){
            throw new Exception('Error Processing Request', $e);
        }
    }
}
