<template>
        <div class="container">
            <h1>Projects</h1>
            <div v-if="projects">
            <h4>If projects exists for you, {{user.name}},  they will be here. </h4><br>
                <ul>
                    <li v-for="project in projects" :key="project.id">


                        <div>
                            <span>

                        {{ project.project_name }}, {{ project.project_description }}
                            </span>
                            <span>
                                <button v-on:click="fetchTasks(project.id)">derp</button>
                            </span>
                        </div>

                    </li>
                </ul>
              </div>
            <div v-else>
                No projects yet.
            </div>
            <div>
                <button @click="addNewProject">Add New Projects</button>
            </div>
         </div>
</template>
<script>
import Auth from "../Auth";

export default {

    data () {
        return {
            loading: true,
            user: this.auth.user,
            projects: []
        }
    },
    created() {
        this.fetchTaskList();
        // console.log(this.auth.user);
    },
    methods: {
        fetchTasks(list_id){
            this.$router.push('/projects/'+list_id+'/tasks');

        },
        fetchTaskList() {
            //this.auth.token;
            axios.get('/api/projects',)
                .then((res) => {
                    this.projects = res.data['data'];
                    this.loading = false;
                })
                .catch((err) => console.error(err));
            //this.list = '{derp}';
        },
        addNewProject(){
            this.$router.push('/AddProject');

        }
    }
}
</script>
