<script setup>
import Nabbar from '../Components/Nabbar.vue'
</script>

<template>
  <div id="layout">
    <header>
      <Nabbar />
    </header>
    <!-- Page Content -->
    <main>
      <slot />
    </main>
  </div>
</template>
