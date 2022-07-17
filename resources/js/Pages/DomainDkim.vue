<script setup>
import { useForm, Head } from '@inertiajs/inertia-vue3';
import Layout from '../Layouts/Layout.vue';
import DomainDkimList from '@/Components/DomainDkimList.vue';
import { ref } from 'vue';

const props = defineProps({
  config_file: {
    type: String,
    default: '/etc/opendkim.conf',
  },
  keys_dir: {
    type: String,
    default: '/etc/dkimkeys',
  },
  domains: {
    type: Array,
    default: [],
  },
  keys: {
    type: Array,
    default: [],
  },
  algorithms: {
    type: Array,
    default: [],
  },
});

const data = ref({
  selector: '',
  private_key: '',
  public_key: '',
  txt: '',
  keytable: '',
  signingtable: '',
  configs: '',
});

const form = useForm({
  id: null,
  domain_id: null,
  selector: '',
});

const submit = (_e) => {
  if (form.id) {
    form.put(`/domain-dkim/${form.id}`, {
      onSuccess: () => form.reset(),
    });
  } else {
    form.post('/domain-dkim', {
      onSuccess: (_data) => form.reset(),
    });
  }
};

const setSelector = () => (form.selector = `s${form.domain_id}`);

const onView = (dkim_key) => {
  prepareDkim(dkim_key);
};

const prepareDkim = (dkim_key) => {
  let keytable = `${dkim_key.selector}._domainkey.${dkim_key.domain.name}:${dkim_key.selector}:`;
  keytable += `${props.keys_dir}/${dkim_key.selector}.private`;

  let signingtable = `*@${dkim_key.domain.name}\t`;
  signingtable += `${dkim_key.selector}._domainkey.${dkim_key.domain.name}`;

  let configs = `KeyTable file:${props.keys_dir}/keytable\n`;
  configs += `SigningTable refile:${props.keys_dir}/signingtable`;

  let txt = `${dkim_key.selector}._domainkey.${dkim_key.domain.name}\tIN\tTXT\t"`;
  txt += `v=DKIM; h=${dkim_key.algorithm}; k=rsa; p=`;
  dkim_key.public_key.split('\n').forEach((line) => {
    txt += !/BEGIN PUBLIC KEY|END PUBLIC KEY/.test(line) ? line : '';
  });
  txt += '"';

  data.value = {
    private_key: dkim_key.private_key,
    public_key: dkim_key.public_key,
    signingtable,
    keytable,
    txt,
    configs,
    selector: dkim_key.selector,
  };
};
</script>
<template>
  <Layout>
    <Head title="Chave DKIM" />
    <div id="domain-dkim">
      <form @submit.prevent="submit">
        <div class="form-line">
          <label for="name">Dominio:</label>
          <select id="domain_id" v-model="form.domain_id" @change="setSelector">
            <option
              v-for="domain in $props.domains"
              :value="domain.id"
              :key="domain.id"
            >
              {{ domain.name }}
            </option>
          </select>
          <div v-if="form.errors.domain_id" class="error">
            {{ form.errors.domain_id }}
          </div>
        </div>
        <div class="form-line">
          <label for="selector">Seletor</label>
          <input type="text" id="selector" v-model="form.selector" />
          <div v-if="form.errors.selector" class="error">
            {{ form.errors.selector }}
          </div>
        </div>
        <div class="form-buttons">
          <button type="submit">Salvar</button>
        </div>
        <div class="info" v-if="data.private_key">
          <div class="form-line">
            <div class="label">
              Chave privada:
              <span class="filename">
                {{ $props.keys_dir }}/{{ data.selector }}.private
              </span>
            </div>
            <pre class="private-key">{{ data.private_key }}</pre>
          </div>
          <div class="form-line">
            <label for="public_key">Chave publica:</label>
            <pre class="public-key">{{ data.public_key }}</pre>
          </div>
          <div class="form-line">
            <div class="label">
              DKIM keytable:
              <span class="filename">{{ $props.keys_dir }}/keytable</span>
            </div>
            <pre class="txt">{{ data.keytable }}</pre>
          </div>
          <div class="form-line">
            <div class="label">
              DKIM signingtable:
              <span class="filename">{{ $props.keys_dir }}/signingtable</span>
            </div>
            <pre class="txt">{{ data.signingtable }}</pre>
          </div>
          <div class="form-line">
            <div class="label">
              Configurações OpenDKIM:
              <span class="filename">{{ $props.config_file }}</span>
            </div>
            <pre class="configs">{{ data.configs }}</pre>
          </div>
          <div class="form-line">
            <label for="txt">DNS:</label>
            <pre class="txt">{{ data.txt }}</pre>
          </div>
        </div>
      </form>
      <DomainDkimList :dkim_keys="props.keys" @view="onView" />
    </div>
  </Layout>
</template>
