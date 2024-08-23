<?php
namespace OCA\SailfishMDM\Db;

use JsonSerializable;

use OCP\AppFramework\Db\Entity;

class Policy extends Entity implements JsonSerializable {

    protected $userId;
    protected $label;
    protected $defaultPolicy;
    protected $accountCreationEnabled;
    protected $applicationInstallationEnabled;
    protected $bluetoothToggleEnabled;
    protected $browserEnabled;
    protected $callStatisticsSettingsEnabled;
    protected $cameraEnabled;
    protected $cellularTechnologySettingsEnabled;
    protected $dateTimeSettingsEnabled;
    protected $developerModeSettingsEnabled;
    protected $deviceResetEnabled;
    protected $flightModeToggleEnabled;
    protected $internetSharingEnabled;
    protected $locationSettingsEnabled;
    protected $microphoneEnabled;
    protected $mobileDataAccessPointSettingsEnabled;
    protected $mobileNetworkSettingsEnabled;
    protected $networkDataCounterSettingsEnabled;
    protected $networkProxySettingsEnabled;
    protected $osUpdatesEnabled;
    protected $screenshotEnabled;
    protected $sideLoadingSettingsEnabled;
    protected $vpnConfigurationSettingsEnabled;
    protected $vpnConnectionSettingsEnabled;
    protected $wlanToggleEnabled;

    public function __construct() {
        $this->addType('id','integer');
        $this->addType('userId','integer');
        $this->addType('label','string');
        $this->addType('defaultPolicy','boolean');
        $this->addType('accountCreationEnabled','boolean');
        $this->addType('applicationInstallationEnabled','boolean');
        $this->addType('bluetoothToggleEnabled','boolean');
        $this->addType('browserEnabled','boolean');
        $this->addType('callStatisticsSettingsEnabled','boolean');
        $this->addType('cameraEnabled','boolean');
        $this->addType('cellularTechnologySettingsEnabled','boolean');
        $this->addType('dateTimeSettingsEnabled','boolean');
        $this->addType('developerModeSettingsEnabled','boolean');
        $this->addType('deviceResetEnabled','boolean');
        $this->addType('flightModeToggleEnabled','boolean');
        $this->addType('internetSharingEnabled','boolean');
        $this->addType('locationSettingsEnabled','boolean');
        $this->addType('microphoneEnabled','boolean');
        $this->addType('mobileDataAccessPointSettingsEnabled','boolean');
        $this->addType('mobileNetworkSettingsEnabled','boolean');
        $this->addType('networkDataCounterSettingsEnabled','boolean');
        $this->addType('networkProxySettingsEnabled','boolean');
        $this->addType('osUpdatesEnabled','boolean');
        $this->addType('screenshotEnabled','boolean');
        $this->addType('sideLoadingSettingsEnabled','boolean');
        $this->addType('vpnConfigurationSettingsEnabled','boolean');
        $this->addType('vpnConnectionSettingsEnabled','boolean');
        $this->addType('wlanToggleEnabled','boolean');
    }

    public function columnToProperty($column) {
        if ($column === 'app_installation_enabled') {
            return 'applicationInstallationEnabled';
        } elseif ($column === 'call_stats_set_enabled') {
            return 'callStatisticsSettingsEnabled';
        } elseif ($column === 'cellular_tec_set_enabled') {
            return 'cellularTechnologySettingsEnabled';
        } elseif ($column === 'developer_mode_set_enabled') {
            return 'developerModeSettingsEnabled';
        } elseif ($column === 'mobile_data_ap_set_enabled') {
            return 'mobileDataAccessPointSettingsEnabled';
        } elseif ($column === 'mobile_net_set_enabled') {
            return 'mobileNetworkSettingsEnabled';
        } elseif ($column === 'net_data_counter_set_enabled') {
            return 'networkDataCounterSettingsEnabled';
        } elseif ($column === 'vpn_config_set_enabled') {
            return 'vpnConfigurationSettingsEnabled';
        } elseif ($column === 'vpn_connection_set_enabled') {
            return 'vpnConnectionSettingsEnabled';
        } else {
            return parent::columnToProperty($column);
        }
    }

    public function propertyToColumn($property) {
        if ($property === 'applicationInstallationEnabled') {
            return 'app_installation_enabled';
        } elseif ($property === 'callStatisticsSettingsEnabled') {
            return 'call_stats_set_enabled';
        } elseif  ($property === 'cellularTechnologySettingsEnabled') {
            return 'cellular_tec_set_enabled';
        } elseif  ($property === 'developerModeSettingsEnabled') {
            return 'developer_mode_set_enabled';
        } elseif ($property === 'mobileDataAccessPointSettingsEnabled') {
            return 'mobile_data_ap_set_enabled';
        } elseif ($property === 'mobileNetworkSettingsEnabled') {
            return 'mobile_net_set_enabled';
        } elseif ($property === 'networkDataCounterSettingsEnabled') {
            return 'net_data_counter_set_enabled';
        } elseif ($property === 'vpnConfigurationSettingsEnabled') {
            return 'vpn_config_set_enabled';
        } elseif ($property === 'vpnConnectionSettingsEnabled') {
            return 'vpn_connection_set_enabled';
        } else {
            return parent::propertyToColumn($property);
        }
    }

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'userdId' => $this->userId,
            'label' => $this->label,
            'defaultPolicy' => $this->defaultPolicy,
            'accountCreationEnabled' => $this->accountCreationEnabled,
            'applicationInstallationEnabled' => $this->applicationInstallationEnabled,
            'bluetoothToggleEnabled' => $this->bluetoothToggleEnabled,
            'browserEnabled' => $this->browserEnabled,
            'callStatisticsSettingsEnabled' => $this->callStatisticsSettingsEnabled,
            'cameraEnabled' => $this->cameraEnabled,
            'cellularTechnologySettingsEnabled' => $this->cellularTechnologySettingsEnabled,
            'dateTimeSettingsEnabled' => $this->dateTimeSettingsEnabled,
            'developerModeSettingsEnabled' => $this->developerModeSettingsEnabled,
            'deviceResetEnabled' => $this->deviceResetEnabled,
            'flightModeToggleEnabled' => $this->flightModeToggleEnabled,
            'internetSharingEnabled' => $this->internetSharingEnabled,
            'locationSettingsEnabled' => $this->locationSettingsEnabled,
            'microphoneEnabled' => $this->microphoneEnabled,
            'mobileDataAccessPointSettingsEnabled' => $this->mobileDataAccessPointSettingsEnabled,
            'mobileNetworkSettingsEnabled' => $this->mobileNetworkSettingsEnabled,
            'networkDataCounterSettingsEnabled' => $this->networkDataCounterSettingsEnabled,
            'networkProxySettingsEnabled' => $this->networkProxySettingsEnabled,
            'osUpdatesEnabled' => $this->osUpdatesEnabled,
            'screenshotEnabled' => $this->screenshotEnabled,
            'sideLoadingSettingsEnabled' => $this->sideLoadingSettingsEnabled,
            'vpnConfigurationSettingsEnabled' => $this->vpnConfigurationSettingsEnabled,
            'vpnConnectionSettingsEnabled' => $this->vpnConnectionSettingsEnabled,
            'wlanToggleEnabled' => $this->wlanToggleEnabled,
        ];
    }
}
