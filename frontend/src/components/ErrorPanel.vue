<template>
  <div>
    <div v-if="error.message || error.errors" class="alert alert-danger">エラーが発生しました</div>
    <ul v-if="error.errors">
      <li v-for="(error, key) in error.errors" v-bind:key="key">{{ error.join(',') }}</li>
    </ul>
    <div v-else-if="error.message">
      {{ error.message }}
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue'

defineProps(['error'])
</script>
