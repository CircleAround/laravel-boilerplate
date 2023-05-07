<template>
  <header>
    <div v-if="user">
      <span>{{ user.name }}</span>
      <span v-if="user.role === 1">[管理者]</span>
      <a href="javascript:void(0)" @click="handleLogout">ログアウト</a>
    </div>
    <div v-else-if="user === undefined">...</div>
    <div v-else><router-link to="/login">ログイン</router-link>して利用してください</div>
    <nav>
      <router-link to="/">Home</router-link> |
      <router-link to="/about">About</router-link>

      <template v-if="user">
        <template v-if="user.role === 1"> | <router-link :to="{name: 'adminUsers'}">Admin/Users</router-link> </template>
      </template>
    </nav>
  </header>
  <FlashMessage></FlashMessage>
  <router-view />
</template>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
}

nav {
  padding: 30px;
}

nav a {
  font-weight: bold;
  color: #2c3e50;
}

nav a.router-link-exact-active {
  color: #42b983;
}
</style>

<script setup>
import { ref, onMounted, provide } from 'vue'
import { userKey } from '@/keys'
import axios from 'axios'
import FlashMessage from '@/components/FlashMessage.vue'
import { flashMessageKey } from './keys'

const user = ref()
provide(userKey, user)

const message = ref()
const flashMessageStore = {
  message,
  setMessage: (msg) => {
    message.value = msg

    setTimeout(() => {
      message.value = null
    }, 5000)
  }
}

provide(flashMessageKey, flashMessageStore)

onMounted(async () => {
  try {
    const res = await axios.get('/api/user')
    user.value = res.data
  } catch (err) {
    user.value = null
    console.log('ログインしていません')
  }
})

const handleLogout = async () => {
  await axios.post('/api/logout')
  user.value = null
  flashMessageStore.setMessage('ログアウトしました')
}
</script>
