<template>
  <div>
    <h1>ログイン</h1>
    <input type="text" name="email" v-model="email" />
    <input type="password" name="password" v-model="password" />
    <button type="button" @click="handleLogin">ログイン</button>
  </div>
</template>

<script setup>
import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'
import { flashMessageKey, userKey } from '../keys'

const email = ref('user1@example.com')
const password = ref('password')

const user = inject(userKey)
const router = useRouter()
const {setMessage} = inject(flashMessageKey)

const handleLogin = async () => {
  await axios.get('/sanctum/csrf-cookie')
  const res = await axios.post('/api/login', { email: email.value, password: password.value })
  user.value = res.data

  setMessage('ログインしました')
  router.push('/')
}
</script>
