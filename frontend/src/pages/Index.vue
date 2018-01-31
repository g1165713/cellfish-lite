<template lang="html">
    <div class="container">
        <app-header/>
        <div class="cover">
            <h2>Cellfish</h2>
            <p>
                (n) an individual who continues talking on their phone so as
                to be rude or inconsiderate of other people
            </p>
        </div>

        <ol>
            <li>
                <blockquote>
                    <p>“Don't play more phone.”</p>
                    <p>- Edmond</p>
                </blockquote>
            </li>
            <li>
                <blockquote>
                    <p>“Cellfish sounds like selfish.”</p>
                    <p>- Tony</p>
                </blockquote>
            </li>
            <li>
                <blockquote>
                    <p>“Find something you’re passionate about and keep tremendously interested in it.”</p>
                    <p>- Julia Child</p>
                </blockquote>
            </li>
            <li>
                <blockquote>
                    <p>“Don't play phone or you will pay a new phone.”</p>
                    <p>- Tony</p>
                </blockquote>
            </li>
        </ol>
        <app-footer/>
    </div>
</template>

<script>
import AppHeader from "../partials/Header.vue"
import AppFooter from "../partials/Footer.vue"

export default {
    components: { AppHeader, AppFooter },
}
</script>

<style lang="css" scoped>
.container {
    width: 900px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.cover {
    width: 90%;
    height: 300px;
    position: relative;
    background-image: url("/images/coverpage.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: white;
    font-family: "Roboto";
}

.cover::after {
    content: "";
    position: absolute;
    top: 0; bottom: 0; left: 0; right: 0;
    background: rgba(0, 0, 0, 0.4);
    pointer-events: none;
    width: 100%;
    height: 100%;
}

.cover h2 {
    font-size: 60px;
    z-index: 10;
}

.cover p {
    font-size: 27px;
    width: 80%;
    z-index: 10;
}

ol {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin-top: 30px;
    margin-bottom: 30px;
}

li {
    width: 40%;
    padding: 15px;
    font-family: "Roboto";
    font-size: 20px;
}
</style>
