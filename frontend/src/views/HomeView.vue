<template>
  <div class="home">
    <h2>アサインされているタスク</h2>
    <table class="standard">
      <thead>
        <th>チーム</th>
        <th>タスクID</th>
        <th>タイトル</th>
        <th>担当者</th>
        <th>作成日時</th>
        <th>操作</th>
      </thead>
      <tr v-for="task in tasks" :key="task.id">
        <td>{{ task.team_id }}</td>
        <td>{{ task.id }}</td>
        <td>{{ task.title }}</td>
        <td>{{ task.assignee_id }}</td>
        <td>{{ task.created_at }}</td>
        <td>
          <router-link :to="`/tasks/${task.id}`">詳細</router-link>
        </td>
      </tr>
    </table>

    <h2>所属しているチーム</h2>
    <table class="standard">
      <thead>
        <th>チームID</th>
        <th>チーム名</th>
      </thead>
      <tr v-for="team in teams" :key="team.id">
        <td>{{ team.id }}</td>
        <td>{{ team.name }}</td>
      </tr>
    </table>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const tasks = ref([])
const teams = ref([])

;(async () => {
  const res = await axios.get(`/api/me/tasks`)
  tasks.value = res.data
})()
;(async () => {
  const res = await axios.get(`/api/me/teams`)
  teams.value = res.data
})()
</script>
