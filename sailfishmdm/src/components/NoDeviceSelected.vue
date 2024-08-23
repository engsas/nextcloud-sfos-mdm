<template>
    <NcAppContentDetails>
        <h1>Please select a Device from the list</h1>
    </NcAppContentDetails>
</template>

<script>
import { NcAppContentDetails } from '@nextcloud/vue'

export default {
	name: 'NoDeviceSelected',
	components: {
		NcAppContentDetails,
	},
}
</script>
