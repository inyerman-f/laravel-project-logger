<template>
    <div>
        <h1>Projects</h1>
        <div v-if="projects">
        <h4>If pojects exists they will be here.</h4><br>
        <p> {{projects}}</p>
        </div>
        <div v-else>
            No projects yet.
        </div>
        <div>
            <button @click="addNewProject()">Add New Projects</button>
        </div>

    </div>
</template>
<script>
export default {
    data () {
        return {
            loading: true,
            user: this.auth.user,
            projects: []
        }
    },
    created() {
        // console.log(this.auth.user);
    },
    methods: {
        fetchTaskList() {
            axios.get('/api/projects')
                .then((res) => {
                    this.projects = 'der shite'//res.data;
                    this.loading = false;
                })
                .catch((err) => console.error(err));;
        },
        addNewProject(){
            this.$router.push('/AddProject');
        }
    }
}
</script>
