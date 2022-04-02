<template>
        <div class="container">
            <h1>Add a new project.</h1>
            <div>
                <label for="project_name">Project Name</label>
                <input type="text" v-model="projecto.project_name">
            </div>
            <div>
                <label for="project_description">Project Description</label>
                <input type="text" v-model="projecto.project_description">
            </div>
            <button @click="addProject()">Add Project</button>
        </div>
</template>
<script>
export default {
    data() {
        return {
            projecto: {
                project_name: '',
                project_description: '',
            }
        };
    },
    methods: {
        addProject() {
            console.log(this.user);
            this.axios.post('/api/projects/add', this.projecto)
                .then(({data}) => {
                    this.$router.push('/projects');
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    }
}
</script>
