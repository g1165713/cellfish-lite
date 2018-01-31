<template lang="html">
    <div class="container">
        <app-header/>
        <h2>News</h2>
        <div
            class="post"
            v-for="post in posts">
            <span>{{ formatDate(post.created_at) }}</span>
            <router-link :to="{ name: 'Post', params: {id: post.id} }">{{ post.title }}</router-link>
        </div>
        <app-footer/>
    </div>
</template>

<script>
import moment from "moment"
import {getUnwrap} from "../request"

import AppHeader from "../partials/Header.vue"
import AppFooter from "../partials/Footer.vue"

export default {
    components: {AppHeader, AppFooter},
    data() {
        return {posts: []}
    },
    mounted() {
        this.loadPosts()
    },
    methods: {
        loadPosts() {
            getUnwrap("/api/post/list.php").then(data => this.posts = data)
        },
        formatDate(timestamp) {
            return moment.unix(timestamp).format("YYYY-MM-DD")
        }
    },
}
</script>

<style lang="css" scoped>
.container {
    width: 900px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    font-family: "Roboto";
}

h2 {
    font-size: 25px;
    font-weight: bold;
    margin-bottom: 15px;
}

.post {
    font-size: 18px;
    margin-bottom: 5px;
}
</style>
