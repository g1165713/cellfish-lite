<template lang="html">
    <footer>
        <p>Copyright 2017 Tintin Ho</p>
        <p>OUHK Software Engineering Project</p>
        <ul>
            <router-link :to="{ name: 'Login' }">Admin login</router-link>
            <li><a href="#">Facebook</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Instagram</a></li>
        </ul>
    </footer>
</template>

<style lang="css" scoped>
footer {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    font-family: "Roboto";
    margin: 10px 0;
}

ul {
    display: flex;
}

ul > * {
    margin: 0 20px;
}
</style>
