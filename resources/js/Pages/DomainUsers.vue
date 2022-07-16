<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import Layout from '@/Layouts/Layout.vue';
import DomainUserList from '@/Components/DomainUserList.vue';

defineProps({
  domains: {
    type: Array,
    default: [],
  },
  users: {
    type: Array,
    default: [],
  },
});

const form = useForm({
  id: null,
  domain_id: null,
  user: '',
  password: '',
  password_confirmation: '',
});

const submit = (_e) => {
  if (form.id) {
    form.put(`domain-user/${form.id}`, {
      onSuccess: (_data) => form.reset(),
    });
  } else {
    form.post('domain-user', {
      onSuccess: (_data) => form.reset(),
    });
  }
};

const edit = (user) => {
  form.id = user.id;
  form.domain_id = user.domain_id;
  form.user = user.user;
  form.password = null;
  form.password_confirmation = null;
};
</script>
<template>
  <Layout>
    <div id="domain-users">
      <form @submit.prevent="submit">
        <div class="form-line">
          <label for="user">E-mail:</label>
          <div class="grid-3">
            <div class="form-group">
              <input type="text" name="user" id="user" v-model="form.user" />
              <div class="error" v-if="form.errors.user">
                {{ form.errors.user }}
              </div>
            </div>
            <span>@</span>
            <div class="form-group">
              <select id="domain_id" v-model="form.domain_id">
                <option
                  v-for="domain in $props.domains"
                  :value="domain.id"
                  :key="domain.id"
                >
                  {{ domain.name }}
                </option>
              </select>
              <div class="error" v-if="form.errors.domain_id">
                {{ form.errors.domain_id }}
              </div>
            </div>
          </div>
        </div>
        <div class="form-line">
          <div class="grid-2">
            <label for="password">Senha:</label>
            <label for="password_confirmation">Confirme a senha:</label>
          </div>
          <div class="grid-2">
            <div class="form-group">
              <input type="password" id="password" v-model="form.password" />
              <div v-if="form.errors.password" class="error">
                {{ form.errors.password }}
              </div>
            </div>
            <input
              type="password"
              id="password_confirmation"
              v-model="form.password_confirmation"
            />
          </div>
        </div>
        <div class="buttons">
          <button type="submit">Salvar</button>
        </div>
      </form>
      <DomainUserList
        :users="$props.users"
        :domains="$props.domains"
        @edit="edit"
      />
    </div>
  </Layout>
</template>
