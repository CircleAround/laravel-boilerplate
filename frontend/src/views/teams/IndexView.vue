<template>
  <div class="teams">
    <h2>Teams</h2>
    <div class="text-right">
      <router-link :to="{ name: 'teamCreate' }">新規作成</router-link>
    </div>

    <error-panel :error="error"></error-panel>

    <div v-if="teams === undefined">...</div>
    <table v-else class="standard">
      <thead>
        <th>ID</th>
        <th>名前</th>
      </thead>
      <tbody>
        <tr v-for="team in teams" v-bind:key="team.id">
          <th>{{ team.id }}</th>
          <td>
            <router-link :to="{ name: 'teamShow', params: { id: team.id } }">{{ team.name }}</router-link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'
import ErrorPanel from '@/components/ErrorPanel.vue'

const teams = ref()

const error = ref({})

;(async () => {
  try {
    const res = await axios.get('/api/teams')
    teams.value = res.data
  } catch (err) {
    error.value = { message: err.message }
  }
})()
</script>
