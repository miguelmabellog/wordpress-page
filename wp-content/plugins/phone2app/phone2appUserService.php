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
require_once(dirname(__FILE__) . '/DAO/phone2appUserDao.php');
require_once(dirname(__FILE__) . '/DTO/phone2appUserDTO.php');

//$form_DTO->setId("0000012");
$user_DAO = new user_DAO();

switch($_SERVER['REQUEST_METHOD']){
    case "GET":
        header("HTTP/1.1 200 OK");
        echo $user_DAO->readUser();
        break;
    case "POST":
        header("HTTP/1.1 200 OK");
        $json = file_get_contents('php://input');
        $obj = (Array)json_decode($json);
        $user_DTO = new user_DTO($obj["username"], $obj["password"]);
        echo $user_DAO->updateUser($user_DTO);
        break;
    case "DELETE":
        header("HTTP/1.1 200 OK");
        echo $user_DAO->deleteUser();
        break;
    case "PUT":
        header("HTTP/1.1 200 OK");
        echo 'aaa';

        $put = array();
        parse_str(file_get_contents('php://input'), $put);

        $user_DTO = new user_DTO($put["username"], $put["password"]);
        echo $user_DAO->updateUser($user_DTO);
        break;
    default:
        header("HTTP/1.1 404 Not Found");
}
