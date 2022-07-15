<script setup>
import { useForm, Head } from '@inertiajs/inertia-vue3';
import Layout from '../Layouts/Layout.vue';
import NumericInput from '../Components/NumericInput.vue';
import DomainList from '@/Components/DomainList.vue';

const props = defineProps({
  domains: {
    type: Array,
    default: [],
  },
});

const form = useForm({
  id: null,
  name: '',
  home: '',
  uid: 1000,
  gid: 1000,
});

const submit = (_e) => {
  if (form.id) {
    form.put(`/domain/${form.id}`, {
      onSuccess: () => form.reset(),
    });
  } else {
    form.post('/domain', {
      onSuccess: (_data) => form.reset('id', 'name', 'home'),
    });
  }
};

const edit = (data) => {
  form.id = data.id;
  form.name = data.name;
  form.home = data.home;
  form.uid = data.uid;
  form.gid = data.gid;
};
</script>
<template>
  <Layout>
    <Head title="Dominios" />
    <div id="domains">
      <form @submit.prevent="submit">
        <div class="form-line">
          <label for="name">Dominio:</label>
          <input type="text" name="name" id="name" v-model="form.name" />
          <div v-if="form.errors.name" class="error">
            {{ form.errors.name }}
          </div>
        </div>
        <div class="form-line">
          <div class="grid-3">
            <label for="home">Home</label>
            <label for="uid">UID</label>
            <label for="gid">GID</label>
          </div>
          <div class="grid-3">
            <div class="form-group">
              <input type="text" name="home" id="home" v-model="form.home" />
              <div v-if="form.errors.home" class="error">
                {{ form.errors.home }}
              </div>
            </div>
            <div class="form-group">
              <NumericInput name="uid" id="uid" v-model="form.uid" />
              <div v-if="form.errors.uid" class="error">
                {{ form.errors.uid }}
              </div>
            </div>
            <div class="form-group">
              <NumericInput name="gid" id="gid" v-model="form.gid" />
              <div v-if="form.errors.gid" class="error">
                {{ form.errors.gid }}
              </div>
            </div>
          </div>
        </div>
        <div class="form-buttons">
          <button type="submit">Salvar</button>
        </div>
      </form>
      <DomainList :domains="props.domains" @edit="edit" />
    </div>
  </Layout>
</template>
