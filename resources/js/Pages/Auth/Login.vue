<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3'

const form = useForm({
  username: '',
  password: '',
  remember: false,
})

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password'),
  })
}
</script>

<template>
  <div id="login">
    <Head title="Login" />
    <form @submit.prevent="submit">
      <div class="header">
        <img src="../../assets/logo-dark.svg" alt="Logo" />
      </div>
      <div class="form-line">
        <label for="username">Usuário:</label>
        <input
          type="text"
          name="username"
          id="username"
          autocomplete="off"
          v-model="form.username"
        />
        <div v-if="form.errors.username" class="error">
          {{ form.errors.username }}
        </div>
      </div>
      <div class="form-line">
        <label for="password">Senha:</label>
        <input
          type="password"
          name="password"
          id="password"
          v-model="form.password"
        />
      </div>
      <div class="form-line">
        <div class="checkbox">
          <input
            type="checkbox"
            name="remember"
            id="remember"
            v-model="form.remember"
          />
          <label for="remember">Lembrar-me</label>
        </div>
      </div>
      <div class="form-buttons">
        <button type="submit">Entrar</button>
      </div>
    </form>
  </div>
</template>
