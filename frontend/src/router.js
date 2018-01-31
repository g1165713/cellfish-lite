
import Vue from "vue"
import Router from "vue-router"

import Index from "./pages/Index.vue"
import About from "./pages/About.vue"
import News from "./pages/News.vue"
import ContactUs from "./pages/ContactUs.vue"
import Login from "./pages/Login.vue"
import Post from "./pages/Post.vue"
import Register from "./pages/Register.vue"

import AdminDashboard from "./pages/admin/Dashboard.vue"
import AdminFeedback from "./pages/admin/Feedback.vue"
import AdminPost from "./pages/admin/Post.vue"

Vue.use(Router)

export default new Router({
    mode: "history",
    routes: [
        { path: "/", name: "Index", component: Index },
        { path: "/about", name: "About", component: About },
        { path: "/contact_us", name: "ContactUs", component: ContactUs },
        { path: "/news", name: "News", component: News },
        { path: "/login", name: "Login", component: Login },
        { path: "/admin/dashboard", name: "AdminDashboard", component: AdminDashboard },
        { path: "/admin/feedback", name: "AdminFeedback", component: AdminFeedback },
        { path: "/admin/post", name: "AdminPost", component: AdminPost },
        { path: "/post/:id", name: "Post", component: Post },
        { path: "/register", name: "Register", component: Register },
    ]
})
