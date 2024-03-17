<template>
  <div>
    <div v-if="task.status === 1" class="info-message">このタスクは完了しました</div>
    <h1>{{ task.team.name }}/{{ task.title }}</h1>
    <div>
      <h2>内容</h2>
      <div>{{ task.body }}</div>
    </div>
    <div>
      <h2>コメント</h2>
      <div v-for="comment in comments" :key="comment.id">
        <div>{{ comment.message }}</div>
        <div>{{ comment.created_at }} {{ comment.author.name }}</div>
        <hr />
      </div>
      <div>
        <label for="message">本文</label>
        <div>
          <textarea id="message" rows="5" cols="80" v-model="message"></textarea>
        </div>
        <div v-if="task.status != 1">
          <label for="finished">完了報告とする</label><input id="finished" type="checkbox" v-model="finished" />
        </div>
        <div>
          <button type="button" v-on:click="handleCommentPost">送信</button>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
.info-message {
  background-color: lightblue;
  color: blue;
  padding: 2px 4px;
}
</style>
<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios'

const task = ref({ team: {} })
const comments = ref([])
const message = ref('')
const finished = ref(false)
const route = useRoute()

const handleCommentPost = () => {
  // eslint-disable-next-line no-extra-semi
  ;(async () => {
    await axios.post(`/api/tasks/${route.params.id}/comments`, {
      message: message.value,
      kind: finished.value ? 1 : 0
    })

    message.value = ''
    finished.value = false

    const commentsRes = await axios.get(`/api/tasks/${route.params.id}/comments`)
    comments.value = commentsRes.data
  })()
}

onMounted(async () => {
  const [taskRes, commentsRes] = await Promise.all([
    axios.get(`/api/tasks/${route.params.id}`),
    axios.get(`/api/tasks/${route.params.id}/comments`)
  ])
  task.value = taskRes.data
  comments.value = commentsRes.data
})
</script>
