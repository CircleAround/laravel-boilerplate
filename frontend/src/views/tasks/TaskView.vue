<template>
  <div>
    <h1>{{ task.team.name }}/{{ task.title }}</h1>
    <div> 
      <h2>内容</h2>
      <div>{{ task.body }}</div>
    </div>
  </div>
</template>
<script setup>
import { ref } from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios'

const task = ref({team:{}})
const route = useRoute()

;(async () => {
  const res = await axios.get(`/api/me/tasks/${route.params.id}`)
  task.value = res.data
})()
</script>
