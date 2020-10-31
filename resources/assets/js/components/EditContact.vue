<template>
    <div class="panel panel-default">
        <div class="panel-heading">Edit Contact</div>
        <div class="panel-body">
            <div class="form-group">
                <input type="text" class="form-control" v-model="title" @keydown="editingContact">
            </div>

            <div class="form-group">
                <input class="form-control" v-model="body" @keydown="editingContact">
            </div>

            <button class="btn btn-primary pull-right" @click="updateContact">Update</button>

            <p>
                Users editing this contact:  <span class="badge">{{ usersEditing.length }}</span>
                <span class="label label-success" v-text="status"></span>
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'contact',
        ],

        data() {
            return {
                name: this.contact.name,
                number: this.contact.number,
                usersEditing: [],
                status: ''
            }
        },

        mounted() {
            Echo.join(`contact.${this.contact.slug}`)
                .here(users => {
                    this.usersEditing = users;
                })
                .joining(user => {
                    this.usersEditing.push(user);
                })
                .leaving(user => {
                    this.usersEditing = this.usersEditing.filter(u => u != user);
                })
                .listenForWhisper('editing', (e) => {
                    this.name = e.name;
                    this.number = e.number;
                })
                .listenForWhisper('saved', (e) => {
                    this.status = e.status;

                    // clear is status after 1s
                    setTimeout(() => {
                        this.status = '';
                    }, 1000);
                });
        },

        methods: {
            editingContact() {
                let channel = Echo.join(`contact.${this.contact.slug}`);

                // show changes after 1s
                setTimeout(() => {
                    channel.whisper('editing', {
                        name: this.name,
                        number: this.number
                    });
                }, 1000);
            },

            updateContact() {
                let contact = {
                    name: this.name, 
                    number:  this.number
                };

                // persist to database
                axios.patch(`/edit/${this.contact.slug}`, contact)
                    .then(response => {
                        // show saved status
                        this.status = response.data;
                         
                        // clear is status after 1s
                        setTimeout(() => {
                            this.status = '';
                        }, 1000);

                        // show saved status to others
                        Echo.join(`contact.${this.contact.slug}`)
                            .whisper('saved', {
                                status: response.data
                            });
                    });
            }
        }
    }
</script>
