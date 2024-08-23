<template>
    <NcAppContentDetails>
        <h3>Attention: Do you have no policy defined?</h3>
        <p>You should also define a Policy as a default Policy. The default policy is assigned to all devices, which has no explicit policy assigned. If you have no default policy, the default setup is, that anything is denied / disabled!</p>
        <p>If you have a policy defined, please select a Policy from the list</p>
    </NcAppContentDetails>
</template>

<script>
import { NcAppContentDetails } from '@nextcloud/vue'

export default {
	name: 'NoPolicySelected',
	components: {
		NcAppContentDetails,
	},
}
</script>

