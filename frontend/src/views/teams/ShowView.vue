<template>
  <div>
    <h2>{{ team.name }}</h2>
    <router-link :to="{ name: 'teamEdit', params: { id: team.id } }">編集</router-link>
    <div>
      <h3>サマリー</h3>
      <div v-if="summary.latest_commented_task">
        最新コメントのタスク: {{ summary.latest_commented_task.title }}( {{ summary.latest_commented_task.id }} )

        <table border="1">
          <thead>
            <th>タスクID</th>
            <th>タイトル</th>
            <th>コメントの数</th>
          </thead>
          <tbody>
            <tr v-for="task in summary.task_summary" v-bind:key="task.id">
              <td>{{ task.id }}</td>
              <td>{{ task.title }}</td>
              <td>{{ task.comment_count }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div v-else>チームのタスクにコメントはありません</div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios'

const route = useRoute()

const team = ref({ id: route.params.id })
const summary = ref({})
const blocking = ref(true)

;(async () => {
  const [teamRes, summaryRes] = await Promise.all([
    axios.get(`/api/teams/${team.value.id}`),
    axios.get(`/api/teams/${team.value.id}/summary`)
  ])
  team.value = teamRes.data
  summary.value = summaryRes.data

  blocking.value = false
})()
</script>
