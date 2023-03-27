<template>
  <v-card class="mx-auto" max-width="1200">
    <v-layout>
      <v-app-bar color="primary mb-3" density="compact">
        <template v-slot:prepend>
          <v-app-bar-nav-icon></v-app-bar-nav-icon>
        </template>

        <v-app-bar-title>Fruits</v-app-bar-title>

        <template v-slot:append>
          <v-btn icon="mdi-dots-vertical"></v-btn>
        </template>
      </v-app-bar>
      <slot></slot>

      <RouterView />
    </v-layout>
  </v-card>
</template>
 <script setup>
import { RouterView } from "vue-router";
</script>


<style>
/* ... */
</style>;
