<template>
	<NcAppContent>
		<template #list>
			<NcAppContentList :class="{'icon-loading': loading}">
				<NcListItem v-for="sysinfo in sysinfos"
							:key="sysinfo.id"
							:title="(sysinfo.manufacturer + sysinfo.productName)"
							:class="{active: currentSysinfoId === sysinfo.id}"
							details="update?"
							:to="('/devices/' + sysinfo.id)"
				>
					<template #icon>
						<IconDevice :size="20" />
					</template>
					<template #subname>
						Profile: activated profile
					</template>
					<template slot="actions">
						<NcActionButton
							icon="icon-delete"
							@click="deleteSysinfo(sysinfo)">
							{{ t('sailfishmdm', 'Delete Device') }}
						</NcActionButton>
					</template>
				</NcListItem>
			</NcAppContentList>
		</template>

		<Device v-if="currentSysinfoId" />
		<NoDeviceSelected v-else-if="currentSysinfoId == 0" />
	</NcAppContent>
</template>

<script>
import { onMounted, ref, watch } from "vue";
import '@nextcloud/dialogs/styles/toast.scss'

import axios from '@nextcloud/axios'
import { generateUrl } from '@nextcloud/router'
import { showError, showSuccess } from '@nextcloud/dialogs'
import {
	NcAppContent,
	NcAppContentList,
	NcActionButton,
	NcListItem,
} from '@nextcloud/vue'

import Device from "../components/Device.vue"
import NoDeviceSelected from "../components/NoDeviceSelected.vue"
import IconDevice from 'vue-material-design-icons/CellphoneWireless.vue'

export default {
    name: 'DevicesView',
    components: {
		NcAppContent,
		NcAppContentList,
		NcListItem,
		NcActionButton,
		Device,
		NoDeviceSelected,
		IconDevice,
    },
    data() {
		return {
			loading: true,
			currentSysinfoId: 0,
			sysinfos: [],
		}
	},
	methods: {
		async getSysInfos () {
			try {
				const response = await axios.get(generateUrl('/apps/sailfishmdm/sysinfos'))

				this.sysinfos = [];
				this.sysinfos = response.data
			} catch (e) {
				console.error(e)
				showError(t('sailfishmdm', 'Could not fetch sysinfos'))
			}
			this.loading = false;
		},
		resetCurrentSysinfoId(id) {
			this.currentSysinfoId = id;
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
	watch: {
		$route(to, from) {
			if (to.params.id != from.params.id){
				this.resetCurrentSysinfoId(to.params.id);
			}
		}
	},
	mounted() {
		this.getSysInfos();
	},
};
</script>
