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

require_once(dirname(__FILE__) . '/DAO/phone2appFormDAO.php');
require_once(dirname(__FILE__) . '/DTO/phone2appFormDTO.php');

//$form_DTO->setId("0000012");
$form_DAO = new form_DAO();

switch($_SERVER['REQUEST_METHOD']){
    case "GET":
        header("HTTP/1.1 200 OK");
        echo $form_DAO->readForm($_GET["id"]);
        break;
    case "POST":
        header("HTTP/1.1 200 OK");
        $form_DTO = new form_DTO($_GET["id"], $_GET["link"]);
        echo $form_DAO->createForm($form_DTO);
        break;
    case "DELETE":
        header("HTTP/1.1 200 OK");
        break;
    case "PUT":
        header("HTTP/1.1 200 OK");
        $put = array();
        parse_str(file_get_contents('php://input'), $put);

        $form_DTO = new form_DTO($put["id"], $put["link"]);
        echo $form_DAO->updateForm($form_DTO);

        break;
    default:
        header("HTTP/1.1 404 Not Found");
}
