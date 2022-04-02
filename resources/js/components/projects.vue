<template>
    <div class="container">
        <div class='row'>
            <h1>Project List for {{user.name}}</h1>
            <h4>Add a Project</h4>
            <form @submit.prevent="addNewProject()">
                <div class="input-group">
                    <input v-model="project.project_name" type="text" name="project_name" class="form-control" autofocus>
                    <input v-model="project.project_description" type="text" name="project_description" class="form-control" autofocus>
                    <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary">New Project</button>
                </span>
                </div>
            </form>
            <h4>All Projects</h4>
            <div class="list-group" v-if="projects">
                <div v-if='projects.length === 0'>There are no projects yet!</div>

                <div class="list-group-item" v-for="(item, index) in projects">
                    <span width="45vw" >{{ item.project_name }}</span><span width="45vw">{{item.project_description}} {{item.id}}</span>
                    <button @click="deleteProject(item.id)" class="btn btn-danger btn-xs pull-right">Delete</button>
                    <button @click="editProject(item.id)" class="btn btn-danger btn-xs pull-right">Edit</button>
                    <button v-on:click="goToTasks(item.id)" class="btn btn-danger btn-xs pull-right">See Tasks</button>
                </div>
            </div>
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
            projects: [],
            project: {
                project_name:'',
                project_description:'',
            },
        }
    },
    created() {
        this.fetchProjectsList();
        // console.log(this.auth.user);
    },
    methods: {
        goToTasks(project_id){
            this.$router.push('/projects/'+project_id+'/tasks');
        },
        fetchProjectsList() {
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
            this.$router.push('/projects/add');
        },
        editProject(project_id){
            this.$router.push('/projects/'+project_id+'/edit');
        },
        deleteProject(id) {

            axios.post('/api/projects/' + id + '/delete')
                .then((res) => {

                })
                .catch((err) => console.error(err));
            this.fetchProjectsList()
        },


    }
}
</script>
