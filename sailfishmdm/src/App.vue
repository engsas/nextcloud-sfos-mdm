<template>
	<NcContent app-name='sailfishmdm' class="app-notestutorial">
		<NcAppNavigation>
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
		<router-view></router-view>
	</NcContent>
</template>

<script>
import '@nextcloud/dialogs/styles/toast.scss'

import axios from '@nextcloud/axios'
import { generateUrl } from '@nextcloud/router'
import { showError, showSuccess } from '@nextcloud/dialogs'
import {
	NcAppNavigation,
	NcAppNavigationItem,
	NcContent,
} from '@nextcloud/vue'

export default {
	name: 'App',
	components: {
		NcAppNavigation,
		NcAppNavigationItem,
		NcContent,
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
