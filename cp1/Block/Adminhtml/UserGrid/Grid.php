<?php

declare(strict_types=1);

namespace Cp\User\Block\Adminhtml\UserGrid;

use Cp\User\Model\GalleryFactory;
use Cp\User\Model\Status;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Helper\Data as BackendHelper;
use Magento\Framework\Registry;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    protected $_galleryFactory;
    protected $_coreRegistry;
    protected $_status;

    public function __construct(
        Context $context,
        BackendHelper $backendHelper,
        Registry $coreRegistry,
        GalleryFactory $galleryFactory,
        Status $status,
        array $data = []
    ) {
        $this->_coreRegistry = $coreRegistry;
        $this->_galleryFactory = $galleryFactory;
        $this->_status = $status;
        parent::__construct($context, $backendHelper, $data);
    }
    
    protected function _construct()
    {
        parent::_construct();
        $this->setId('user_grid');
        $this->setDefaultSort('user_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        
        $collection = $this->_galleryFactory->create()->getCollection();
        $collection->getSelect()->joinLeft(
            ['AD' => $collection->getTable('Admin')], 
            'main_table.a_id = AD.admin_id', 
            ['adminName' => 'AD.admin_name'] 
        );

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn(
            'user_id',
            [
                'header' => __('User ID'),
                'index' => 'user_id',
                'sortable' => true,
            ]
        );

        $this->addColumn(
            'name',
            [
                'header' => __('Name'),
                'index' => 'name',
                'sortable' => true,
            ]
        );

        $this->addColumn(
            'email',
            [
                'header' => __('Email'),
                'index' => 'email',
                'sortable' => true,
            ]
        );

        $this->addColumn(
            'is_active',
            [
                'header' => __('Status'),
                'index' => 'is_active',
                'type' => 'options',
                'options' => $this->_status->getOptionArray(),
                'sortable' => true,
            ]
        );
        $this->addColumn(
            'adminName',
            [
                'header' => __('Admin Name'),
                'index' => 'adminName',
                'sortable' => true,
            ]
        );


        $this->addColumn(
            'creation_time',
            [
                'header' => __('Created'),
                'index' => 'creation_time',
                'type' => 'datetime',
                'sortable' => true,
            ]
        );

        $this->addColumn(
            'update_time',
            [
                'header' => __('Updated'),
                'index' => 'update_time',
                'type' => 'datetime',
                'sortable' => true,
            ]
        );

        $this->addColumn(
            'action',
            [
                'header' => __('Action'),
                'type' => 'action',
                'getter' => 'getUserId',
                'actions' => [
                    [
                        'caption' => __('Edit'),
                        'url' => [
                            'base' => 'user2/usergrid/edit',
                        ],
                        'field' => 'user_id',
                    ],
                    [
                        'caption' => __('Delete'),
                        'url' => [
                            'base' => 'user2/usergrid/delete',
                        ],
                        'field' => 'user_id',
                        'confirm' => __('Are you sure you want to delete this record?'),
                    ],
                ],
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action',
            ]
        );

        $this->addExportType('*/*/exportCsv', __('CSV'));
    
        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('user_id');
        $this->setMassactionIdFilter('user_id');
        $this->setMassactionIdFieldOnlyIndexValue(true);
        $this->getMassactionBlock()->setFormFieldName('user');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('user2/usergrid/massDelete'),
                'confirm' => __('Are you sure?')
            ]
        );
    }
    
    public function getGridUrl()
    {
        return $this->getUrl('user2/usergrid/grid', ['_current' => true]);
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('user2/usergrid/edit', ['user_id' => $row->getId()]);
    }
}
