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
					<template #subname>
						Profile: activated profile
					</template>
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

export default {
    name: 'DevicesView',
    components: {
		NcAppContent,
		NcAppContentList,
		NcListItem,
		Device,
		NoDeviceSelected,
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
