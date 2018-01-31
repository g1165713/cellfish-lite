<template lang="html">
    <div class="container">
        <app-header/>
        <h2>Login</h2>
        <main>
            <div>
                <span class="label">Username</span>
                <input
                    type="text"
                    placeholder="username"
                    v-model="username">
                <br>
            </div>
            <div>
                <span class="label">Password</span>
                <input
                    type="password"
                    placeholder="password"
                    v-model="password">
                <br>
            </div>
            <div>
                <span class="label"/>
                <button @click="submit">Go</button>
            </div>
        </main>
        <app-footer/>
    </div>
</template>

<script>
import {post} from "../request"

import AppHeader from "../partials/Header.vue"
import AppFooter from "../partials/Footer.vue"

export default {
    components: { AppHeader, AppFooter },
    data() {
        return {username: "", password: ""}
    },
    methods: {
        submit() {
            post("/api/auth/login.php", {username: this.username, password: this.password})
                .then(resp => {
                    if (resp.isOk) {
                        this.$router.push({name: "Index"})
                    } else {
                        alert("Incorrect username or password")
                    }
                })
        },
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
