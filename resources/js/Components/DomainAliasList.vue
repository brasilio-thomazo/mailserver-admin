<script setup>
import _ from 'lodash';

defineEmits(['edit', 'delete']);

defineProps({
  aliases: {
    type: Array,
    default: [],
  },
});
</script>
<template>
  <div class="aliases">
    <div class="grid">
      <div class="header">
        <div class="col">#</div>
        <div class="col">Origem</div>
        <div class="col">Destino</div>
        <div class="col"></div>
      </div>
      <div class="row" v-for="alias in $props.aliases" :key="alias.id">
        <div class="col">{{ alias.id }}</div>
        <div class="col">{{ alias.domain.name }}</div>
        <div class="col">{{ alias.destination }}</div>
        <div class="col buttons">
          <button
            type="button"
            class="icon material-icons"
            @click="$emit('edit', alias)"
          >
            edit
          </button>
          <button
            type="button"
            class="icon material-icons"
            @click="$emit('delete', alias)"
          >
            delete
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
