<template>
    <div class="container">
        <h1>Edit Project {{projectName}}, with id: {{$route.params.id }}</h1>
        <form>
            <div>
                <label for="project_name_edit" >Project Name</label>
                <input name="project_name" type="text" v-model="projecto.project_name" id="project_name_edit" ref="projectNameInputRef">
            </div>
            <div>
                <label for="project_description_edit" >Project Description</label>
                <input type="text" v-model="projecto.project_description" id="project_description_edit" ref="projectDescriptionInputRef">
            </div>
            <div>
                <button @click="updateProject($route.params.id)" class="btn btn-primary" >Update Project</button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            projectDescription : [],
            projectName:[],
            projecto: {
                project_name: '',
                project_description: '',
            },
            input: {
                project_name: "derp", // or pre-fill with other default value like `lorem`

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
                    this.projectName = res.data['project_name'];
                    this.projectDescription = res.data['project_description'];
                    this.loading = false;
                })
                .catch((err) => console.error(err));
        }
    }
}
</script>
