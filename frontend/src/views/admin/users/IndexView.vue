<template>
  <div class="users">
    <h2>Admin/Users</h2>
    <div class="text-right">
      <router-link :to="{ name: 'adminUserCreate' }">新規作成</router-link>
    </div>

    <div v-if="users === undefined">...</div>
    <table v-else class="standard">
      <thead>
        <th>ID</th>
        <th>権限</th>
        <th>名前</th>
        <th>Email</th>
        <th>操作</th>
      </thead>
      <tbody>
        <tr v-for="user in users" v-bind:key="user.id">
          <th>{{ user.id }}</th>
          <td>{{ { 0: '通常', 1: '管理者'}[user.role] }}</td>
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>
            <router-link :to="{ name: 'adminUserEdit', params: { id: user.id } }">編集</router-link>
            &nbsp;
            <a @click.prevent="handleDelete(user)" href="#">削除</a>
          </td>
        </tr>
      </tbody>
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
  if(!window.confirm('本当に削除しますか？')) {
    return 
  }

  await axios.delete(`/api/users/${user.id}`)
  await reloadUsers()
  setMessage('削除しました')
}
</script>
