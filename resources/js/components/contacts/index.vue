<template>
    <div>
        <h1>Contacts</h1>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Date of Birth</th>
                <th>Age</th>
                <th>User Image</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="contact in contact_all" :key="contact.id">
                <td>{{ contact.id }}</td>
                <td>{{ contact.first_name }}</td>
                <td>{{ contact.last_name }}</td>
                <td>{{ contact.email }}</td>
                <td>{{ contact.mobile }}</td>
                <td>{{ contact.date_of_birth }}</td>
                <td>{{ contact.age }}</td>

                <td>
                    <img :src="getImageUrl(contact.user_image)" alt="Contact Image"  width="50">

                </td>
                <td>
                    <button @click="editContact(contact.id)">Edit</button>
                    <button @click="deleteContact(contact.id)">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: {
            contacts: {
                type: String,
                required: true,
            },
        },
        data() {
            return {
                contact_all: []
            };
        },
        mounted() {
            this.contact_all = JSON.parse(this.contacts);
            console.log(this.contact_all);
        },
        watch: {
            contacts: {
                handler(newVal, oldVal) {
                    this.contact_all = newVal;
                },
                immediate: true,
            },
        },
        methods: {
            getImageUrl(filename) {
                return  "/storage/images/" + filename;

            },
            editContact(id) {
                window.location.href = '/contacts/' + id + '/edit';
            },
            deleteContact(id) {
                if (confirm('Are you sure you want to delete this contact?')) {
                    axios.delete('/contacts/' + id)
                        .then(response => {
                            console.log(response.data.message)
                            alert(response.data.message)
                            location.reload();

                        });
                }
            },

        },
    };

</script>


