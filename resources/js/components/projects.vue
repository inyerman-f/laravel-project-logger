<template>
    <div class="container" id="projects_content">
        <section>
            <h1>Project List for {{user.name}}</h1>
            <h4>Add a Project</h4>
            <form @submit.prevent="addNewProject()">
                <div class="input-group">
                    <label for="project_name">Project Name</label>
                    <input v-model="project.project_name" type="text" name="project_name" class="form-control" autofocus id="project_name">
                    <label for="project_description">Project Description</label>
                    <input v-model="project.project_description" type="text" name="project_description" class="form-control" autofocus id="project_description">
                    <button type="submit" class="btn btn-primary">Create New Project</button>
                </div>
            </form>
        </section>
        <section>
            <h4>All Projects</h4>
            <div class="list-group" v-if="projects">
                <div v-if='projects.length === 0'>There are no projects yet!</div>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Project Id</th>
                    <th scope="col">Project Name</th>
                    <th scope="col">Project Description</th>
                    <th scope="col">Edit</th>
                    <th scope="col">See Tasks</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>
                <tbody id="projects_table" v-for="(item, index) in projects">
                <tr>
                    <th scope="row">{{item.id}}</th>
                    <td>{{item.project_name}}</td>
                    <td>{{item.project_description}}</td>
                    <td><button @click="editProject(item.id)" class="btn btn-primary btn-xs pull-right">Edit</button></td>
                    <td><button v-on:click="goToTasks(item.id)" class="btn btn-primary btn-xs pull-right">See Tasks</button></td>
                    <td><button @click="deleteProject(item.id)" class="btn btn-danger btn-xs pull-right">Delete</button></td>
                </tr>
                </tbody>
            </table>
        </section>
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
        },
        addNewProject(){
            console.log(this.user);
            this.axios.post('/api/projects/add', this.project)
                .then(({data}) => {
                })
                .catch((error) => {
                    console.log(error);
                });
            this.fetchProjectsList();
        },
        editProject(project_id){
            this.$router.push('/projects/'+project_id+'/edit');
        },
        deleteProject(id) {
            axios.post('/api/projects/' + id + '/delete')
                .then((res) => {
                })
                .catch((err) =>
                {
                    console.error(err);
                    alert('You must delete the tasks associated to this project, prior to removing the project.');
                });
            this.fetchProjectsList()
        },
    }
}
</script>
