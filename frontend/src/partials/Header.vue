<template lang="html">
    <header>
        <h1>
            <router-link :to="{ name: 'Index' }">Cellfish Lite Edition</router-link>
        </h1>
        <nav>
            <ol>
                <li>
                    <router-link :to="{ name: 'Index' }">Home</router-link>
                </li>
                <template v-if="loginAs === 'admin'">
                    <li>
                        <router-link :to="{ name: 'AdminPost' }">Posts</router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'AdminFeedback' }">Feedbacks</router-link>
                    </li>
                </template>
                <template v-if="loginAs !== 'admin'">
                    <li>
                        <router-link :to="{ name: 'About' }">About</router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'News' }">News</router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'ContactUs' }">Contact us</router-link>
                    </li>
                </template>
                <template v-if="loginAs === 'guest'">
                    <li>
                        <router-link :to="{ name: 'Register' }">Register</router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'Login' }">Login</router-link>
                    </li>
                </template>
                <template v-if="loginAs !== 'guest'">
                    <li>
                        <a
                            href="#"
                            @click="logout">
                            Logout
                        </a>
                    </li>
                    <span>Welcome, {{ loginAs }}</span>
                </template>
            </ol>
        </nav>
    </header>
</template>

<script>
import {getUnwrap, postUnwrap} from "../request"

export default {
    data() {
        return {loginAs: sessionStorage.getItem("loginAs") || "guest"}
    },
    mounted() {
        getUnwrap("/api/auth/login_as.php")
            .then(user => {
                sessionStorage.setItem("loginAs", user)
                this.loginAs = user
            })
    },
    methods: {
        logout() {
            postUnwrap("/api/auth/logout.php")
                .then(() => getUnwrap("/api/auth/login_as.php"))
                .then(user => {
                    sessionStorage.removeItem("loginAs")
                    this.loginAs = user
                    this.$router.push({name: "Index"})
                })
        }
    },
}
</script>

<style lang="css" scoped>
*, a {
    font-family: "Roboto";
}

a {
    color: black;
    text-decoration: none;
}

a:hover {
    color: #555;
    text-decoration: underline;
}

h1 {
    font-size: 25px;
    font-weight: bold;
}

nav {
    font-size: 20px;
}

ol > li, span {
    margin-left: 20px;
}

header {
    justify-content: space-between;
    align-items: center;
    margin-top: 10px;
    margin-bottom: 20px;
    width: 100%;
}

header, ol {
    display: flex;
}
</style>
