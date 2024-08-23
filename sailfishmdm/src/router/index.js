import Vue from 'vue'
import VueRouter from 'vue-router'

import DevicesView from '../views/DevicesView.vue'
import PoliciesView from '../views/PoliciesView.vue'

Vue.use(VueRouter)

const routes = [
	{ path: '/', component: DevicesView },
    { path: '/devices', component: DevicesView },
    { path: '/devices/:id', component: DevicesView },
	{ path: '/policies', component: PoliciesView },
	{ path: '/policies/:id', component: PoliciesView },
]

export default new VueRouter({
	routes,
});
