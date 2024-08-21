<?php
namespace OCA\SailfishMDM\Tests\Unit\Service;

use PHPUnit\Framework\TestCase;

use OCP\AppFramework\Db\DoesNotExistException;

use OCA\SailfishMDM\Db\Sysinfo;

class SysinfoServiceTest extends TestCase {

    private $service;
    private $mapper;
    private $userId = 'john';

    public function setUp() {
        $this->mapper = $this->getMockBuilder('OCA\SailfishMDM\Db\SysinfoMapper')
            ->disableOriginalConstructor()
            ->getMock();
        $this->service = new SysinfoService($this->mapper);
    }

    public function testUpdate() {
        // the existing sysinfo
        $sysinfo = Sysinfo::fromRow([
            'id' => 3,
            'bluetoothMacAddress' => 'TestBluetoothMacAddress',
            'deviceModel' => 'TestModel',
            'deviceUid' => 'TestUid',
            'manufacturer' => 'TestManufacturer',
            'productName' => 'TestProduct',
            'softwareVersion' => 'Nice Name',
            'softwareVersionId' => '4.5.0.22',
            'wlanMacAddress' => 'WlanMacAddress'
        ]);
        $this->mapper->expects($this->once())
            ->method('find')
            ->with($this->equalTo(3))
            ->will($this->returnValue($sysinfo));

        // the note when updated
        $updatedSysinfo = Sysinfo::fromRow(['id' => 3]);
        $updatedSysinfo->setDeviceModel('NewDeviceModel');
        $this->mapper->expects($this->once())
            ->method('update')
            ->with($this->equalTo($updatedSysinfo))
            ->will($this->returnValue($updatedSysinfo));

        $result = $this->service->update(
            3,
            'bluetoothMacAddress',
            'deviceModel',
            'deviceUid',
            'manufacturer',
            'productName',
            'softwareVersion',
            'softwareVersionId',
            'wlanMacAddress',
            $this->userId
        );

        $this->assertEquals($updatedSysinfo, $result);
    }


    /**
     * @expectedException OCA\NotesTutorial\Service\NotFoundException
     */
    public function testUpdateNotFound() {
        // test the correct status code if no note is found
        $this->mapper->expects($this->once())
            ->method('find')
            ->with($this->equalTo(3))
            ->will($this->throwException(new DoesNotExistException('')));

        $this->service->update(
                        3,
            'bluetoothMacAddress',
            'deviceModel',
            'deviceUid',
            'manufacturer',
            'productName',
            'softwareVersion',
            'softwareVersionId',
            'wlanMacAddress',
            $this->userId
        );
    }

}
