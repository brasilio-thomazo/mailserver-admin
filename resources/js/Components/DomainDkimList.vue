<script setup>
defineEmits(['view']);
defineProps({
  dkim_keys: {
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
        <div class="col">Seletor</div>
        <div class="col"></div>
      </div>
      <div class="row" v-for="dkim_key in $props.dkim_keys" :key="dkim_key.id">
        <div class="col">{{ dkim_key.id }}</div>
        <div class="col">{{ dkim_key.domain.name }}</div>
        <div class="col">{{ dkim_key.selector }}._domainkey</div>
        <div class="col buttons">
          <button
            type="button"
            class="icon material-icons"
            @click="$emit('view', dkim_key)"
          >
            file_open
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
