<template>
    <NcAppContentDetails :class="{'icon-loading': loading}">
            <table v-if="currentPolicy">
                <tr><td>Device UID:</td><td>{{currentPolicy.deviceUid}}</td></tr>
                <tr><td>Device Model:</td><td>{{currentPolicy.deviceModel}}</td></tr>
                <tr><td>Manufacturer:</td><td>{{currentPolicy.manufacturer}}</td></tr>
                <tr><td>Product Name:</td><td>{{currentPolicy.productName}}</td></tr>
                <tr><td>Software Version:</td><td>{{currentPolicy.softwareVersion}}</td></tr>
                <tr><td>Software Version ID:</td><td>{{currentPolicy.softwareVersionId}}</td></tr>
                <tr><td>Bluetooth Mac Address:</td><td>{{currentPolicy.bluetoothMacAddress}}</td></tr>
                <tr><td>WLAN Mac Address:</td><td>{{currentPolicy.wlanMacAddress}}</td></tr>
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

export default {
    name: 'Device',
    components: {
		NcAppContentDetails,
    },
    data() {
		return {
			loading: true,
			currentPolicyId: 0,
			currentPolicy: {},
		}
	},
	methods: {
		async getPolicy (id) {
            this.loading = true;
            try {
                const response = await axios.get(generateUrl('/apps/sailfishmdm/policies/'+ id))

                this.currentPolicy = {};
                this.currentPolicy = response.data
            } catch (e) {
                console.error(e)
                showError(t('sailfishmdm', 'Could not fetch policy'+ id))
            }
            this.loading = false;
		},
		resetCurrentPolicyId(id) {
			this.currentPolicyId = id;
		},
	},
    watch: {
		$route(to, from) {
			if (to.params.id != from.params.id){
				this.getPolicy(to.params.id);
			}
		}
	},
	mounted() {
		this.getPolicy(this.$route.params.id);
	},
};
</script>
