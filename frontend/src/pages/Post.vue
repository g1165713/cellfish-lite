<template lang="html">
    <div class="container">
        <app-header/>
        <main>
            <h2>{{ post.title }}</h2>
            <button @click="like">
                {{ liked ? "unlike" : "like" }}
            </button>
            <span>{{ likeCount }}</span>
            <img
                v-if="post.image"
                :src="imageURL(post.image)">
            <p v-for="p in paragraphs">
                {{ p }}
            </p>

            <h3>Comments</h3>
            <div class="comment-editor">
                <textarea v-model="content"/>
                <button @click="addComment">Add comment</button>
            </div>
            <post-comment
                v-for="c in comments"
                :comment="c"/>
        </main>
        <app-footer/>
    </div>
</template>

<script>
import {getUnwrap, postUnwrap} from "../request"

import AppHeader from "../partials/Header.vue"
import AppFooter from "../partials/Footer.vue"
import PostComment from "./PostComment.vue"

export default {
    components: {AppHeader, AppFooter, PostComment},
    data() {
        return {
            id: this.$route.params.id,
            post: {title: "", image: null, content: ""},
            likeCount: 0, liked: false, comments: [],
            content: ""
        }
    },
    computed: {
        paragraphs() {
            return this.post.content.split("\n\n")
        }
    },
    mounted() {
        getUnwrap("/api/post/get.php", {id: this.id})
            .then(data => this.post = data)

        getUnwrap("/api/like/get_count.php", {id: this.id})
            .then(data => this.likeCount = data)

        getUnwrap("/api/like/get_status.php", {id: this.id})
            .then(data => this.liked = data)

        getUnwrap("/api/comment/get_children.php", {id: this.id})
            .then(data => this.comments = data)
    },
    methods: {
        imageURL(hash) {
            return `/api/image.php?hash=${hash}`
        },
        like() {
            postUnwrap("/api/like/toggle.php", {id: this.id})
                .then(data => {
                    this.liked = data
                    return getUnwrap("/api/like/get_count.php", {id: this.id})
                })
                .then(data => this.likeCount = data)
        },
        addComment() {
            postUnwrap("/api/comment/add.php", {parent: this.id, content: this.content})
                .then(() => {
                    this.content = ""
                    return getUnwrap("/api/comment/get_children.php", {id: this.id})
                })
                .then(data => this.comments = data)
        }
    },
}
</script>

<style lang="css">
.container {
    width: 900px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    font-family: "Roboto";
}

main {
    width: 70%;
}

main > h2 {
    font-size: 30px;
    font-weight: bold;
    margin-bottom: 10px;
}

main > p {
    font-size: 16px;
    line-height: 1.3;
    margin-bottom: 30px;
}

h3 {
    font-size: 25px;
    font-weight: bold;
    margin-bottom: 20px;
}

.comment-editor {
    display: flex;
    flex-direction: column;
    margin-bottom: 30px;
}

.comment-editor > button {
    width: 150px;
}
</style>
