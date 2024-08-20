<?php

namespace OCA\SailfishMDM\Service;

use OC\Files\Node\File;
use OC\Files\Node\Node;
use OC\User\NoUserException;
use OCA\SailfishMDM\AppInfo\Application;
use OCP\Dashboard\Model\WidgetItem;
use OCP\Files\Folder;
use OCP\Files\InvalidPathException;
use OCP\Files\IRootFolder;
use OCP\Files\NotFoundException;
use OCP\Files\NotPermittedException;
use OCP\IURLGenerator;
use Psr\Log\LoggerInterface;


class DeviceService {

	/**
	 * @var IRootFolder
	 */
	private $root;
	/**
	 * @var LoggerInterface
	 */
	private $logger;
	/**
	 * @var IURLGenerator
	 */
	private $urlGenerator;

	public function __construct (IRootFolder $root,
								LoggerInterface $logger,
								IURLGenerator $urlGenerator) {
		$this->root = $root;
		$this->logger = $logger;
		$this->urlGenerator = $urlGenerator;
	}

	/**
	 * @param string $userId
	 * @return array|string[]
	 * @throws NotFoundException
	 * @throws NotPermittedException
	 * @throws NoUserException
	 */
	public function getDevices(string $userId): array {
        return array(
            array('id' => 1, 'imei' => "1234", 'link' => '/apps/sailfishmdm/devices/1'),
            array('id' => 2, 'imei' => "5678", 'link' => '/apps/sailfishmdm/devices/2'),
        );
	}

	/**
	 * @param string $userId
	 * @param int $deviceId
	 * @return array|string[]
	 * @throws NoUserException
	 * @throws NotFoundException
	 * @throws NotPermittedException
	 * @throws InvalidPathException
	 */
	public function getDevice(string $userId, int $deviceId): array {
		$this->logger->debug('SFOS Device ' . $deviceId . ' was not found in the database', ['app' => Application::APP_ID]);
		return array();
	}

	public function getWidgetItems(string $userId): array {
		return $this->getDevices($userId);
	}
}
