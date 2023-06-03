<template>
    <AuthenticatedLayout>
        <Head>
            <title>{{ lang.menu.home }}</title>
        </Head>
        <div class="card shadow-sm">
            <div class="card-header bg-transparent">{{ lang.menu.home }}</div>

            <div class="card-body">
                {{ lang.content.home.content }}
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
    import AuthenticatedLayout from '../Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/vue3';

    export default {
        components: {
            AuthenticatedLayout,
            Head
        },
        props: {
            lang: Object
        }
    }
</script>
