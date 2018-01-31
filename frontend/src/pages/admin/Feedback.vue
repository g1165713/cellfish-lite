<template lang="html">
    <div class="container">
        <app-header />
        <main v-if="mode === 'list'">
            <div class="top-bar">
                <h3 class="pane-title">Feedback</h3>
                <p>Number of feedback(s): {{ messages.length }}</p>
            </div>
            <table>
                <tr>
                    <th>Created at</th>
                    <th>Author</th>
                    <th>Title</th>
                    <th/>
                </tr>
                <tr v-for="msg in messages">
                    <td>{{ formatDate(msg.created_at) }}</td>
                    <td>{{ msg.name }} &lt;{{ msg.email }}&gt;</td>
                    <td>{{ msg.subject }}</td>
                    <td>
                        <button @click="showDetails(msg)">Details</button>
                        <button @click="deleteMessage(msg)">Delete</button>
                    </td>
                </tr>
            </table>
        </main>
        <main
            v-if="mode === 'details'"
            class="message-view">
            <button @click="back">Back</button>
            <button @click="deleteMessage(message)">Delete</button>
            <div class="heading">
                <span class="title">{{ message.subject }}</span><br>
                by {{ message.name }} &lt;{{ message.email }}&gt;
                at {{ formatDate(message.created_at) }}
            </div>
            <pre>{{ message.message }}</pre>
        </main>
    </div>
</template>

<script>
import * as moment from "moment"
import {getUnwrap, postUnwrap} from "../../request"

import AppHeader from "../../partials/Header.vue"


export default {
    components: {AppHeader},
    data() {
        return {mode: "list", messages: [], message: {}}
    },
    mounted() {
        this.loadMessages()
    },
    methods: {
        loadMessages() {
            getUnwrap("/api/message/list.php")
                .then(data => this.messages = data)
        },
        formatDate(timestamp) {
            return moment.unix(timestamp).format("YYYY-MM-DD HH:mm")
        },
        deleteMessage({id}) {
            if (confirm("Are you sure?")) {
                postUnwrap("/api/message/delete.php", {id})
                    .then(() => {
                        this.mode = "list"
                        this.loadMessages()
                    })
            }
        },
        showDetails(message) {
            this.mode = "details"
            this.message = message
        },
        back() {
            this.mode = "list"
        }
    },
}
</script>

<style lang="css" scoped>
*, a {
    font-family: "Roboto";
    font-size: 16px;
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

.pane-title {
    font-weight: bold;
}

.message-view {
    padding: 5px;
    font-size: 18px;
}

.heading {
    padding-bottom: 20px;
    margin-bottom: 5px;
    border-bottom: 1px solid black;
}

.title {
    font-weight: bold;
    font-size: 22px;
}

.container {
    width: 900px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    font-family: "Roboto";
}
</style>
