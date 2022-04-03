<template>
    <div class="container">
        <h1>Edit Project, with id: {{$route.params.id }}</h1>
        {{projectDetails}}
        <div>
            <label for="project_name">Project Name</label>
            <input name="project_name" type="text" v-model="projecto.project_name"  >
        </div>
        <div>
            <label for="project_description">Project Description</label>
            <input type="text" v-model="projecto.project_description">
        </div>
        <button @click="updateProject($route.params.id )">Update Project</button>
    </div>
</template>
<script>
export default {
    data() {
        return {
            projectDetails : [],
            projecto: {
                project_name: '',
                project_description: '',
            },
            input: {
                name: "", // or pre-fill with other default value like `lorem`

            },
        }
    },
    created() {
        this.getProjectDetails(this.$route.params.id);
    },
    methods: {
        updateProject(project_id) {
            console.log(this.user);
            this.axios.post('/api/projects/'+project_id+'/edit', this.projecto)
                .then(({data}) => {
                    this.$router.push('/projects');
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getProjectDetails(project_id){
            axios.get('/api/projects/'+project_id,)
                .then((res) => {
                    this.projectDetails = res.data['data'];
                    this.loading = false;
                })
                .catch((err) => console.error(err));
        }
    }
}
</script>
