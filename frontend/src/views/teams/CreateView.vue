<template>
  <div>
    <h2>新規作成</h2>
    <div class="mini-panel">
      <ErrorPanel :error="error"></ErrorPanel>
      <form v-on:submit.prevent="handleSubmit">
        <div class="form-group">
          <label>名前:</label>
          <input type="text" v-model="team.name" :disabled="blocking" />
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="作成する" :disabled="blocking" />
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { inject, ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import axios, { AxiosError } from 'axios'
import { flashMessageKey } from '@/keys'
import ErrorPanel from '@/components/ErrorPanel'

const route = useRoute()
const router = useRouter()

const team = ref({ id: route.params.id })
const error = ref({})
const blocking = ref(false)

const { setMessage } = inject(flashMessageKey)

const handleSubmit = async () => {
  error.value = {}
  blocking.value = true

  try {
    await axios.post('/api/teams', team.value)
    setMessage('作成しました')
    router.push('/teams')
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
