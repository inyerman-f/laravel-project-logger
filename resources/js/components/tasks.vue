<template>
    <div class="container">
        <h1>Tasks</h1>
        <div v-if="tasks">
            <h4>If tasks exists for for this project, they will be here. </h4><br>
            <ul>
                <li v-for="task in tasks" :key="task.id">
                    {{ task.task_name }}, {{ task.task_description }}
                </li>
            </ul>

        </div>
        <div v-else>
            No projects yet.

        </div>
        <div>
            {{ tasks }}
            <button @click="addNewProject">Add New Projects</button>
        </div>
    </div>
</template>
<script>


export default {

    data () {
        return {
            loading: true,
            user: this.auth.user,
            projects:[],
            tasks: []
        }
    },
    created() {
        this.fetchTaskList();
        this.fetchTasks(this.$route.params.id )
        // console.log(this.auth.user);
    },
    methods: {
        fetchTasks(list_id){
            axios.post('/api/projects/'+list_id+'/tasks',)
                .then((res) => {
                    this.tasks = res.data;
                    this.loading = false;
                })
                .catch((err) => console.error(err));
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
