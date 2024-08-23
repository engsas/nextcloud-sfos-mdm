<template>
	<NcContent app-name='sailfishmdm' class="app-notestutorial">
		<NcAppNavigation>
			<template #list>
				<NcAppNavigationItem
					:name="t('sailfishmdm', 'Devices')"
					:to="'/'"
				>
					<template #icon>
						<IconDevices :size="20" />
					</template>
				</NcAppNavigationItem>
				<NcAppNavigationItem
					:name="t('sailfishmdm', 'Policies')"
					:to="'/policies'"
				>
					<template #icon>
						<IconPolicies :size="20" />
					</template>
					<template #actions>
						<NcActionButton @click="showModal" icon="icon-add">
						</NcActionButton>
					</template>
				</NcAppNavigationItem>
			</template>
		</NcAppNavigation>
		<router-view></router-view>
		<NcModal
			v-if="modal"
			ref="modalRef"
			@close="closeModal"
			name="Create Policy">
			<div class="modal__content">
				<PolicyCreate @finished="closeModal" @canceled="closeModal"/>
			</div>
		</NcModal>
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
	NcActionButton,
	NcModal,
} from '@nextcloud/vue'
import { ref } from 'vue'
import IconDevices from 'vue-material-design-icons/Devices.vue'
import IconPolicies from 'vue-material-design-icons/ShieldLockOpen.vue'

import PolicyCreate from "./components/PolicyCreate.vue"

export default {
	name: 'App',
	components: {
		NcAppNavigation,
		NcAppNavigationItem,
		NcContent,
		NcActionButton,
		NcModal,
		IconDevices,
		IconPolicies,
		PolicyCreate,
	},
	setup() {
		return {
			modalRef: ref(null),
		}
	},
	data() {
		return {
			loading: false,
			show: true,
			starred: false,
			modal: false,
		}
	},
	methods: {
		showModal() {
			this.modal = true
		},
		closeModal() {
			this.modal = false
		}
	},
}
</script>
