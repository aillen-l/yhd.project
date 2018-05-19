<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Category extends Migrator
{

    public function change()
    {
        $table = $this->table( 'category' );
        $table->addColumn( 'title', 'string', array( 'limit' => 150, 'default' => '', 'comment' => '栏目名称' ) )

            ->addColumn( 'category_id', 'integer', array( 'default' => 0, 'comment' => '父级id' ) )

            ->create();
    }
}
