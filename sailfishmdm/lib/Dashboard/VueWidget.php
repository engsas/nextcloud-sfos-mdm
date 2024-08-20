<?php
namespace OCA\SailfishMDM\Dashboard;

use OCA\SailfishMDM\Service\DeviceService;
use OCP\AppFramework\Services\IInitialState;
use OCP\Dashboard\IAPIWidget;
use OCP\IL10N;
use OCP\IURLGenerator;

use OCA\SailfishMDM\AppInfo\Application;
use OCP\Util;

class VueWidget implements IAPIWidget {

	/** @var IL10N */
	private $l10n;
	/**
	 * @var DeviceService
	 */
	private $deviceService;
	/**
	 * @var IInitialState
	 */
	private $initialStateService;
	/**
	 * @var string|null
	 */
	private $userId;

	public function __construct(IL10N $l10n,
								DeviceService $deviceService,
								IInitialState $initialStateService,
								?string $userId) {
		$this->l10n = $l10n;
		$this->deviceService = $deviceService;
		$this->initialStateService = $initialStateService;
		$this->userId = $userId;
	}

	/**
	 * @inheritDoc
	 */
	public function getId(): string {
		return 'sailfishmdm-summary-widget-vue';
	}

	/**
	 * @inheritDoc
	 */
	public function getTitle(): string {
		return $this->l10n->t('Managed SFOS Devices');
	}

	/**
	 * @inheritDoc
	 */
	public function getOrder(): int {
		return 10;
	}

	/**
	 * @inheritDoc
	 */
	public function getIconClass(): string {
		return 'icon-sailfishmdm';
	}

	/**
	 * @inheritDoc
	 */
	public function getUrl(): ?string {
		return null;
	}

	/**
	 * @inheritDoc
	 */
	public function load(): void {
		if ($this->userId !== null) {
			$items = $this->getItems($this->userId);
			$this->initialStateService->provideInitialState('dashboard-widget-items', $items);
		}

		Util::addScript(Application::APP_ID, Application::APP_ID . '-dashboardVue');
		Util::addStyle(Application::APP_ID, 'dashboard');
	}

	/**
	 * @inheritDoc
	 */
	public function getItems(string $userId, ?string $since = null, int $limit = 7): array {
		return $this->deviceService->getWidgetItems($userId);
	}
}
