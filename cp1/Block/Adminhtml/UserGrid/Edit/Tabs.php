<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Cp\User\Block\Adminhtml\UserGrid\Edit;

/**
 * Admin User left menu
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('user_id');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('User Information'));
    }
}