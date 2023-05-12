<template>
  <div class="home">
    <router-link :to="{ name: 'teams' }">チーム管理</router-link>
  </div>
</template>

<script>
export default {
  name: 'HomeView',
}
</script>
