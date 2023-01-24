<template>
    <v-app>
        <create-user-form class="ma-5"></create-user-form>
    </v-app>
</template>

<script>
import CreateUserForm from "@/components/forms/CreateUserForm";
export default {
    name: "App",
    components: {
        CreateUserForm
    },
}
</script>

<style scoped>

</style>
