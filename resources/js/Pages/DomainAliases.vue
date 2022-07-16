<script setup>
import Layout from '@/Layouts/Layout.vue';
import DomainAliasList from '@/Components/DomainAliasList.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

defineProps({
  domains: {
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
    form.delete(`/domain-alias/${alias.id}`);
  }
};

const onSuccess = (_data) => form.reset();

const submit = (_e) => {
  if (form.id) {
    form.put(`/domain-alias/${form.id}`, { onSuccess });
  } else {
    form.post(`/domain-alias`, { onSuccess });
  }
};
</script>
<template>
  <Layout>
    <Head title="Redirecionamento de dominio" />
    <div id="domain-aliases">
      <form @submit.prevent="submit">
        <div class="form-line">
          <label for="source_id">Dominio de origem:</label>
          <select id="source_id" v-model="form.source_id">
            <option v-for="domain in $props.domains" :value="domain.id">
              {{ domain.name }}
            </option>
          </select>
        </div>
        <div class="form-line">
          <label for="destination">Domino de destino: </label>
          <input
            type="text"
            name=""
            id="destination"
            v-model="form.destination"
            placeholder="domain.com"
            required
          />
        </div>
        <div class="form-buttons">
          <button type="submit">Salvar</button>
        </div>
      </form>
      <DomainAliasList
        :aliases="$props.aliases"
        @edit="onEdit"
        @delete="onDelete"
      />
    </div>
  </Layout>
</template>
