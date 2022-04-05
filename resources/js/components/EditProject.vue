<template>
    <div class="container">
        <h1>Edit Project {{projectName}}, with id: {{$route.params.id }}</h1>
        <form @submit.prevent="updateProject($route.params.id)">
            <div>
                <label for="project_name_edit" >Project Name</label>
                <input name="project_name" :placeholder="projectName" type="text" v-model="projecto.project_name" id="project_name_edit" ref="projectNameInputRef"/>
            </div>
            <div>
                <label for="project_description_edit" >Project Description</label>
                <input type="text" :placeholder="projectDescription" v-model="projecto.project_description" id="project_description_edit" ref="projectDescriptionInputRef"/>
            </div>
            <div>
                <button type="submit" class="btn btn-primary" >Update Project</button>
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
                project_name: "", // or pre-fill with other default value like `lorem`

            },
        }
    },
    created() {
        this.getProjectDetails(this.$route.params.id);
    },
    methods: {
        updateProject(project_id) {
            if(!this.projecto.project_name){
                this.projecto.project_name = this.projectName;
            }
            if(!this.projecto.project_description){
                this.projecto.project_description = this.projectDescription;
            }
            console.log(this.user);
            this.axios.post('/api/projects/'+project_id+'/edit', this.projecto)
                .then(({data}) => {
                })
                .catch((error) => {
                    console.log(error);
                });
            this.$router.push('/projects');
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
