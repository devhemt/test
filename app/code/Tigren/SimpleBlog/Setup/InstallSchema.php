<?php
/**
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\SimpleBlog\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        $tigren_blog_category = $installer->getTable('tigren_simpleblog_tigren_blog_category');
        $tigren_blog_post = $installer->getTable('tigren_simpleblog_tigren_blog_post');
        $tigren_blog_category_post = $installer->getTable('tigren_blog_category_post');
        //Check for the existence of the table
        if ($installer->getConnection()->isTableExists($tigren_blog_category) != true) {
            $table = $installer->getConnection()
                ->newTable($tigren_blog_category)
                ->addColumn(
                    'tigren_blog_category_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'ID'
                )
                ->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'Name'
                )
                ->addColumn(
                    'description',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'Description'
                )
                ->addColumn(
                    'created_at',
                    Table::TYPE_DATETIME,
                    null,
                    ['nullable' => false],
                    'Created At'
                )
                ->addColumn(
                    'updated_at',
                    Table::TYPE_DATETIME,
                    null,
                    ['nullable' => false],
                    'Updated At'
                )
                ->addColumn(
                    'status',
                    Table::TYPE_SMALLINT,
                    null,
                    ['nullable' => false, 'default' => '0'],
                    'Status'
                )
                //Set comment for tigren_blog_category table
                ->setComment('Tigren Blog Category Table')
                //Set option for tigren_blog_category table
                ->setOption('type', 'InnoDB')
                ->setOption('charset', 'utf8');
            $installer->getConnection()->createTable($table);
        }
        if ($installer->getConnection()->isTableExists($tigren_blog_post) != true) {
            $table = $installer->getConnection()
                ->newTable($tigren_blog_post)
                ->addColumn(
                    'tigren_blog_post_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'ID'
                )
                ->addColumn(
                    'title',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'Title'
                )
                ->addColumn(
                    'post_image',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'Post Image'
                )
                ->addColumn(
                    'list_image',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'List Image'
                )
                ->addColumn(
                    'full_content',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'Full Content'
                )
                ->addColumn(
                    'short_content',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'Short Content'
                )
                ->addColumn(
                    'author',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'Author'
                )
                ->addColumn(
                    'published_at',
                    Table::TYPE_DATETIME,
                    null,
                    ['nullable' => false],
                    'Published At'
                )
                ->addColumn(
                    'status',
                    Table::TYPE_SMALLINT,
                    null,
                    ['nullable' => false, 'default' => '0'],
                    'Status'
                )
                //Set comment for tigren_blog_post table
                ->setComment('Tigren Blog Post Table')
                //Set option for tigren_blog_post table
                ->setOption('type', 'InnoDB')
                ->setOption('charset', 'utf8');
            $installer->getConnection()->createTable($table);
        }
        if ($installer->getConnection()->isTableExists($tigren_blog_category_post) != true) {
            $table = $installer->getConnection()
                ->newTable($tigren_blog_category_post)
                ->addColumn(
                    'id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'ID'
                )
                ->addColumn(
                    'post_id',
                    Table::TYPE_SMALLINT,
                    null,
                    ['nullable' => false],
                    'Post Id'
                )
                ->addColumn(
                    'category_id',
                    Table::TYPE_SMALLINT,
                    null,
                    ['nullable' => false],
                    'Category Id'
                )
                //Set comment for tigren_blog_category_post table
                ->setComment('Tigren Blog Category Post Table')
                //Set option for tigren_blog_category table
                ->setOption('type', 'InnoDB')
                ->setOption('charset', 'utf8');
            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }
}
