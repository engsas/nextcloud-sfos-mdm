import Vue from 'vue'
import './vueBootstrap.js'
import DeviceWidget from './views/DeviceWidget.vue'

document.addEventListener('DOMContentLoaded', () => {
	OCA.Dashboard.register('sailfishmdm-summary-widget-vue', (el, { widget }) => {
		const View = Vue.extend(DeviceWidget)
		new View({
			propsData: { title: widget.title },
		}).$mount(el)
	})
})
