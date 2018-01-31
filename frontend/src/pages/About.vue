<template lang="html">
    <div class="container">
        <app-header/>
        <div class="main">
            <div class="image"/>
            <main>
                <h2>About Us</h2>
                <p>
                    In 21 Century, the improvement of technology has been
                    growing exponentially, it makes mobile phone became
                    popular. On the other hand, people being addicted to cell
                    phone. Cellfish affects us in daily life. The main
                    side-effect are accident and health problem. Most of the
                    accidents that happen daily arise because of mobile phones.
                    The mobile phones have resulted in dangerous driving, whose
                    direct impact can be seen in increasing no. of accidents.
                    Apart from accidents, mobile phones have bad impact on
                    health as well. Several researches conducted by the
                    health experts have proved the bad impact of mobile
                    phones on health. These are the positive and negative
                    impacts of mobile phones on our lives. These is no doubt
                    mobile is a necessity these days, but we should take care
                    of the negative points too and use this technology
                    accordingly. In order to publicize “No cellfish”, we built
                    this website and let people to know more about issue
                    of cellfish.
                </p>
            </main>
        </div>
        <app-footer/>
    </div>
</template>

<script>
import AppHeader from "../partials/Header.vue"
import AppFooter from "../partials/Footer.vue"

export default {
    components: { AppHeader, AppFooter }
}
</script>

<style lang="css" scoped>
.container {
    width: 900px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    font-family: "Roboto";
}

.main {
    display: flex;
    width: 100%;
    justify-content: center;
    margin-bottom: 45px;
}

.main > * {
    width: 50%;
}

.image {
    background-image: url("/images/aboutus.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
}

main {
    padding: 0 20px;
}

main > h2 {
    font-size: 30px;
    font-weight: bold;
    margin-bottom: 10px;
}

main > p {
    font-size: 20px;
    line-height: 1.1;
}
</style>
