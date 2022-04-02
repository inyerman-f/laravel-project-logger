<template>

        <div class="container">

            <h1>Dashboard Dashboard</h1>
            <h4>The logged in user details Here</h4><br>
            <p> {{user.name}}</p>
            <p> {{user.id}}</p>
        </div>

</template>
<script>


export default {

    data () {
        return {
            user: this.auth.user
        }
    },
    created() {
        // console.log(this.auth.user);
    }
}
</script>
