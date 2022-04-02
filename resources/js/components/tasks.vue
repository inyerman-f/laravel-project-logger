<template>
    <div class='row'>
        <h1>Tasks for list id: {{$route.params.id }}</h1>
        <h4>New Task</h4>
        <form @submit.prevent="addNewTask()">
            <div class="input-group">
                <input v-model="task.task_name" type="text" name="task_name" class="form-control" autofocus>
                <input v-model="task.task_description" type="text" name="task_description" class="form-control" autofocus>
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary">New Task</button>
                </span>
            </div>
        </form>
        <h4>All Tasks</h4>
        <div class="list-group" v-if="tasks">
            <div v-if='tasks.length === 0'>There are no tasks yet!</div>

            <div class="list-group-item" v-for="(item, index) in tasks">
                <span width="45vw" >{{ item.task_name }}</span><span width="45vw">{{item.task_description}} {{item.id}}</span>
                <button @click="deleteTask(item.id)" class="btn btn-danger btn-xs pull-right">Delete</button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data () {
        return {
            loading: true,
            user: this.auth.user,
            tasks:[],
            task: {
                task_name:'',
                task_description:'',
            },
            fields: [
                // A virtual column that doesn't exist in items
                'index',
                // A column that needs custom formatting
                { key: 'task_name',
                label: 'Task Name' },
                // A regular column
                { key: 'task_description',
                label: 'Task Description' },
            ],
        }
    },
    created() {
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
        addNewTask(){
            axios.post('/api/projects/'+this.$route.params.id+'/tasks/add',this.task)
                .then((res) => {
                    this.fetchTasks(this.$route.params.id);
                })
                .catch((err) => console.error(err));
        },
        deleteTask(id) {
            axios.post('/api/tasks/' + id + '/delete')
                .then((res) => {
                    this.fetchTasks(+this.$route.params.id)
                })
                .catch((err) => console.error(err));
        },
    }
}
</script>
