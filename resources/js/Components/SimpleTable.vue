<script setup>
const props = defineProps({
    fields: {
        type: Array,
        required: true,
    },
    data: {
        type: Array,
        required: true,
    }
});
</script>

<template>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <template v-if="props.data.length">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <template v-for="(field, key) in props.fields" :key="key">
                            <th scope="col" class="px-6 py-3">{{ field.label }}</th>
                        </template>
                    </tr>
                </thead>
                <tbody>
                    <template v-for="(item, keyRow) in props.data" :key="keyRow">
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <template v-for="(field, keyColumn) in fields" :key="keyColumn">
                                <td class="px-6 py-4">
                                    <slot v-bind:item="item" :name="field.key">
                                        {{ item[field.key] }}
                                    </slot>
                                </td>
                            </template>
                        </tr>
                    </template>
                </tbody>
            </table>
        </template>
        <template v-else>
            <slot name="empty">
                no data
            </slot>
        </template>
    </div>
</template>