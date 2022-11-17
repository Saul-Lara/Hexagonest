<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateLocationsTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('locations', ['id' => false]);

        $table->addColumn('device_uuid', 'char', ['length' => 32]);
        $table->addColumn('lat', 'string', ['length' => 10]);
        $table->addColumn('lon', 'string', ['length' => 10]);

        $table->create();
    }
}