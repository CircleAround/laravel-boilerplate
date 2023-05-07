<template>
  <div class="users">
    <h1>Users</h1>
    <router-link :to="{ name: 'adminUserCreate' }">新規作成</router-link>
    <div v-if="users === undefined">...</div>
    <table v-else>
      <tr v-for="user in users" v-bind:key="user.id">
        <td>{{ user.id }}</td>
        <td>{{ user.name }}</td>
        <td>{{ user.email }}</td>
        <td>
          <router-link :to="{ name: 'adminUserEdit', params: { id: user.id } }">編集</router-link>
          <a @click.prevent="handleDelete(user)" href="#">削除</a>
        </td>
      </tr>
    </table>
  </div>
</template>
<script setup>
import { inject, ref } from 'vue'
import axios from 'axios'
import { flashMessageKey } from '@/keys'

const users = ref()
const { setMessage } = inject(flashMessageKey)

const reloadUsers = async () => {
  const res = await axios.get('/api/users')
  users.value = res.data
}

;(async () => {
  await reloadUsers()
})()

const handleDelete = async (user) => {
  await axios.delete(`/api/users/${user.id}`)
  await reloadUsers()
  setMessage('削除しました')
}
</script>
