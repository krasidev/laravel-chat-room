<template>
    <AuthenticatedLayout>
        <Head>
            <title>{{ lang.menu.users.text }}</title>
        </Head>
        <div class="card shadow-sm">
            <div class="card-header bg-transparent">{{ lang.menu.users.index }}</div>

            <div class="card-body">
                <DataTable class="align-middle">
                    <thead>
                        <tr>
                            <th>{{ lang.content.users.table.headers.id }}</th>
                            <th>{{ lang.content.users.table.headers.name }}</th>
                            <th>{{ lang.content.users.table.headers.email }}</th>
                            <th>{{ lang.content.users.table.headers.created_at }}</th>
                            <th>{{ lang.content.users.table.headers.updated_at }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users">
                            <td>{{ user.id }}</td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.created_at }}</td>
                            <td>{{ user.updated_at }}</td>
                        </tr>
                    </tbody>
                </DataTable>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
    import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import DataTable from '../../Components/DataTable.vue';

    export default {
        components: {
            AuthenticatedLayout,
            Head,
            DataTable
        },
        props: {
            lang: Object,
            users: Object
        }
    }
</script>
