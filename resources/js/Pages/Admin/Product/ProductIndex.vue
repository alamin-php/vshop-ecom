<script setup>
import AdminLayout from '../Components/AdminLayout.vue'
import { computed, ref } from 'vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
const form = useForm({})
defineProps({
    products: Object,
    require: true
});
const searchField = ["title"];
const searchValue = ref();

const Header = [
    { text: "PRODUCT NAME", value: "title" },
    { text: "CATEGORY", value: "category_id" },
    { text: "BRAND", value: "brand_id" },
    { text: "PRICE", value: "price" },
    { text: "STOCK", value: "inStock" },
    { text: "PUBLISH", value: "published" },
    { text: "OPERATION", value: "operation" },
];
</script>
<template>
    <Head title="All Posts" />
    <AdminLayout>
        <div class="pt-4">
            <div class="container mx-auto px-4">
                <div class="bg-white dark:bg-gray-700 shadow-md rounded-lg p-6 border">
                    <div class="px-4 2xl:container">
                        <h1 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">All Products</h1>
                        <div class="my-2 flex items-center justify-between">
                            <input placeholder="Search..."
                                class="border border-gray-300 focus:border-gray-300 focus:ring-0 rounded-md" type="text"
                                v-model="searchValue">
                            <Link :href="route('admin.products.create')"
                                class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            Create Product</Link>
                        </div>
                        <DataTable buttons-pagination alternating :headers="Header" :items="products" :rows-per-page="10"
                            :search-field="searchField" :search-value="searchValue" border-cell show-index>
                            <template #item-operation="{ id }">
                                <div class="flex space-x-2">
                                    <Link class="text-cyan-400 text-sm hover:text-cyan-600 transition duration-300"
                                        :href="route('admin.products.edit', id)">Edit</Link>
                                    <button class="text-red-400 text-sm hover:text-red-600 transition duration-300"
                                        @click="deleteData(id)">Delete</button>
                                </div>
                            </template>
                        </DataTable>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
<style scoped></style>
