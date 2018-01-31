<template lang="html">
    <div>
        <div class="comment-area">
            <template v-if="children.length > 0">
                <a
                    href="#"
                    v-if="!folded"
                    @click.prevent="folded = true">
                    [-]
                </a>
                <a
                    href="#"
                    v-if="folded"
                    @click.prevent="folded = false">
                    [+]
                </a>
            </template>
            <span class="username">{{ comment.username }}</span>
            commented {{ formatDate(comment.created_at) }}
            <a
                href="#"
                v-if="!visible"
                @click.prevent="visible = true">
                reply
            </a>
            <a
                href="#"
                v-if="visible"
                @click.prevent="visible = false">
                hide
            </a>
            <p
                class="comment-text"
                v-for="p in paragraphs">
                {{ p }}
            </p>
        </div>
        <div
            class="child comment-editor"
            v-if="visible">
            <textarea v-model="content"/>
            <button @click="addComment">Add comment</button>
        </div>
        <template v-if="!folded">
            <post-comment
                class="child"
                v-for="c in children"
                :comment="c"/>
        </template>
    </div>
</template>

<script>
import moment from "moment"
import {getUnwrap, postUnwrap} from "../request"

export default {
    props: ["comment"],
    data() {
        return {children: [], visible: false, content: "", folded: false}
    },
    computed: {
        paragraphs() {
            return this.comment.content.split("\n")
        }
    },
    mounted() {
        this.loadComments()
    },
    beforeCreate () {
        this.$options.components.PostComment = require("./PostComment.vue")
    },
    methods: {
        addComment() {
            postUnwrap("/api/comment/add.php", {parent: this.comment.id, content: this.content})
                .then(() => {
                    this.visible = false
                    this.content = ""
                    this.folded = false
                    this.loadComments()
                })
        },
        loadComments() {
            getUnwrap("/api/comment/get_children.php", {id: this.comment.id})
                .then(data => this.children = data)
        },
        formatDate(timestamp) {
            return moment.unix(timestamp).fromNow()
        }
    },
}
</script>

<style lang="css" scoped>
.comment-editor {
    display: flex;
    flex-direction: column;
}

.comment-editor > button {
    width: 150px;
}

.comment-text {
    font-size: 18px;
}

.comment-area {
    margin-bottom: 10px;
}

.comment-area > p {
    margin-top: 5px;
}

.child {
    margin-left: 40px;
}

.comment-padding {
    margin-bottom: 20px;
}

.username {
    font-weight: bold;
}
</style>
