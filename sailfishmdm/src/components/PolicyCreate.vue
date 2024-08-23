<template>
    <div :class="{'icon-loading': updating}">
        <h2>General</h2>
        <div class="form-group">
            <NcTextField label="Label" :value.sync="currentPolicy.label" required/>
        </div>
        <div class="form-group">
            <NcCheckboxRadioSwitch :checked.sync="currentPolicy.defaultPolicy">Default Policy</NcCheckboxRadioSwitch>
            <p>Set this policy as default policy (used for all devices, which have no assigned policy or will be newly registered until they have assigned a policy)</p>
        </div>
        <h2>Device Integrity</h2>
        <div class="form-group">
            <NcCheckboxRadioSwitch :checked.sync="currentPolicy.osUpdatesEnabled">Enable OS updates</NcCheckboxRadioSwitch>
        </div>
        <div class="form-group">
            <NcCheckboxRadioSwitch :checked.sync="currentPolicy.accountCreationEnabled">Enable account creation</NcCheckboxRadioSwitch>
        </div>
        <div class="form-group">
            <NcCheckboxRadioSwitch :checked.sync="currentPolicy.applicationInstallationEnabled">Enable application installation</NcCheckboxRadioSwitch>
        </div>
        <div class="form-group">
            <NcCheckboxRadioSwitch :checked.sync="currentPolicy.sideLoadingSettingsEnabled">Enable side loading settings</NcCheckboxRadioSwitch>
        </div>
        <div class="form-group">
            <NcCheckboxRadioSwitch :checked.sync="currentPolicy.developerModeSettingsEnabled">Enable developer mode settings</NcCheckboxRadioSwitch>
        </div>
        <div class="form-group">
            <NcCheckboxRadioSwitch :checked.sync="currentPolicy.deviceResetEnabled">Enable device reset</NcCheckboxRadioSwitch>
        </div>
        <h2>Connectivity</h2>
        <div class="form-group">
            <NcCheckboxRadioSwitch :checked.sync="currentPolicy.flightModeToggleEnabled">Enable flight mode toggle</NcCheckboxRadioSwitch>
        </div>
        <div class="form-group">
            <NcCheckboxRadioSwitch :checked.sync="currentPolicy.bluetoothToggleEnabled"><IconBluetooth :size="20" />Enable bluetooth toggle</NcCheckboxRadioSwitch>
        </div>
         <div class="form-group">
            <NcCheckboxRadioSwitch :checked.sync="currentPolicy.wlanToggleEnabled"><IconWifi :size="20" />Enable wlan toggle</NcCheckboxRadioSwitch>
        </div>
        <div class="form-group">
            <NcCheckboxRadioSwitch :checked.sync="currentPolicy.mobileDataAccessPointSettingsEnabled"><IconMobileApSettings :size="20" />Enable mobile data access point settings</NcCheckboxRadioSwitch>
        </div>
        <div class="form-group">
            <NcCheckboxRadioSwitch :checked.sync="currentPolicy.mobileNetworkSettingsEnabled">Enable mobile network settings</NcCheckboxRadioSwitch>
        </div>
        <div class="form-group">
            <NcCheckboxRadioSwitch :checked.sync="currentPolicy.cellularTechnologySettingsEnabled">Enable cellular technology settings</NcCheckboxRadioSwitch>
        </div>
        <div class="form-group">
            <NcCheckboxRadioSwitch :checked.sync="currentPolicy.networkProxySettingsEnabled">Enable network proxy settings</NcCheckboxRadioSwitch>
        </div>
        <div class="form-group">
            <NcCheckboxRadioSwitch :checked.sync="currentPolicy.vpnConfigurationSettingsEnabled"><IconVpn :size="20" />Enable vpn configuration settings</NcCheckboxRadioSwitch>
        </div>
         <div class="form-group">
            <NcCheckboxRadioSwitch :checked.sync="currentPolicy.vpnConnectionSettingsEnabled"><IconVpn :size="20" />Enable vpn connection settings</NcCheckboxRadioSwitch>
        </div>
        <h2>Privacy / Statistics</h2>
        <div class="form-group">
            <NcCheckboxRadioSwitch :checked.sync="currentPolicy.cameraEnabled">Enable camera</NcCheckboxRadioSwitch>
        </div>
        <div class="form-group">
            <NcCheckboxRadioSwitch :checked.sync="currentPolicy.microphoneEnabled">Enable micrphone</NcCheckboxRadioSwitch>
        </div>
        <div class="form-group">
            <NcCheckboxRadioSwitch :checked.sync="currentPolicy.locationSettingsEnabled">Enable location settings</NcCheckboxRadioSwitch>
        </div>
        <div class="form-group">
            <NcCheckboxRadioSwitch :checked.sync="currentPolicy.screenshotEnabled">Enable screenshot</NcCheckboxRadioSwitch>
        </div>
        <div class="form-group">
            <NcCheckboxRadioSwitch :checked.sync="currentPolicy.callStatisticsSettingsEnabled">Enable call statistics</NcCheckboxRadioSwitch>
        </div>
        <div class="form-group">
            <NcCheckboxRadioSwitch :checked.sync="currentPolicy.networkDataCounterSettingsEnabled">Enable data counter settings</NcCheckboxRadioSwitch>
        </div>
        <h2>Others</h2>
        <div class="form-group">
            <NcCheckboxRadioSwitch :checked.sync="currentPolicy.browserEnabled">Enable browser</NcCheckboxRadioSwitch>
        </div>
        <div class="form-group">
            <NcCheckboxRadioSwitch :checked.sync="currentPolicy.dateTimeSettingsEnabled">Enable data time settings</NcCheckboxRadioSwitch>
        </div>
        <div class="form-group">
            <NcCheckboxRadioSwitch :checked.sync="currentPolicy.internetSharingEnabled">Enable internet sharing</NcCheckboxRadioSwitch>
        </div>

        <NcButton v-if="currentPolicy.id < 0"
            :disabled="!currentPolicy.label"
            @click="sendPolicy"
            type="primary">
            Create
        </NcButton>
        <NcButton v-if="currentPolicy.id > 0"
            :disabled="!currentPolicy.label"
            @click="sendPolicy"
            type="primary">
            Update
        </NcButton>
        <NcButton
            @click="cancel"
            type="warning">
            Cancel
        </NcButton>
    </div>
</template>

<script>
import {
    NcTextField,
    NcCheckboxRadioSwitch,
    NcButton,
} from '@nextcloud/vue'
import { showError } from '@nextcloud/dialogs'
import { watch, ref } from 'vue'
import axios from '@nextcloud/axios'
import { generateUrl } from '@nextcloud/router'
import IconWifi from 'vue-material-design-icons/Wifi.vue'
import IconBluetooth from 'vue-material-design-icons/Bluetooth.vue'
import IconVpn from 'vue-material-design-icons/Vpn.vue'
import IconMobileApSettings from 'vue-material-design-icons/NetworkStrength4Cog.vue'


export default {
    name: 'PolicyCreate',
    components: {
		NcTextField,
        NcButton,
        NcCheckboxRadioSwitch,
        IconWifi,
        IconBluetooth,
        IconVpn,
        IconMobileApSettings,
    },
    data() {
        return {
            updating: false,
            currentPolicy: {
                id: -1,
                label: '',
                defaultPolicy: false,
                accountCreationEnabled: false,
                applicationInstallationEnabled: false,
                bluetoothToggleEnabled: false,
                browserEnabled: false,
                callStatisticsSettingsEnabled: false,
                cameraEnabled: false,
                cellularTechnologySettingsEnabled: false,
                dateTimeSettingsEnabled: false,
                developerModeSettingsEnabled: false,
                deviceResetEnabled: false,
                flightModeToggleEnabled: false,
                internetSharingEnabled: false,
                locationSettingsEnabled: false,
                microphoneEnabled: false,
                mobileDataAccessPointSettingsEnabled: false,
                mobileNetworkSettingsEnabled: false,
                networkDataCounterSettingsEnabled: false,
                networkProxySettingsEnabled: false,
                osUpdatesEnabled: false,
                screenshotEnabled: false,
                sideLoadingSettingsEnabled: false,
                vpnConfigurationSettingsEnabled: false,
                vpnConnectionSettingsEnabled: false,
                wlanToggleEnabled: false,
            },
        }
    },
    methods: {
		async getPolicies () {
            this.loading = true
			try {
				const response = await axios.get(generateUrl('/apps/sailfishmdm/policies'))

                if (response.data.length < 1){
                    this.currentPolicy.defaultPolicy = true
                }
			} catch (e) {
				console.error(e)
				showError(t('sailfishmdm', 'Could not fetch policies'))
			}
			this.loading = false;
		},
		async getPolicy(id) {
            this.loading = true
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
		sendPolicy(){
            if(this.currentPolicy.id > 0){
                this.updatePolicy()
            }
            else {
                this.createPolicy()
            }
		},
		async createPolicy(){
            this.updating = true
            try {
				const response = await axios.post(generateUrl('/apps/sailfishmdm/policies'), this.currentPolicy)
				this.$emit('finished')
			} catch (e) {
				console.error(e)
				showError(t('sailfishmdm', 'Could not create the policy'))
			}
			this.updating = false
		},
		async updatePolicy(){
            this.updating = true
            try {
				const response = await axios.put(generateUrl('/apps/sailfishmdm/policies/'+ this.currentPolicy.id), this.currentPolicy)
				this.$emit('finished')
			} catch (e) {
				console.error(e)
				showError(t('sailfishmdm', 'Could not update the policy'))
			}
			this.updating = false
		},
		cancel(){
            this.$emit('canceled')
		}
    },
    emits: [
        'finished',
        'canceled'
    ],
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
}
</script>
