<template>
  <div v-if="message" class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4 shadow">
    {{ message }}
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

const page = usePage()
const message = computed(() => page.props?.flash?.success || '')
</script>
