<?php

namespace Prilutskaya\MyModule\Plugin\Block\Html;

class Title
{
    private $registry;
    private $view;

    public function __construct(
        \Magento\Framework\Registry $registry,
        \Magento\Review\Block\Product\View $view
    ) {
        $this->registry = $registry;
        $this->view = $view;
    }

    public function afterGetPageHeading($subject, $result)
    {
        $product = $this->registry->registry('current_product');
        if ($product!==null) {
            return $result->getText() . '(' . $this->view->getReviewsCollection()->getSize() . ')';
        }
        return $result;
    }
}
