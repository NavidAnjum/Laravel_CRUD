<template>
    <form @submit.prevent="submitForm">
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input class="form-control" id="first_name" v-model="form.first_name" type="text">
            <span v-if="errors.first_name" class="error">{{ errors.first_name[0] }}</span>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input  class="form-control" id="last_name" v-model="form.last_name" type="text">
            <span v-if="errors.last_name" class="error">{{ errors.last_name[0] }}</span>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input  class="form-control" id="email" v-model="form.email" type="email">
            <span v-if="errors.email" class="error">{{ errors.email[0] }}</span>
        </div>
        <div class="mb-3">
            <label for="mobile" class="form-label"> Mobile</label>
            <input  class="form-control" id="mobile" v-model="form.mobile" type="text">
            <span v-if="errors.mobile" class="error">{{ errors.mobile[0] }}</span>
        </div>
        <div class="mb-3">
            <label for="date_of_birth" class="form-label">Date of Birth</label>
            <input  class="form-control" id="date_of_birth" v-model="form.date_of_birth" type="date">
            <span v-if="errors.date_of_birth" class="error">{{ errors.date_of_birth[0] }}</span>
        </div>
        <div class="mb-3">
            <label for="user_image" class="form-label">User Image</label>
            <input  class="form-control" id="user_image" ref="file" type="file">
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                form: {
                    first_name: '',
                    last_name: '',
                    email: '',
                    mobile: '',
                    date_of_birth: '',
                    user_image: null,
                },
                errors: {},
            };
        },
        methods: {
            async submitForm() {
                const formData = new FormData();
                formData.append('first_name', this.form.first_name);
                formData.append('last_name', this.form.last_name);
                formData.append('email', this.form.email);
                formData.append('mobile', this.form.mobile);
                formData.append('date_of_birth', this.form.date_of_birth);
                formData.append('user_image', this.$refs.file.files[0]);
                try {
                    const response = await axios.post('/contacts', formData);
                    // Display response data
                    console.log(response.data);
                    alert(response.data.message)


                } catch (error) {
                    this.errors = error.response.data.errors;
                }
            },
        },
    };
</script>

<style scoped>
    .error {
        color: red;
    }
</style>
