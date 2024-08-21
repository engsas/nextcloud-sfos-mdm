<?php
namespace OCA\SailfishMDM\Db;

use JsonSerializable;

use OCP\AppFramework\Db\Entity;

class Sysinfo extends Entity implements JsonSerializable {

    protected $userId;
    protected $bluetoothMacAddress;
    protected $deviceModel;
    protected $deviceUid;
    protected $manufacturer;
    protected $productName;
    protected $softwareVersion;
    protected $softwareVersionId;
    protected $wlanMacAddress;

    public function __construct() {
        $this->addType('id','integer');
    }

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'bluetoothMacAddress' => $this->bluetoothMacAddress,
            'deviceModel' => $this->deviceModel,
            'deviceUid' => $this->deviceUid,
            'manufacturer' => $this->manufacturer,
            'productName' => $this->productName,
            'productName' => $this->productName,
            'softwareVersion' => $this->softwareVersion,
            'softwareVersionId' => $this->softwareVersionId,
            'wlanMacAddress' => $this->wlanMacAddress,
        ];
    }
}
