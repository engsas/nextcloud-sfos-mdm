import {
	translate as t,
	// translatePlural as n,
} from '@nextcloud/l10n'
import { loadState } from '@nextcloud/initial-state'

function renderWidget(el) {
	const devices = loadState('sailfishmdm', 'dashboard-widget-items')

	const paragraph = document.createElement('p')
	paragraph.textContent = t('sailfishmdm', 'You can define the frontend part of a widget with plain Javascript.')
	el.append(paragraph)

	const paragraph2 = document.createElement('p')
	paragraph2.textContent = t('sailfishmdm', 'Here is the list of devices managed by MDM:')
	el.append(paragraph2)

	const list = document.createElement('ul')
	list.classList.add('widget-list')
	devices.forEach(item => {
		const li = document.createElement('li')
		li.textContent = item.imei
		list.append(li)
	})
	el.append(list)
}

document.addEventListener('DOMContentLoaded', () => {
	OCA.Dashboard.register('sailfishmdm-summary-widget', (el, { widget }) => {
		renderWidget(el)
	})
})
