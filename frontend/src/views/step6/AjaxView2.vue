<template>
  <div>
    <input v-model="name"><button v-on:click="createTeam">送信</button> <!-- ① -->
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
  name: 'AjaxView2',
  setup() {
    const teams = ref([]) // ②
    onMounted(async function() { // ③
      const url = '/api/teams'
      const res = await axios.get(url) // ④
      teams.value = res.data // ⑤
    })


    const name = ref('')
    const createTeam = async function() {
      const url = '/api/teams'
      const res = await axios.post(url, { name: name.value }) // ④
      teams.value.push(res.data) // ⑤
    }

    return { teams, name, createTeam }
  }
};
</script>