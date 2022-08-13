import { createApp } from 'vue'
import App from './components/App.vue'
import store from './store'
import "../node_modules/bootstrap/dist/css/bootstrap.css"
import './style.css'

createApp(App).use(store).mount('#app')
