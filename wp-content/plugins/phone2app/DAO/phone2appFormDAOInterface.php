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
require_once(dirname(__FILE__) . '/../DTO/phone2appFormDTO.php' );
interface phone2appFormDAOInterface
{
    public function createForm(form_DTO $form);
    public function readForm($id);
    public function updateForm(form_DTO $form);
    public function deleteForm($id);
}
