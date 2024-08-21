<template>
	<div id="content" class="app-sailfishmdm">
		<NcAppNavigation>
			<NcAppNavigationNew v-if="!loading"
				:text="t('sailfishmdm', 'New Device')"
				:disabled="false"
				button-id="new-sailfishmdm-button"
				button-class="icon-add"
				@click="newSysInfo" />
			<ul>
				<NcAppNavigationItem v-for="sysinfo in sysinfos"
					:key="sysinfo.id"
					:title="sysinfo.deviceUid ? sysinfo.deviceUid : t('sailfishmdm', 'New Device')"
					:class="{active: currentSysinfoId === sysinfo.id}"
					@click="openSysinfo(sysinfo)">
					<template slot="actions">
						<NcActionButton v-if="sysinfo.id === -1"
							icon="icon-close"
							@click="cancelNewSysinfo(sysinfo)">
							{{ t('sailfishmdm', 'Cancel Device creation') }}
						</NcActionButton>
						<NcActionButton v-else
							icon="icon-delete"
							@click="deleteSysinfo(sysinfo)">
							{{ t('sailfishmdm', 'Delete Device') }}
						</NcActionButton>
					</template>
				</NcAppNavigationItem>
			</ul>
		</NcAppNavigation>
		<NcAppContent>
			<div v-if="currentSysinfo">
				Device UID: <input ref="deviceUid"
					v-model="currentSysinfo.deviceUid"
					type="text"
					:disabled="updating">
				Device Model: <input ref="deviceModel"
					v-model="currentSysinfo.deviceModel"
					type="text"
					:disabled="updating">
				Manufacturer: <input ref="manufacturer"
					v-model="currentSysinfo.manufacturer"
					type="text"
					:disabled="updating">
				Product Name: <input ref="productName"
					v-model="currentSysinfo.productName"
					type="text"
					:disabled="updating">
				Software Version: <input ref="softwareVersion"
					v-model="currentSysinfo.softwareVersion"
					type="text"
					:disabled="updating">
				Software Version ID: <input ref="softwareVersionId"
					v-model="currentSysinfo.softwareVersionId"
					type="text"
					:disabled="updating">
				Bluetooth Mac Address: <input ref="bluetoothMacAddress"
					v-model="currentSysinfo.bluetoothMacAddress"
					type="text"
					:disabled="updating">
				WLAN Mac Address: <input ref="wlanMacAddress"
					v-model="currentSysinfo.wlanMacAddress"
					type="text"
					:disabled="updating">
				<input type="button"
					class="primary"
					:value="t('sailfishmdm', 'Save')"
					:disabled="updating || !savePossible"
					@click="saveSysinfo">
			</div>
			<div v-else id="emptycontent">
				<div class="icon-file" />
				<h2>{{ t('sailfishmdm', 'Create a Device to get started') }}</h2>
			</div>
		</NcAppContent>
	</div>
</template>

<script>
import '@nextcloud/dialogs/styles/toast.scss'

import axios from '@nextcloud/axios'
import { generateUrl } from '@nextcloud/router'
import { showError, showSuccess } from '@nextcloud/dialogs'
import {
	NcActionButton,
	NcAppContent,
	NcAppNavigation,
	NcAppNavigationItem,
	NcAppNavigationNew,
} from '@nextcloud/vue'

export default {
	name: 'App',
	components: {
		NcActionButton,
		NcAppContent,
		NcAppNavigation,
		NcAppNavigationItem,
		NcAppNavigationNew,
	},
	data() {
		return {
			sysinfos: [],
			currentSysinfoId: null,
			updating: false,
			loading: true,
		}
	},
	computed: {
		/**
		 * Return the currently selected sysinfo object
		 *
		 * @return {object | null}
		 */
		currentSysinfo() {
			if (this.currentSysinfoId === null) {
				return null
			}
			return this.sysinfos.find((sysinfo) => sysinfo.id === this.currentSysinfoId)
		},

		/**
		 * Returns true if a sysinfo is selected and its title is not empty
		 *
		 * @return {boolean}
		 */
		savePossible() {
			return this.currentSysinfo && this.currentSysinfo.deviceUid !== ''
		},
	},
	/**
	 * Fetch list of sysinfos when the component is loaded
	 */
	async mounted() {
		try {
			const response = await axios.get(generateUrl('/apps/sailfishmdm/sysinfos'))
			this.sysinfos = response.data
		} catch (e) {
			console.error(e)
			showError(t('sailfishmdm', 'Could not fetch sysinfos'))
		}
		this.loading = false
	},

	methods: {
		/**
		 * Create a new sysinfo and focus the sysinfo content field automatically
		 *
		 * @param {object} sysinfo Sysinfo object
		 */
		openSysinfo(sysinfo) {
			if (this.updating) {
				return
			}
			this.currentSysinfoId = sysinfo.id
			this.$nextTick(() => {
				this.$refs.content.focus()
			})
		},
		/**
		 * Action tiggered when clicking the save button
		 * create a new sysinfo or save
		 */
		saveSysinfo() {
			if (this.currentSysinfoId === -1) {
				this.createSysinfo(this.currentSysinfo)
			} else {
				this.updateSysinfo(this.currentSysinfo)
			}
		},
		/**
		 * Create a new sysinfo and focus the sysinfo content field automatically
		 * The sysinfo is not yet saved, therefore an id of -1 is used until it
		 * has been persisted in the backend
		 */
		newSysInfo() {
			if (this.currentSysinfoId !== -1) {
				this.currentSysinfoId = -1
				this.sysinfos.push({
					bluetoothMacAddress: '',
					deviceModel: '',
					deviceUid: '',
					manufacturer: '',
					productName: '',
					softwareVersion: '',
					softwareVersionId: '',
					wlanMacAddress: ''
				})
				this.$nextTick(() => {
					this.$refs.deviceUid.focus()
				})
			}
		},
		/**
		 * Abort creating a new sysinfo
		 */
		cancelNewSysinfo() {
			this.sysinfos.splice(this.sysinfos.findIndex((sysinfo) => sysinfo.id === -1), 1)
			this.currentSysinfoId = null
		},
		/**
		 * Create a new sysinfo by sending the information to the server
		 *
		 * @param {object} sysinfo Sysinfo object
		 */
		async createSysinfo(sysinfo) {
			this.updating = true
			try {
				const response = await axios.post(generateUrl('/apps/sailfishmdm/sysinfos'), sysinfo)
				const index = this.sysinfos.findIndex((match) => match.id === this.currentSysinfoId)
				this.$set(this.sysinfos, index, response.data)
				this.currentSysinfoId = response.data.id
			} catch (e) {
				console.error(e)
				showError(t('sailfishmdm', 'Could not create the sysinfo'))
			}
			this.updating = false
		},
		/**
		 * Update an existing sysinfo on the server
		 *
		 * @param {object} sysinfo Sysinfo object
		 */
		async updateSysinfo(sysinfo) {
			this.updating = true
			try {
				await axios.put(generateUrl(`/apps/sailfishmdm/sysinfos/${sysinfo.id}`), sysinfo)
			} catch (e) {
				console.error(e)
				showError(t('sailfishmdm', 'Could not update the sysinfo'))
			}
			this.updating = false
		},
		/**
		 * Delete a sysinfo, remove it from the frontend and show a hint
		 *
		 * @param {object} sysinfo Sysinfo object
		 */
		async deleteSysinfo(sysinfo) {
			try {
				await axios.delete(generateUrl(`/apps/sailfishmdm/sysinfos/${sysinfo.id}`))
				this.sysinfos.splice(this.sysinfos.indexOf(sysinfo), 1)
				if (this.currentSysinfoId === sysinfo.id) {
					this.currentSysinfoId = null
				}
				showSuccess(t('sailfishmdm', 'Sysinfo deleted'))
			} catch (e) {
				console.error(e)
				showError(t('sailfishmdm', 'Could not delete the sysinfo'))
			}
		},
	},
}
</script>
<style scoped>
	#app-content > div {
		width: 100%;
		height: 100%;
		padding: 20px;
		display: flex;
		flex-direction: column;
		flex-grow: 1;
	}

	input[type='text'] {
		width: 100%;
	}

	textarea {
		flex-grow: 1;
		width: 100%;
	}
</style>
