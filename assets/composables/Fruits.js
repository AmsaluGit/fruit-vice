import { ref, computed } from "vue";
import axios from "axios";

export default function useFruits() {
  const fruits = ref([]);
  const allfruits = ref([]);

  const isLoading = ref(false);
  const searchTerm = ref("");
  const currentPage = ref(1);
  const itemsPerPage = ref(5);

  const fetchFruits = async () => {
    isLoading.value = true;
    try {
      const response = await axios.get("/fruit");
      fruits.value = response.data;
      allfruits.value = response.data;
    } catch (error) {
      console.error(error);
    } finally {
      isLoading.value = false;
    }
  };

  const filteredFruits = computed(() =>
    fruits.value.filter(
      (fruit) =>
        fruit.name.toLowerCase().includes(searchTerm.value.toLowerCase()) ||
        fruit.family.toLowerCase().includes(searchTerm.value.toLowerCase())
    )
  );

  const paginatedFruits = computed(() =>
    filteredFruits.value.slice(
      (currentPage.value - 1) * itemsPerPage.value,
      currentPage.value * itemsPerPage.value
    )
  );

  const totalPages = computed(() =>
    Math.ceil(filteredFruits.value.length / itemsPerPage.value)
  );

  const goToPage = (page) => {
    currentPage.value = page;
  };

  return {
    fruits: paginatedFruits,
    allfruits,
    isLoading,
    searchTerm,
    currentPage,
    itemsPerPage,
    totalPages,
    goToPage,
    fetchFruits,
  };
}
