<?php
/**
 * Yireo EmailTester for Magento
 *
 * @author      Yireo (https://www.yireo.com/)
 * @copyright   Copyright 2017 Yireo (https://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

declare(strict_types = 1);

namespace Yireo\EmailTester2\Model\Mailer\Variable;

use Yireo\EmailTester2\Model\Mailer\VariableInterface;

/**
 * Class Comment
 */
class Comment implements VariableInterface
{
    /**
     * @return string
     */
    public function getVariable() : string
    {
        return 'This is a sample comment inserted by Yireo_EmailTester.';
    }
}
