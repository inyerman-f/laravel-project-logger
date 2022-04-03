<template>
        <div class="container" id="dashboard">
            <h1>Dashboard Dashboard</h1>
            <h4>The logged in user details Here</h4><br>
            <p> {{user.name}}</p>
            <p> {{user.id}}</p>
            <h4>
                Thank you for taking the time to review this project. For too long I've been waiting for an
                opportunity like this. I Know I'm not the highest expert, nor do I pretend to be. I'm just a
                simple human trying to make a living out of words. If for some reason I'm not the best fit.
                I do hope the best for you all. May you always stay blessed, may you always stay centered
                and may you always find something much sweeter than truth.
            </h4>
            <h2>
                Manage your projects.
            </h2>
            <div>
                <p>
                   To manage your projects please click here.
                    <router-link  class="nav-item nav-link ml-3" to="/projects">Projects</router-link>
                </p>
            </div>
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
