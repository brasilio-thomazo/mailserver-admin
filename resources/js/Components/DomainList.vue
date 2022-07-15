<script setup>
defineEmits(['edit', 'delete']);
defineProps({
  domains: {
    type: Array,
    default: [],
  },
});
</script>
<template>
  <div class="domains">
    <div class="grid">
      <div class="header">
        <div class="col">#</div>
        <div class="col">Dominio</div>
        <div class="col">Home</div>
        <div class="col">UID</div>
        <div class="col">GID</div>
        <div class="col"></div>
      </div>
      <div class="row" v-for="domain in $props.domains" :key="domain.id">
        <div class="col">{{ domain.id }}</div>
        <div class="col">{{ domain.name }}</div>
        <div class="col">{{ domain.home }}</div>
        <div class="col">{{ domain.uid }}</div>
        <div class="col">{{ domain.gid }}</div>
        <div class="col buttons">
          <button
            type="button"
            class="icon material-icons"
            @click="$emit('edit', domain)"
          >
            edit
          </button>
          <button
            type="button"
            class="icon material-icons"
            @click="$emit('delete', domain)"
          >
            delete
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
