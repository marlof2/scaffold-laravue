import Vue from 'vue'
import Vuex from 'vuex'

// Global vuex
import AppModule from './app'

Vue.use(Vuex)

/**
 * Main Vuex Store
 */
const store = new Vuex.Store({
  modules: {
    app: AppModule
  }
})

export default store
