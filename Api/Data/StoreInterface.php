<?php
namespace Joseph\StoreLocator\Api\Data;

use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * @api
 * @since 100.1.0
 */
interface StoreInterface
{
    /**#@+
     * Constants defined for keys of data array
     */
    const RULE_ID = 'rule_id';

    const NAME = 'name';

    const EMAIL = 'email';

    const PROVINCE = 'province';

    const IS_ACTIVE = 'is_active';//todo :impl
}
