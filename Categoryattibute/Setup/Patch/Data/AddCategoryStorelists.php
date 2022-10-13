<?php 

namespace Tavel\Categoryattibute\Setup\Patch\Data;

use Magento\Catalog\Model\Category;
use Magento\Catalog\Setup\CategorySetupFactory;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Model\Entity\Attribute\Source\Boolean;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;


class AddCategoryStorelists implements DataPatchInterface
{
    /**
     * ModuleDataSetupInterface
     *
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * EavSetupFactory
     *
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * CategorySetupFactory
     *
     * @var CategorySetupFactory
     */
    private $categorySetupFactory;

    /**
     * AddCategoryRecommended constructor.
     * @param ModuleDataSetupInterface  $moduleDataSetup
     * @param EavSetupFactory           $eavSetupFactory
     * @param CategorySetupFactory      $categorySetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory,
        CategorySetupFactory $categorySetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->categorySetupFactory = $categorySetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $eavSetup->addAttribute(Category::ENTITY, 'category_storelists', [
            'type' => 'text',
            'label' => 'Stores',
            'input' => 'multiselect',
            'backend' => "Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend",
            'source' => 'Travel\Categoryattibute\Model\Config\Source\CategoryBrandAttributes',
            'required' => false,
            'sort_order' => 20,
            'global' => ScopedAttributeInterface::SCOPE_STORE,
            'group' => 'General'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
