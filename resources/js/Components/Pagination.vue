<script setup>
import BreezeNavLink from '@/Components/NavLink.vue';

const props = defineProps({
    links: {
        type: Array,
        require: true,
    }
});

</script>

<template>
    <div>
        <div class="flex flex-wrap -mb-1">
            <template v-for="(link, key) in props.links" :key="key">
                <div 
                    v-if="link.url === null" 
                    class="py-2 px-3 ml-0 leading-tight text-gray-500 bg-white rounded-ms border border-gray-300 mr-2"
                    v-html="link.label" />
                <BreezeNavLink v-else
                    class="py-2 px-3 ml-0 leading-tight text-gray-500 bg-white rounded-ms border border-gray-300 hover:bg-gray-100 hover:text-gray-700 mr-2"
                    :class="{ 'bg-blue-700 text-white': link.active }" :href="link.url" v-html="link.label" />
            </template>
        </div>
    </div>
</template>