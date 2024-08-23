<template>
	<div id="content" class="app-notestutorial">
		<NcAppNavigation :class="{'icon-loading': loading}">
			<template #list>
				<NcAppNavigationItem
					:name="t('sailfishmdm', 'Devices')"
					:to="'/'"
				>
				</NcAppNavigationItem>
				<NcAppNavigationItem
					:name="t('sailfishmdm', 'Policies')"
					:to="'/policies'"
				>
				</NcAppNavigationItem>
			</template>
		</NcAppNavigation>
		<NcAppContent>
			<router-view></router-view>
		</NcAppContent>
  </div>
</template>

<script>
import '@nextcloud/dialogs/styles/toast.scss'

import axios from '@nextcloud/axios'
import { generateUrl } from '@nextcloud/router'
import { showError, showSuccess } from '@nextcloud/dialogs'
import {
	NcAppNavigation,
	NcAppNavigationItem,
	NcAppContent,
} from '@nextcloud/vue'

export default {
	name: 'App',
	components: {
		NcAppNavigation,
		NcAppNavigationItem,
		NcAppContent,
	},
	data() {
		return {
			loading: false,
			show: true,
			starred: false,
		}
	},
}
</script>
