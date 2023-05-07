<template>
  <div>
    <div>編集</div>
    <div class="card-body">
      <ErrorPanel :error="error"></ErrorPanel>
      <form v-on:submit.prevent="handleSubmit">
        <div class="form-group">
          <label>名前:</label>
          <input type="text" class="form-control" v-model="user.name" :disabled="blocking" />
        </div>
        <div class="form-group">
          <label>Email:</label>
          <input type="text" class="form-control" v-model="user.email" :disabled="blocking" />
        </div>
        <div class="form-group">
          <label>パスワード:</label>
          <input type="password" class="form-control" v-model="user.password" :disabled="blocking" />
        </div>
        <div class="form-group">
          <label>権限:</label>
          <select class="form-control" v-model="user.role" :disabled="blocking">
            <option value="0">通常</option>
            <option value="1">管理者</option>
          </select>
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="更新する" :disabled="blocking" />
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { inject, ref } from 'vue'
import { useRoute } from 'vue-router'
import axios, { AxiosError } from 'axios'
import { flashMessageKey } from '@/keys'
import ErrorPanel from '@/components/ErrorPanel'

const route = useRoute()

const user = ref({ id: route.params.id })
const error = ref({})
const blocking = ref(true)

const { setMessage } = inject(flashMessageKey)

;(async () => {
  const res = await axios.get(`/api/users/${user.value.id}`)
  user.value = res.data

  blocking.value = false
})()

const handleSubmit = async () => {
  error.value = {}
  blocking.value = true

  try {
    await axios.patch(`/api/users/${user.value.id}`, user.value)
    setMessage('更新しました')
  } catch (err) {
    if (err instanceof AxiosError && err.response.status === 422) {
      error.value = err.response.data
    } else {
      error.value = { message: err.message }
    }
  }

  blocking.value = false
}
</script>
