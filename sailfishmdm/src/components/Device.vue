<template>
    <NcAppContentDetails :class="{'icon-loading': loading}">
            <table v-if="currentSysinfo">
                <tr><td>Device UID:</td><td>{{currentSysinfo.deviceUid}}</td></tr>
                <tr><td>Device Model:</td><td>{{currentSysinfo.deviceModel}}</td></tr>
                <tr><td>Manufacturer:</td><td>{{currentSysinfo.manufacturer}}</td></tr>
                <tr><td>Product Name:</td><td>{{currentSysinfo.productName}}</td></tr>
                <tr><td>Software Version:</td><td>{{currentSysinfo.softwareVersion}}</td></tr>
                <tr><td>Software Version ID:</td><td>{{currentSysinfo.softwareVersionId}}</td></tr>
                <tr><td>
                    <IconBluetooth :size="20" />
                    Bluetooth Mac Address:</td><td>{{currentSysinfo.bluetoothMacAddress}}</td></tr>
                <tr><td>
                    <IconWifi :size="20" />
                    WLAN Mac Address:</td><td>{{currentSysinfo.wlanMacAddress}}</td></tr>
            </table>
			<div v-else id="emptycontent">
				<div class="icon-file" />
				<h2>{{ t('sailfishmdm', 'Create a Device to get started') }}</h2>
			</div>
		</NcAppContentDetails>
</template>

<script>
import { NcAppContentDetails } from '@nextcloud/vue'
import { showError } from '@nextcloud/dialogs'
import { watch, ref } from 'vue'
import axios from '@nextcloud/axios'
import { generateUrl } from '@nextcloud/router'
import IconBluetooth from 'vue-material-design-icons/Bluetooth.vue'
import IconWifi from 'vue-material-design-icons/Wifi.vue'

export default {
    name: 'Device',
    components: {
		NcAppContentDetails,
		IconBluetooth,
		IconWifi,
    },
    data() {
		return {
			loading: true,
			currentSysinfoId: 0,
			currentSysinfo: {},
		}
	},
	methods: {
		async getSysinfo (id) {
            this.loading = true;
            try {
                const response = await axios.get(generateUrl('/apps/sailfishmdm/sysinfos/'+ id))

                this.currentSysinfo = {};
                this.currentSysinfo = response.data
            } catch (e) {
                console.error(e)
                showError(t('sailfishmdm', 'Could not fetch sysinfo'+ id))
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
				this.getSysinfo(to.params.id);
			}
		}
	},
	mounted() {
		this.getSysinfo(this.$route.params.id);
	},
};
</script>
