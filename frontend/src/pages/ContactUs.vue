<template lang="html">
    <div class="container">
        <app-header/>
        <div class="inner-container">
            <h2>Contact us</h2>
            <div>
                <span class="label">Name</span>
                <input
                    class="input"
                    type="text"
                    v-model="name">
                <br>
            </div>
            <div>
                <span class="label">Email</span>
                <input
                    class="input"
                    type="text"
                    v-model="email">
                <br>
            </div>
            <div>
                <span class="label">Subject</span>
                <input
                    class="input"
                    type="text"
                    v-model="subject">
                <br>
            </div>
            <div>
                <span class="label">Message</span>
                <textarea
                    class="input"
                    name="message"
                    v-model="message"/>
                <br>
            </div>
            <div>
                <span class="label"/>
                <input
                    v-if="state === 'ready'"
                    type="button"
                    value="submit"
                    @click="submit">
                <div v-if="state === 'submitting'">
                    <div>Submitting</div>
                </div>
                <div v-if="state === 'ok'">
                    Submitted
                    <button @click="close">Close</button>
                </div>
                <div v-if="state === 'error'">
                    An error has occured while submitting
                    <button @click="close">Close</button>
                </div>
            </div>
        </div>
        <app-footer/>
    </div>
</template>

<script>
import {postUnwrap} from "../request"

import AppHeader from "../partials/Header.vue"
import AppFooter from "../partials/Footer.vue"

export default {
    components: {AppHeader, AppFooter},
    data() {
        return {name: "", email: "", subject: "", message: "", state: "ready"}
    },
    methods: {
        submit() {
            this.state = "submitting"
            postUnwrap("/api/message/insert.php", {
                name: this.name,
                email: this.email,
                subject: this.subject,
                message: this.message
            })
                .then(() => {
                    this.state = "ok"
                    this.name = ""
                    this.email = ""
                    this.subject = ""
                    this.message = ""
                })
        },
        close() {
            this.state = "ready"
        }
    }
}
</script>

<style lang="css" scoped>
*, a, input {
    font-family: "Roboto";
}

input, textarea {
    font-size: 16px;
}

textarea {
    height: 300px;
}

.input {
    flex-grow: 1;
}

.container {
    width: 900px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
}

.inner-container {
    width: 80%;
    display: flex;
    margin-top: 20px;
    flex-direction: column;
}

.inner-container > div {
    display: flex;
    margin-top: 10px;
}

h2 {
    font-weight: bold;
    font-size: 30px;
    padding-bottom: 10px;
}

.label {
    width: 100px;
}
</style>
