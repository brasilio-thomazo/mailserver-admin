<script setup>
import Layout from '@/Layouts/Layout.vue';
import DomainUserAliasList from '@/Components/DomainUserAliasList.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

defineProps({
  users: {
    type: Array,
    default: [],
  },

  aliases: {
    type: Array,
    default: [],
  },
});

const form = useForm({
  id: null,
  source_id: null,
  destination: '',
});

const onEdit = (alias) => {
  form.id = alias.id;
  form.source_id = alias.source_id;
  form.destination = alias.destination;
};

const onDelete = (alias) => {
  if (confirm('Tem certeza que você quer remover o redirecionamento?')) {
    form.delete(`/domain-user-alias/${alias.id}`);
  }
};

const onSuccess = (_data) => form.reset();

const submit = (_e) => {
  if (form.id) {
    form.put(`/domain-user-alias/${form.id}`, { onSuccess });
  } else {
    form.post(`/domain-user-alias`, { onSuccess });
  }
};
</script>
<template>
  <Layout>
    <Head title="Redirecionamento de e-mail" />
    <div id="domain-aliases">
      <form @submit.prevent="submit">
        <div class="form-line">
          <label for="source_id">E-mail de origem:</label>
          <select id="source_id" v-model="form.source_id">
            <option v-for="user in $props.users" :value="user.id">
              {{ user.user }}@{{ user.domain.name }}
            </option>
          </select>
          <div v-if="form.errors.source_id" class="error">
            {{ form.errors.source_id }}
          </div>
        </div>
        <div class="form-line">
          <label for="destination">E-mail de destino: </label>
          <input
            type="text"
            name=""
            id="destination"
            v-model="form.destination"
            placeholder="domain.com"
            required
          />
          <div v-if="form.errors.destination" class="error">
            {{ form.errors.destination }}
          </div>
        </div>
        <div class="form-buttons">
          <button type="submit">Salvar</button>
        </div>
      </form>
      <DomainUserAliasList
        :aliases="$props.aliases"
        @edit="onEdit"
        @delete="onDelete"
      />
    </div>
  </Layout>
</template>
