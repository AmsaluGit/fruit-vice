<template>
  <v-container fluid class="mt-12">
    <v-spacer></v-spacer>
    <v-card-title> Favorite Fruits </v-card-title>
    <v-table>
      <thead>
        <tr>
          <th class="text-left">Name</th>
          <th class="text-left">Family</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="item in selectedFruits" :key="item.name">
          <td>{{ item.name }}</td>
          <td>{{ item.family }}</td>
        </tr>
      </tbody>
    </v-table>
    <v-spacer></v-spacer>
    <v-card-title class="text-center">
      Selected Fruits Nutritions Summary
    </v-card-title>

    <v-table>
      <thead>
        <tr>
          <td>Nutritions</td>
          <td>Sum Amount</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>carbohydrates</td>
          <td>{{ totalNutritionFacts.carbohydrates.toFixed(2) }} g</td>
        </tr>
        <tr>
          <td>protein</td>
          <td>{{ totalNutritionFacts.protein.toFixed(2) }} g</td>
        </tr>
        <tr>
          <td>fat</td>
          <td>{{ totalNutritionFacts.fat.toFixed(2) }} g</td>
        </tr>
        <tr>
          <td>calories</td>
          <td>{{ totalNutritionFacts.calories.toFixed(2) }} g</td>
        </tr>
        <tr>
          <td>sugar</td>
          <td>{{ totalNutritionFacts.sugar.toFixed(2) }} g</td>
        </tr>
      </tbody>
    </v-table>
  </v-container>
</template>



<script setup>
import useFruits from "../composables/Fruits";

import { computed, onMounted } from "vue";

import { useRouter } from "vue-router";
import { useStore } from "vuex";

const { allfruits, fetchFruits } = useFruits();

const router = useRouter();
const store = useStore();

const selectedFruitsIds = computed(() => store.getters.selectedFruits);

const selectedFruits = computed(() =>
  allfruits.value.filter((fruit) => selectedFruitsIds.value.includes(fruit.id))
);

const totalNutritionFacts = computed(() => {
  return selectedFruits.value.reduce(
    (total, fruit) => {
      total.carbohydrates += fruit.nutritions.carbohydrates;
      total.protein += fruit.nutritions.protein;
      total.fat += fruit.nutritions.fat;
      total.calories += fruit.nutritions.calories;
      total.sugar += fruit.nutritions.sugar;
      return total;
    },
    { carbohydrates: 0, protein: 0, fat: 0, calories: 0, sugar: 0 }
  );
});

onMounted(() => {
  fetchFruits();
});
</script>