import { generateFilePath } from '@nextcloud/router'

import Vue from 'vue'
import { generateUrl } from '@nextcloud/router'

import router from './router'
import App from './App.vue'

// eslint-disable-next-line
__webpack_public_path__ = generateFilePath(appName, '', 'js/')

Vue.mixin({ methods: { t, n } })

export default new Vue({
	el: '#content',
	router,
	render: h => h(App),
})




