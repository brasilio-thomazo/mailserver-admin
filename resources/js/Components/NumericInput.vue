<script setup>
const props = defineProps({
  id: {
    type: String,
    default: '',
  },
  name: {
    type: String,
    default: '',
  },
  modelValue: {
    typeof: Number,
    default: 0,
  },
})
const emits = defineEmits()

const keydown = (e) => {
  const regex = /\d+|ArrowLeft|ArrowRight|Delete|Backspace|Tab|Shift|Control/
  if (!regex.test(e.key)) {
    console.log(e.key)
    e.preventDefault()
  }
}

const input = (e) => {
  const { value } = e.target

  console.log(value)
  emits('update:modelValue', value !== '' ? parseInt(value) : null)
}
</script>
<template>
  <input
    type="text"
    :name="$props.name"
    :id="$props.id"
    :value="$props.modelValue"
    @keydown="keydown"
    @input="input"
  />
</template>
