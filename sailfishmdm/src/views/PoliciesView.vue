<template>
	<NcAppContent>
		<template #list>
			<NcAppContentList :class="{'icon-loading': loading}">
				<NcListItem v-for="policy in policies"
							:key="policy.id"
							:title="(policy.label)"
							:class="{active: currentPolicyId === policy.id}"
							details="update?"
							:to="('/policies/' + policy.id)"
				>
					<template #subname>
						<span v-if="policy.default">Default</span>
					</template>
					<template slot="actions">
						<NcActionButton v-if="policy.id === -1"
							icon="icon-close"
							@click="cancelNewPolicy(policy)">
							{{ t('sailfishmdm', 'Cancel Policy creation') }}
						</NcActionButton>
						<NcActionButton v-else
							icon="icon-delete"
							@click="deletePolicy(policy)">
							{{ t('sailfishmdm', 'Delete Policy') }}
						</NcActionButton>
					</template>
				</NcListItem>
			</NcAppContentList>
		</template>

		<PolicyCreate v-if="currentPolicyId" />
		<NoPolicySelected v-else-if="currentPolicyId == 0" />
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

import PolicyCreate from "../components/PolicyCreate.vue"
import NoPolicySelected from "../components/NoPolicySelected.vue"

export default {
    name: 'PoliciesView',
    components: {
		NcAppContent,
		NcAppContentList,
		NcListItem,
		PolicyCreate,
		NoPolicySelected,
    },
    data() {
		return {
			loading: true,
			currentPolicyId: 0,
			policies: [],
		}
	},
	methods: {
		async getPolicies () {
			this.loading = true;
			try {
				const response = await axios.get(generateUrl('/apps/sailfishmdm/policies'))

				this.policies = [];
				this.policies = response.data
			} catch (e) {
				console.error(e)
				showError(t('sailfishmdm', 'Could not fetch policies'))
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
				this.resetCurrentPolicyId(to.params.id);
			}
		}
	},
	mounted() {
		this.getPolicies();
	},
};
</script>
