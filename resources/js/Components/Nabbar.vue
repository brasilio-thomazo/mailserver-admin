<script setup>
import { usePage, Link } from '@inertiajs/inertia-vue3';
const page = usePage();
</script>
<template>
  <nav id="navbar">
    <div class="brand">
      <img src="../assets/logo-dark.svg" alt="Logo" />
    </div>
    <ul class="menu">
      <li class="item">
        <Link href="">Usuários</Link>
      </li>
      <li class="item">
        <Link href="/domain">Dominios</Link>
      </li>
      <li class="item">
        <Link href="/domain-dkim">DKIM</Link>
      </li>
      <li class="item">
        <Link href="/domain-alias">Redirecionamento de dominio</Link>
      </li>
      <li class="item">
        <Link href="/domain-user">E-mails</Link>
      </li>
      <li class="item">
        <Link href="/domain-user-alias">Redirecionamento de e-mail</Link>
      </li>
    </ul>
  </nav>
</template>
