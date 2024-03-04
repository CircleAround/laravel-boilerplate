<template>
  <div>
    <h2>編集</h2>
    <div class="mini-panel">
      <ErrorPanel :error="error"></ErrorPanel>
      <form v-on:submit.prevent="handleSubmit">
        <div class="form-group">
          <label>名前:</label>
          <input type="text" v-model="team.name" :disabled="blocking" />
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

const team = ref({ id: route.params.id })
const error = ref({})
const blocking = ref(true)

const { setMessage } = inject(flashMessageKey)

;(async () => {
  const res = await axios.get(`/api/teams/${team.value.id}`)
  team.value = res.data

  blocking.value = false
})()

const handleSubmit = async () => {
  error.value = {}
  blocking.value = true

  try {
    await axios.patch(`/api/teams/${team.value.id}`, team.value)
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
