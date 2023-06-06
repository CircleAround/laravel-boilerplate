<template>
  <div>
    <ul>
      <li v-for="team in teams" :key="team.id">
        {{ team.name }}
      </li>
    </ul>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue'
import axios from 'axios' // ①

export default {
  name: 'AjaxView',
  setup() {
    const teams = ref([]) // ②
    onMounted(async function() { // ③
      const url = '/api/teams'
      const res = await axios.get(url) // ④
      teams.value = res.data // ⑤
    })

    return { teams }
  }
};
</script>