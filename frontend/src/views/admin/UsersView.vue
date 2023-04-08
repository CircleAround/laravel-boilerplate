<template>
    <div class="users">
        <h1>Users</h1>
        <table>
            <tr v-for="user in users" v-bind:key="user.id">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
            </tr>
        </table>
    </div>
</template>
<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

const users = ref([]);
onMounted(async () => {
    const url = "/api/users";
    const res = await axios.get(url);
    users.value = res.data;
});
</script>
