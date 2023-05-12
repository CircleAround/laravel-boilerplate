<template>
  <div>
    <h2>{{ team.name }}</h2>
    <router-link :to="{ name: 'teamEdit', params: { id: team.id } }">編集</router-link>
    <div>
      <div v-if="team.latest_commented_task">
        最新コメントのタスク: {{ team.latest_commented_task.title }}( {{ team.latest_commented_task.id }} )
      </div>
      <div v-else>チームのタスクにコメントはありません</div>
    </div>
  </div>
</template>

<script setup>
import { inject, ref } from 'vue'
import { useRoute } from 'vue-router'
import axios, { AxiosError } from 'axios'
import { userKey, flashMessageKey } from '@/keys'
import ErrorPanel from '@/components/ErrorPanel'

const route = useRoute()

const currentUser = inject(userKey) // ログイン中のユーザー取得
const team = ref({ id: route.params.id })
const error = ref({})
const blocking = ref(true)

const { setMessage } = inject(flashMessageKey)

;(async () => {
  const res = await axios.get(`/api/teams/${team.value.id}`)
  team.value = res.data

  blocking.value = false
})()
</script>
