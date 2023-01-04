<template>
    <div>
        <h1>Dashboard Dashboard</h1>
        <h4>The logged in user details Here</h4><br>
        
        <p> {{user.name}}</p>
        <p> {{user.email}}</p>
        <ul>
        <li v-for="team in teams" :key="team.id">
            {{ team.name }}
        </li>
    </ul>
   </div>
</template>
<script>
export default {
    name: "Dashboard",
    data() {
        return {
            name: null,
        }
    },
    created() {
        if (window.Laravel.user) {
            this.name = window.Laravel.user.name
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
}
</script>