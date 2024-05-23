<template>
  <div>
    <ul>
      <li v-for="user in users" :key="user.id">{{ user.name }}: {{ user.email }}</li>
    </ul>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue'
import axios from 'axios' // ①

export default {
  name: 'AjaxView',
  setup() {
    const users = ref([]) // ②
    onMounted(async function () {
      // ③
      const url = '/api/users'
      const res = await axios.get(url) // ④
      users.value = res.data // ⑤
    })

    return { users }
  }
}
</script>
