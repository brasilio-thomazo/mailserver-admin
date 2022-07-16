<script setup>
import _ from 'lodash';

defineEmits(['edit', 'delete']);

const props = defineProps({
  users: {
    type: Array,
    default: [],
  },
});
</script>
<template>
  <div class="users">
    <div class="grid">
      <div class="header">
        <div class="col">#</div>
        <div class="col">E-mail</div>
        <div class="col"></div>
      </div>
      <div class="row" v-for="user in $props.users" :key="user.id">
        <div class="col">{{ user.id }}</div>
        <div class="col">{{ user.user }}@{{ user.domain.name }}</div>
        <div class="col buttons">
          <button
            type="button"
            class="icon material-icons"
            @click="$emit('edit', user)"
          >
            edit
          </button>
          <button
            type="button"
            class="icon material-icons"
            @click="$emit('delete', user)"
          >
            delete
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
