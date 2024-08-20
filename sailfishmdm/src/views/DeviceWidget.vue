<template>
	<NcDashboardWidget :items="items"
		:show-more-url="showMoreUrl"
		:item-menu="itemMenu"
		:loading="state === 'loading'">
		<template #empty-content>
			<NcEmptyContent :title="t('sailfishmdm', 'No managed Devices found')">
				<template #icon>
					<SvgIcon type="mdi" :path="path" />
				</template>
			</NcEmptyContent>
		</template>
	</NcDashboardWidget>
</template>

<script>
import SvgIcon from '@jamescoyle/vue-icon'
import { mdiCellphone } from '@mdi/js'

import NcDashboardWidget from '@nextcloud/vue/dist/Components/NcDashboardWidget.js'
import NcEmptyContent from '@nextcloud/vue/dist/Components/NcEmptyContent.js'

import { generateUrl } from '@nextcloud/router'
import { loadState } from '@nextcloud/initial-state'

export default {
	name: 'DeviceWidget',

	components: {
		SvgIcon,
		NcDashboardWidget,
		NcEmptyContent,
	},

	props: {
		title: {
			type: String,
			required: true,
		},
	},

	data() {
		return {
			path: mdiCellphone,
			devices: loadState('sailfishmdm', 'dashboard-widget-items'),
			showMoreUrl: generateUrl('/apps/sailfishmdm/devices'),
			state: 'ok',
		}
	},

	computed: {
		items() {
			return this.devices.map((g) => {
				return {
					id: g.id,
					avatarUrl: mdiCellphone,
					targetUrl: g.link,
					mainText: g.imei,
					subText: 'Up to date',
				}
			})
		},
	},

	watch: {
	},

	beforeDestroy() {
	},

	beforeMount() {
	},

	mounted() {
	},

	methods: {
	},
}
</script>

<style scoped lang="scss">
// nothing
</style>
