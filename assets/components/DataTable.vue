<template>
  <v-container fluid style="margin: 20px">
    <v-card-title>
      Fruits
      <v-spacer></v-spacer>
      <div>
        <v-text-field v-model="searchTerm" label="Search" />
        <v-table :isLoading="isLoading">
          <thead>
            <tr>
              <!-- <th class="text-left">Select</th> -->
              <th class="text-left">fav</th>
              <th class="text-left">Name</th>
              <th class="text-left">Family</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="item in fruits" :key="item.name">
              <!-- <td>
                <v-checkbox
                  v-model="selectedFruits"
                  :value="item.id"
                  @change="onChangeSelectedFruits"
                />
              </td> -->
              <td>
                <button
                  class="favorite-button"
                  :class="{ favorite: isSelected(item.id) }"
                  @click="toggleSelection(item.id)"
                >
                  <i class="fa fa-heart"></i>
                </button>
              </td>

              <td>{{ item.name }}</td>
              <td>{{ item.family }}</td>
            </tr>
          </tbody>
        </v-table>
        <v-pagination
          v-model="currentPage"
          :total-visible="7"
          :length="totalPages"
          @input="goToPage"
        />
        <v-btn
          @click="submitSelectedFruits"
          :disabled="selectedFruits.length === 0"
          >Favorite {{ selectedFruits.length }}</v-btn
        >
      </div>
    </v-card-title>
  </v-container>
</template>

<script setup>
import useFruits from "../composables/Fruits";
import { useRouter } from "vue-router";
import { useStore } from "vuex";

import { ref, onMounted, watch, computed } from "vue";
const router = useRouter();
const {
  fruits,
  isLoading,
  searchTerm,
  currentPage,
  totalPages,
  goToPage,
  fetchFruits,
} = useFruits();

const search = ref("");
const page = ref(1);
const selectedFruits = ref([]);
const maxSelectableFruits = 10;

watch(search, () => {
  paginate(1, search.value);
});

const store = useStore();
// selectedFruits.value = store.getters.selectedFruits;

computed(() => {
  store.commit("setSelectedFruits", selectedFruits.value);
});

// function onChangeSelectedFruits() {
//   store.commit("setSelectedFruits", selectedFruits.value);
// }

function submitSelectedFruits() {
  router.push({
    name: "detail",
  });
}

const selectedFruitsIds = computed(() => store.getters.selectedFruits);

function isSelected(id) {
  return selectedFruitsIds.value.includes(id);
}

function toggleSelection(id) {
  const index = selectedFruitsIds.value.indexOf(id);

  if (index !== -1) {
    store.commit("removeSelectedFruit", id);
  } else {
    if (selectedFruitsIds.value.length < 10) {
      store.commit("addSelectedFruit", id);
    } else {
      alert("You can select up to 10 fruits.");
    }
  }
}

onMounted(() => {
  fetchFruits();

  if (store.getters.selectedFruits) {
    selectedFruits.value = store.getters.selectedFruits;
  }
});
</script>


<style scoped>
.favorite {
  color: red;
}
.fruit-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin: 10px 0;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}
.fruit-name {
  font-weight: bold;
  font-size: 20px;
}
.favorite-button {
  background: none;
  border: none;
  cursor: pointer;
  font-size: 30px;
  padding: 0;
}
</style>
