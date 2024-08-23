<?php

  namespace OCA\SailfishMDM\Migration;

  use Closure;
  use OCP\DB\ISchemaWrapper;
  use OCP\Migration\SimpleMigrationStep;
  use OCP\Migration\IOutput;

  class Version000000Date20240822193600 extends SimpleMigrationStep {

    /**
    * @param IOutput $output
    * @param Closure $schemaClosure The `\Closure` returns a `ISchemaWrapper`
    * @param array $options
    * @return null|ISchemaWrapper
    */
    public function changeSchema(IOutput $output, Closure $schemaClosure, array $options) {
        /** @var ISchemaWrapper $schema */
        $schema = $schemaClosure();

        if (!$schema->hasTable('sailfishmdm_policy')) {
            $table = $schema->createTable('sailfishmdm_policy');
            $table->addColumn('id', 'integer', [
                'autoincrement' => true,
                'notnull' => true,
            ]);
            $table->addColumn('user_id', 'string', [
                'notnull' => true,
                'length' => 200,
            ]);
            $table->addColumn('default_policy', 'boolean', [
                'default' => false,
                'notnull' => false,
            ]);
            $table->addColumn('label', 'string', [
                'default' => false,
                'notnull' => false,
                'length' => 200,
            ]);
            $table->addColumn('account_creation_enabled', 'boolean', [
                'default' => false,
                'notnull' => false,
            ]);
            $table->addColumn('app_installation_enabled', 'boolean', [
                'default' => false,
                'notnull' => false,
            ]);
            $table->addColumn('bluetooth_toggle_enabled', 'boolean', [
                'default' => false,
                'notnull' => false,
            ]);
            $table->addColumn('browser_enabled', 'boolean', [
                'default' => false,
                'notnull' => false,
            ]);
            $table->addColumn('call_stats_set_enabled', 'boolean', [
                'default' => false,
                'notnull' => false,
            ]);
            $table->addColumn('camera_enabled', 'boolean', [
                'default' => false,
                'notnull' => false,
            ]);
            $table->addColumn('cellular_tec_set_enabled', 'boolean', [
                'default' => false,
                'notnull' => false,
            ]);
            $table->addColumn('date_time_settings_enabled', 'boolean', [
                'default' => false,
                'notnull' => false,
            ]);
            $table->addColumn('developer_mode_set_enabled', 'boolean', [
                'default' => false,
                'notnull' => false,
            ]);
            $table->addColumn('device_reset_enabled', 'boolean', [
                'default' => false,
                'notnull' => false,
            ]);
            $table->addColumn('flight_mode_toggle_enabled', 'boolean', [
                'default' => false,
                'notnull' => false,
            ]);
            $table->addColumn('internet_sharing_enabled', 'boolean', [
                'default' => false,
                'notnull' => false,
            ]);
            $table->addColumn('location_settings_enabled', 'boolean', [
                'default' => false,
                'notnull' => false,
            ]);
            $table->addColumn('microphone_enabled', 'boolean', [
                'default' => false,
                'notnull' => false,
            ]);
            $table->addColumn('mobile_data_ap_set_enabled', 'boolean', [
                'default' => false,
                'notnull' => false,
            ]);
            $table->addColumn('mobile_net_set_enabled', 'boolean', [
                'default' => false,
                'notnull' => false,
            ]);
            $table->addColumn('net_data_counter_set_enabled', 'boolean', [
                'default' => false,
                'notnull' => false,
            ]);
            $table->addColumn('network_proxy_settings_enabled', 'boolean', [
                'default' => false,
                'notnull' => false,
            ]);
            $table->addColumn('os_updates_enabled', 'boolean', [
                'default' => false,
                'notnull' => false,
            ]);
            $table->addColumn('screenshot_enabled', 'boolean', [
                'default' => false,
                'notnull' => false,
            ]);
            $table->addColumn('side_loading_settings_enabled', 'boolean', [
                'default' => false,
                'notnull' => false,
            ]);
            $table->addColumn('vpn_config_set_enabled', 'boolean', [
                'default' => false,
                'notnull' => false,
            ]);
            $table->addColumn('vpn_connection_set_enabled', 'boolean', [
                'default' => false,
                'notnull' => false,
            ]);
            $table->addColumn('wlan_toggle_enabled', 'boolean', [
                'default' => false,
                'notnull' => false,
            ]);

            $table->setPrimaryKey(['id']);
            $table->addIndex(['user_id'], 'sailfishmdm_si_user_id_index');
        }

        if (!$schema->hasTable('sailfishmdm_pol_dev')) {
            $table = $schema->createTable('sailfishmdm_pol_dev');
            $table->addColumn('id', 'integer', [
                'autoincrement' => true,
                'notnull' => true,
            ]);
            $table->addColumn('sysinfo_id', 'integer', [
                'notnull' => true,
            ]);
            $table->addColumn('policies_id', 'integer', [
                'notnull' => true,
            ]);
            $table->setPrimaryKey(['id']);
            $table->addForeignKeyConstraint($schema->getTable('sailfishmdm_policy'), ['policies_id'], ['id'], [], 'fk_pol_dev_policies');
            $table->addForeignKeyConstraint($schema->getTable('sailfishmdm_sysinfo'), ['sysinfo_id'], ['id'], [], 'fk_pol_dev_sysinfos');
        }
        return $schema;
    }
}
