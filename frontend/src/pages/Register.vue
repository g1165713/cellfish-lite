<template lang="html">
    <div class="container">
        <app-header/>
        <h2>Register a new account</h2>
        <main>
            <div>
                <span class="label">Username</span>
                <input
                    type="text"
                    v-model="username">
            </div>
            <div>
                <span class="label">Password</span>
                <input
                    type="password"
                    v-model="password">
            </div>
            <div>
                <span class="label"/>
                <button @click="submit">Submit</button>
            </div>
            <div v-if="error">
                <span class="label"/>
                <span>{{ error }}</span>
            </div>
        </main>
        <app-footer/>
    </div>
</template>

<script>
import {post, postUnwrap} from "../request"

import AppHeader from "../partials/Header.vue"
import AppFooter from "../partials/Footer.vue"

export default {
    components: { AppHeader, AppFooter },
    data() {
        return {username: "", password: "", error: ""}
    },
    methods: {
        submit() {
            if (this.username === "") {
                this.error = "Username cannot be empty"
            } else if (this.password === "") {
                this.error = "Password cannot be empty"
            } else {
                const params = {username: this.username, password: this.password}
                post("/api/auth/register.php", params)
                    .then(resp => {
                        if (resp.isOk) {
                            postUnwrap.post("/api/auth/login.php", params)
                                .then(() => this.$router.push({name: "Index"}))
                        } else if (resp.isError && resp.data === "user_exist") {
                            this.error = "The username already exists."
                        } else {
                            this.error = "Internal error"
                            throw new Error(JSON.stringify(resp))
                        }
                    })
            }
        }
    }
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

main > div {
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
