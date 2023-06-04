<template>
    <AuthenticatedLayout>
        <Head>
            <title>{{ lang.menu['chat-room-notifications'].text }}</title>
        </Head>
        <div class="card shadow-sm mb-3">
            <div class="card-header bg-transparent">{{ lang.menu['chat-room-notifications'].index }}</div>

            <div class="card-body">
                <div v-for="(chatRoomNotification, index) in chatRoomNotifications" :class="{
                    'd-flex flex-column align-items-end': auth.user.id == chatRoomNotification.data.author.id,
                    'mt-3': index != 0
                }">
                    <label :for="'chat-room-notification-' + index" class="form-label d-block" :class="{
                        'text-secondary': auth.user.id != chatRoomNotification.data.author.id,
                        'text-primary': auth.user.id == chatRoomNotification.data.author.id
                    }">
                        {{ lang.content['chat-room-notifications'].labels.hour }}
                        ({{ chatRoomNotification.hour }})
                        {{ chatRoomNotification.data.author.name }}
                    </label>
                    <textarea :id="'chat-room-notification-' + index" class="form-control w-75" readonly>{{ chatRoomNotification.data.message }}</textarea>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-transparent d-flex align-items-center">
                {{ lang.menu['chat-room-notifications'].create }}
                <div class="btn-group btn-group-sm flex-shrink-0 ms-auto" role="group">
                    <button type="button" class="btn btn-primary py-0" data-bs-toggle="collapse" data-bs-target="#collapseNotifiableID" aria-expanded="false" aria-controls="collapseNotifiableID">
                        {{ lang.content['chat-room-notifications'].buttons['hidden-message'] }}
                    </button>
                </div>
            </div>

            <div class="card-body">
                <form @submit.prevent="submit">
                    <input type="hidden" name="_token" :value="$page.props.csrf_token">

                    <div id="collapseNotifiableID" class="collapse">
                        <div class="mb-3">
                            <label for="notifiable_id" class="form-label">{{ lang.content['chat-room-notifications'].labels.notifiable_id }}:</label>

                            <select v-model="notification.notifiable_id" id="notifiable_id" class="form-control">
                                <option value=""></option>
                                <option v-for="user in users" :value="user.id">{{ user.name }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">{{ lang.content['chat-room-notifications'].labels.message }}: <span class="text-danger">*</span></label>

                        <textarea v-model="notification.message" id="message" class="form-control" :class="{ 'is-invalid': errors.message }"></textarea>

                        <div class="invalid-feedback" v-if="errors.message">
                            <strong>{{ errors.message }}</strong>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-outline-primary">{{ lang.content['chat-room-notifications'].buttons.send }}</button>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
    import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
    import { Head, router } from '@inertiajs/vue3';

    export default {
        components: {
            AuthenticatedLayout,
            Head
        },
        props: {
            auth: Object,
            lang: Object,
            chatRoomNotifications: Object,
            users: Object,
            errors: Object
        },
        data() {
            return {
                notification: {}
            }
        },
        mounted() {
            Echo.private('App.Models.User.' + this.auth.user.id).notification((notification) => {
                router.visit(route('chat-room-notifications.index'), {
                    preserveScroll: true
                });
            });
        },
        methods: {
            submit() {
                router.post(route('chat-room-notifications.store'), this.notification, {
                    preserveScroll: true,
                    onSuccess: (res) => {
                        this.notification.message = null;
                    },
                });
            }
        }
    }
</script>
