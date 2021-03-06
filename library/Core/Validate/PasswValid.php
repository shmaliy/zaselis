<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Validate
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: EmailAddress.php 22668 2010-07-25 14:50:46Z thomas $
 */

/**
 * @see Zend_Validate_Abstract
 */
require_once 'Zend/Validate/Abstract.php';

/**
 * @category   Zend
 * @package    Zend_Validate
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Core_Validate_PasswValid extends Zend_Validate_Abstract
{
    const INVALID            = 'pwdNotMatch';
    

    /**
     * @var array
     */
    protected $_messageTemplates = array(
        self::INVALID            => "Invalid password."
    );

    
    public function isValid($value)
    {
        $this->_setValue($value);
        $model = new User_Model_Users();
        if ($model->validateUserPassword($value)) {
            return true;
        } else {
            $this->_error(self::INVALID);
            return false;
        }
    }
}
