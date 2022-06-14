<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import BreezeNavLink from '@/Components/NavLink.vue';

import Pagination from '@/Components/Pagination.vue';
import SimpleTable from '@/Components/SimpleTable.vue';

import { excerpt, formatDatetime } from '@/Services/helpers.service';

const props = defineProps({
    posts: {
        type: Object,
        required: true,
    }
});

const fields = [
    {
        key: 'title',
        label: 'Title',
    },
    {
        key: 'description',
        label: 'Description',
    },
    {
        key: 'publication_date',
        label: 'Publication Date',
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Posts
                </h2>
                <BreezeNavLink :href="route('posts.create')">
                    Create Post
                </BreezeNavLink>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3">
                <SimpleTable :fields="fields" :data="props.posts.data">
                    <template #title="data">
                        {{ excerpt(data.item.title, 30) }}
                    </template>
                    <template #description="data">
                        {{ excerpt(data.item.description, 40) }}
                    </template>
                    <template #publication_date="data">
                        {{ formatDatetime(data.item.publication_date) }}
                    </template>
                </SimpleTable>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Pagination :links="props.posts.links"/>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
