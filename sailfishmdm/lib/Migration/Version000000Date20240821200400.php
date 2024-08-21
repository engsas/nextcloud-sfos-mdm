<?php

  namespace OCA\SailfishMDM\Migration;

  use Closure;
  use OCP\DB\ISchemaWrapper;
  use OCP\Migration\SimpleMigrationStep;
  use OCP\Migration\IOutput;

  class Version000000Date20240821200400 extends SimpleMigrationStep {

    /**
    * @param IOutput $output
    * @param Closure $schemaClosure The `\Closure` returns a `ISchemaWrapper`
    * @param array $options
    * @return null|ISchemaWrapper
    */
    public function changeSchema(IOutput $output, Closure $schemaClosure, array $options) {
        /** @var ISchemaWrapper $schema */
        $schema = $schemaClosure();

        if (!$schema->hasTable('sailfishmdm_sysinfo')) {
            $table = $schema->createTable('sailfishmdm_sysinfo');
            $table->addColumn('id', 'integer', [
                'autoincrement' => true,
                'notnull' => true,
            ]);
            $table->addColumn('user_id', 'string', [
                'notnull' => true,
                'length' => 200,
            ]);
            $table->addColumn('bluetooth_mac_address', 'string', [
                'length' => 200,
                'default' => '',
            ]);
            $table->addColumn('device_model', 'string', [
                'length' => 200,
                'default' => '',
            ]);
            $table->addColumn('device_uid', 'text', [
                'notnull' => true,
                'length' => 200,
            ]);
            $table->addColumn('manufacturer', 'text', [
                'default' => '',
            ]);
            $table->addColumn('product_name', 'text', [
                'length' => 200,
                'default' => '',
            ]);
            $table->addColumn('software_version', 'text', [
                'notnull' => true,
                'length' => 200,
            ]);
            $table->addColumn('software_version_id', 'text', [
                'notnull' => true,
                'length' => 200,
            ]);
            $table->addColumn('wlan_mac_address', 'text', [
                'length' => 200,
                'default' => '',
            ]);

            $table->setPrimaryKey(['id']);
            $table->addIndex(['user_id'], 'sailfishmdm_si_user_id_index');
            $table->addIndex(['device_uid'], 'sailfishmdm_si_d_uid_index');
        }
        return $schema;
    }
}
