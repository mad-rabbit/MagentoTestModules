<?php
namespace Prilutskaya\ModuleMenuTest\Block;
class Block extends \Magento\Framework\View\Element\Template
{
    protected $_categoryCollectionFactory;
    protected $_categoryHelper;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
        \Magento\Catalog\Helper\Category $categoryHelper,
        array $data = []
    )
    {
        $this->_categoryCollectionFactory = $categoryCollectionFactory;
        $this->_categoryHelper = $categoryHelper;
        parent::__construct($context, $data);
    }

    /**
     * @param bool $isActive
     * @param bool $level
     * @param bool $sortBy
     * @param bool $pageSize
     * @return \Magento\Catalog\Model\ResourceModel\Category\Collection
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getCategoryCollection($isActive = true, $level = false, $sortBy = false, $pageSize = false)
    {
        $collection = $this->_categoryCollectionFactory->create();
        $collection->addAttributeToSelect('*');

        // select only active categories
        if ($isActive) {
            $collection->addIsActiveFilter();
        }

        // select categories of certain level
        if ($level) {
            $collection->addLevelFilter($level);
        }

        // sort categories by some value
        if ($sortBy) {
            $collection->addOrderField($sortBy);
        }

        // select certain number of categories
        if ($pageSize) {
            $collection->setPageSize($pageSize);
        }

        return $collection;
    }

    public function getStoreCategories($sorted = false, $asCollection = false, $toLoad = true)
    {
        return $this->_categoryHelper->getStoreCategories($sorted = false, $asCollection = false, $toLoad = true);
    }

    /**
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function printACategories()
    {
        $categories = $this->getCategoryCollection();
        $categories->addAttributeToFilter('name', array('like' => '%a%'));
        $categories->load();
        foreach ($categories as $category) {
            echo $category->getName() . '<br />';
        }
    }
}
