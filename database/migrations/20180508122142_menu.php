<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Menu extends Migrator
{

    public function change()
    {
        $table = $this->table('menu');
        $table->addColumn( 'title', 'string', array( 'limit' => 150, 'default' => '', 'comment' => '商品名称' ) )
            ->addColumn( 'price', 'decimal', array(
                'signed'    => 'unsigned',
                'precision' => 7,
                'scale'     => 2,
                'default'   => 0,
                'comment'   => '价格'
            ) )
            ->addColumn( 'list_image', 'string', array( 'limit' => '500', 'default' => '', 'comment' => '商品图' ) )
            ->addColumn( 'inventory', 'integer', array(
                'default' => 0,
                'comment' => '数量'
            ) )
            ->addColumn( 'category_id', 'integer', array( 'default' => 0, 'comment' => '所属栏目' ) )
            ->create();
    }
}
