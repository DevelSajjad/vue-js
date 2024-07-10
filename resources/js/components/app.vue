<template>
    <!-- <router-link to="/employee">Employee</router-link>
    <router-link to="/about">About</router-link>
    <main>
        <router-view/>
    </main> -->
    <employee/>
</template>

<script>
import employee from './employee.vue';
export default {
    components: {
        employee
    }
};
</script>