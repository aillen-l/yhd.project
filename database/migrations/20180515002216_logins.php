<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Logins extends Migrator
{

    public function change()
    {
        $table = $this->table( 'logins' );
        $table->addColumn( 'user_name', 'string', array( 'limit' => 15, 'default' => '', 'comment' => '前台用户名登陆使用' ) )
            ->addColumn( 'password', 'string', array(
                'limit'   => 32,
                'default' => '',
                'comment' => '用户密码'
            ) )
            ->create();

    }
}
