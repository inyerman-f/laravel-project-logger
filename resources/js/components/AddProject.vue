<template>
    <div>
        <h1>Add A New Project.</h1>
        <div>
            <label for="project_name">Project Name</label>
            <input type="text" v-model="projects.project_name">
        </div>
        <div>
            <label for="project_description">Project Description</label>
            <input type="text" v-model="projects.project_description">
        </div>

        <button @click="createProject()">Add Record</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            projects: {
                project_name: '',
                project_description: '',

            }
        };
    },

    methods: {
        createProject() {
            axios.post('/api/add_project', this.task)
                .then((res) => {
                    this.task.body = '';
                })
                .catch((err) => console.error(err));
        }
    }
}
</script>
