<template>
    <div class="container" id="register_content">
        <form @submit.prevent="register()">
            <div v-if="errors.length" >
                <b>Please correct the following error(s):</b>
                <ul>
                    <li v-for="error in errors">{{ error }}</li>
                </ul>
            </div>
            <h1>Register</h1>
            <div>
                <label for="name">Name</label>
                <input id="name" type="text" v-model="user.name"/>
            </div>
            <div>
                <label for="email">Email</label>
                <input  id="email" type="email" v-model="user.email"/>
            </div>
            <div>
                <label for="password">Password</label>
                <input id="password" type="password" v-model="user.password"/>
            </div>
            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" v-on:keyup.enter="register()" type="password" v-model="user.password_confirmation"/>
            </div>
            <button class="btn btn-primary" >Register</button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            },
            errors : [],
        };
    },

    methods: {
        register() {

                console.log(this.user);
                this.axios.post('/api/register', this.user)
                    .then(({data}) => {
                        console.log(data)
                        this.$router.push('/login');
                    })
                    .catch((error) => {
                        console.log(error);
                           if(this.user.password!==this.user.password_confirmation) {
                                this.errors.push("Passwords don't match");
                            }
                            if (!this.user.name) {
                                this.errors.push('Please enter a name');
                            }

                    });

        },
    }
}
</script>
