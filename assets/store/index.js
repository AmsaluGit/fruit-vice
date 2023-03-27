import createPersistedState from "vuex-persistedstate";
import { createStore } from "vuex";

const store = createStore({
  state: {
    selectedFruits: [],
  },
  mutations: {
    setSelectedFruits(state, fruits) {
      state.selectedFruits = fruits;
    },

    addSelectedFruit(state, fruit) {
      state.selectedFruits.push(fruit);
    },
    removeSelectedFruit(state, fruitId) {
      const index = state.selectedFruits.findIndex(
        (fruit) => fruit === fruitId
      );
      if (index !== -1) {
        state.selectedFruits.splice(index, 1);
      }
    },
  },
  getters: {
    selectedFruits: (state) => state.selectedFruits,
  },

  plugins: [createPersistedState()],
});

export default store;
