<template lang="html">
    <div class="container">
        <app-header />
        <main v-if="mode === 'list'">
            <div class="top-bar">
                <h3 class="pane-title">Post</h3>
                <button @click="addPost">Add Post</button>
                <div>
                    Show
                    <select @change="updatePageSize">
                        <option value="5">5</option>
                        <option value="10">10</option>
                    </select>
                    Entries
                </div>

                <div>
                    <button @click="previousPage">prev</button>
                    {{ page + 1 }} / {{ numPage }}
                    <button @click="nextPage">next</button>
                </div>
            </div>
            <table>
                <tr>
                    <th>Last update</th>
                    <th>Title</th>
                    <th/>
                </tr>
                <tr v-for="post in visibleSection">
                    <td>{{ formatDate(post.updated_at) }}</td>
                    <td>{{ post.title }}</td>
                    <td>
                        <button @click="editPost(post)">Edit</button>
                        <button @click="deletePost(post)">Delete</button>
                    </td>
                </tr>
            </table>
        </main>
        <main
            class="editor"
            v-if="mode === 'editor'">
            <div>
                <span class="label">Title</span>
                <input
                    class="textfield"
                    type="text"
                    v-model="title">
            </div>
            <div>
                <span class="label">Content</span>
                <textarea
                    class="textfield content"
                    v-model="content"/>
            </div>
            <div>
                <span class="label">Attachment</span>
                <div>
                    <button
                        v-if="image !== null"
                        @click="deleteImage">Delete</button>
                    <input
                        type="file"
                        @change="loadImage($event)">
                    <br>
                    <img :src="image">
                </div>
            </div>
            <div>
                <span/>
                <button @click="mode = 'list'">back</button>
                <button @click="submit">submit</button>
            </div>
        </main>
    </div>
</template>

<script>
import axios from "axios"
import moment from "moment"
import {getUnwrap, postUnwrap} from "../../request"

import AppHeader from "../../partials/Header.vue"


function readAsDataURL(data) {
    return new Promise(resolve => {
        const reader = new FileReader()
        reader.readAsDataURL(data)
        reader.onload = () => resolve(reader.result)
    })
}

export default {
    components: {AppHeader},
    data() {
        return {
            mode: "list", action: "insert", pageSize: 5, page: 0,
            posts: [],
            id: "", image: null, title: "", content: "",
        }
    },
    computed: {
        numPage() {
            if (this.posts.length > 0) {
                return Math.ceil(this.posts.length / this.pageSize)
            } else {
                return 1
            }
        },
        visibleSection() {
            const start = this.page * this.pageSize
            return this.posts.slice(start, start + this.pageSize)
        }
    },
    mounted() {
        this.loadPosts()
    },
    methods: {
        nextPage() {
            this.page = Math.min(this.page + 1, this.numPage - 1)
        },
        previousPage() {
            this.page = Math.max(this.page - 1, 0)
        },
        updatePageSize(e) {
            const selector = e.target
            this.pageSize = +selector.options[selector.selectedIndex].text
            this.page = 0
        },
        addPost() {
            this.mode = "editor"
            this.action = "insert"
            this.image = null
            this.title = ""
            this.content = ""
        },
        editPost(post) {
            this.mode = "editor"
            this.action = "update"
            this.id = post.id
            this.image = null
            this.title = post.title
            this.content = post.content
            this.loadImageFromHash(post.image)
        },
        loadPosts() {
            getUnwrap("/api/post/list.php")
                .then(data => {
                    this.posts = data
                    if (this.page >= this.numPage) {
                        this.page = this.numPage - 1
                    }
                })
        },
        formatDate(timestamp) {
            return moment.unix(timestamp).format("YYYY-MM-DD HH:mm")
        },
        loadImage(e) {
            const file = e.target.files[0]
            if (file) readAsDataURL(file).then(dataurl => this.image = dataurl)
        },
        loadImageFromHash(hash) {
            if (hash) {
                axios.get(`/api/image.php?hash=${hash}`, {responseType: "blob"})
                    .then(resp => readAsDataURL(resp.data))
                    .then(dataurl => this.image = dataurl)
            }
        },
        deleteImage() {
            this.image = null
        },
        deletePost(post) {
            if (confirm("Are you sure?")) {
                postUnwrap("/api/post/delete.php", {id: post.id})
                    .then(() => this.loadPosts())
            }
        },
        submit() {
            if (this.action === "insert") {
                const params = {image: this.image, title: this.title, content: this.content}
                postUnwrap("/api/post/insert.php", params)
                    .then(() => {
                        this.mode = "list"
                        this.loadPosts()
                    })
            } else if (this.action === "update") {
                const params = {id: this.id, title: this.title, content: this.content, image: this.image}
                postUnwrap("/api/post/update.php", params)
                    .then(() => {
                        this.mode = "list"
                        this.loadPosts()
                    })
            }
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
    font-family: "Roboto";
}

*, a {
    font-family: "Roboto";
}

img {
    max-width: 100%;
    height: auto;
}

.top-bar {
    display: flex;
    padding: 5px;
}

.top-bar > * {
    margin-right: 15px;
}

table {
    margin: 5px;
}

th {
    font-weight: bold;
    text-align: left;
}

th, td {
    min-width: 150px;
    border: 1px solid black;
    padding: 5px;
}

.editor {
    display: flex;
    flex-direction: column;
    margin: 5px;
    font-size: 15px;
}

.editor > div {
    display: flex;
    margin-bottom: 5px;
}

.editor .label {
    width: 100px;
}

.editor .textfield {
    width: 500px;
    font-size: 15px;
}

.content {
    height: 70vh;
}

.pane-title {
    font-weight: bold;
}
</style>
