<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Address extends Migrator
{
    public function change()
    {
        $table = $this->table('address');
        $table->addColumn('receiver','string',array('limit'=>20,'default'=>'','comment'=>'收货人'))
              ->addColumn('telephone', 'string', array(
                  'limit'   => 20,
                  'default' => '',
                  'comment' => '手机号'
              ))
            ->addColumn('phone','string',array('limit'=>'15','default'=>'','comment'=>'固定电话'))
            ->addColumn('email','string',array('limit'=>'35','default'=>'','comment'=>'邮箱'))
            ->addColumn('area','string',array('limit'=>'200','default'=>'','comment'=>'所在地区'))
            ->addColumn('province','string',array('limit'=>'200','default'=>'','comment'=>'省'))
            ->addColumn('city','string',array('limit'=>'200','default'=>'','comment'=>'市'))
            ->addColumn('county','string',array('limit'=>'200','default'=>'','comment'=>'县'))
            ->create();
    }
}
