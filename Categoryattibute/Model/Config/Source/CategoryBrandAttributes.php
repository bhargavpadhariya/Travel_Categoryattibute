<?php
 
namespace Suraj\Categoryattibute\Model\Config\Source;
 
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
 
 
class CategoryBrandAttributes extends AbstractSource
{
    
    protected $_options;


    public function getAllOptions()
    {
        if ($this->_options === null) {
            $this->_options = [
                ['value' => '0', 'label' => __('No')],
                ['value' => '1', 'label' => __('Yes')],
                ['value' => '2', 'label' => __('Yes 1')]
            ];
        }
        return $this->_options;
    }
    final public function toOptionArray()
    {

        $this->_options = [];

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $catId = 43;
        $subcategory = $objectManager->create('Magento\Catalog\Model\Category')->load($catId);
        $subcats = $subcategory->getChildrenCategories();

        foreach ($subcats as $subcat) {
            $cat_id = $subcat->getId();
            $_category = $objectManager->create('Magento\Catalog\Model\Category')->load($subcat->getId());
            $cat_name = $_category->getName();

            $this->_options[] = array('value' => $cat_id , 'label' => $cat_name);

        }
    
        return $this->_options;

    }

}
