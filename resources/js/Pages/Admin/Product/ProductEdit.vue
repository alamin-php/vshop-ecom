<script setup>
import AdminLayout from '../Components/AdminLayout.vue'
import { computed, ref } from 'vue';
import { Head, Link, router, useForm, usePage } from '@inertiajs/vue3';
import { Plus } from '@element-plus/icons-vue'
const props = defineProps({
    product: Object,
    categories: Object,
    brands: Object,
});
const page = usePage()

const productImages = ref([])
const dialogVisible = ref(false)
const dialogImageUrl = ref('')

const handleFileChange = (file) => {
    productImages.value.push(file)
}

const handlePictureCardPreview = (file) => {
    dialogImageUrl.value = file.url
    dialogVisible.value = true
}

const handleRemove = (file) => {
    console.log(file)
}

// product from data
const id = props.product?.id;
const title = props.product?.title;
const price = props.product?.price;
const quantity = props.product?.quantity;
const category_id = props.product?.category_id;
const brand_id = props.product?.brand_id;
const description = props.product?.description;
const product_images = props.product?.product_images;
const published = ref('');
const inStock = ref('');

const submit = async () => {
    const formData = new FormData();
    formData.append('title', title.value);
    formData.append('price', price.value);
    formData.append('quantity', quantity.value);
    formData.append('category_id', category_id.value);
    formData.append('brand_id', brand_id.value);
    formData.append('description', description.value);
    for (const image of productImages.value) {
        formData.append('product_images[]', image.raw)
    }

    try {
        await router.post(route('admin.products.store'), formData, {
            onSuccess: page => {
                Swal.fire({
                    icon: "success",
                    title: page.props.flash.message
                })
            }
        })
    } catch (error) {
        console.log(error);
    }
}

const removeImage = (index) =>{
    alert(index)
}

</script>
<template>
    <Head title="Create Product" />
    <AdminLayout>
        <div class="pt-4">
            <div class="container mx-auto p-4">
                <div class="bg-white dark:bg-gray-700 shadow-md rounded-lg p-4 border">
                    <div class="flex items-center justify-between mb-4">
                        <h1 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Update Product</h1>
                        <Link :href="route('admin.products.index')"
                            class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Back</Link>
                    </div>
                    <form @submit.prevent="submit">
                        <div class="mb-4">
                            <input v-model="id" type="hidden" id="title_id" placeholder="Enter product title"
                                class="border border-gray-300 px-2 py-1 rounded w-full">
                            <p class="text-red-600 dark:text-red-300 mb-6"></p>
                        </div>
                        <div class="mb-4">
                            <label for="title_id">Product title</label>
                            <input v-model="title" type="text" id="title_id" placeholder="Enter product title"
                                class="border border-gray-300 px-2 py-1 rounded w-full">
                            <p class="text-red-600 dark:text-red-300 mb-6"></p>
                        </div>
                        <div class="mb-4">
                            <label for="price_id">Price</label>
                            <input v-model="price" type="number" id="price_id" placeholder="Enter product price"
                                class="border border-gray-300 px-2 py-1 rounded w-full">
                            <p class="text-red-600 dark:text-red-300 mb-6"></p>
                        </div>
                        <div class="mb-4">
                            <label for="quantity_id">Quantity</label>
                            <input v-model="quantity" type="number" id="quantity_id" placeholder="Enter product quantity"
                                class="border border-gray-300 px-2 py-1 rounded w-full">
                            <p class="text-red-600 dark:text-red-300 mb-6"></p>
                        </div>
                        <div class="mb-4">
                            <label for="category_id">Select category</label>
                            <select v-model="category_id" name="" id="category_id"
                                class="border border-gray-300 px-2 py-1 rounded w-full">
                                <option value="" disabled>Select one</option>
                                <option :value="category?.id" v-for="category in categories" :key="category.id">
                                    {{ category?.name }}</option>
                            </select>
                            <p class="text-red-600 dark:text-red-300 mb-6"></p>
                        </div>
                        <div class="mb-4">
                            <label for="brand_id">Select brand</label>
                            <select v-model="brand_id" name="" id="brand_id"
                                class="border border-gray-300 px-2 py-1 rounded w-full">
                                <option value="" disabled>Select one</option>
                                <option :value="brand?.id" v-for="brand in brands" :key="brand.id">{{ brand?.name }}
                                </option>
                            </select>
                            <p class="text-red-600 dark:text-red-300 mb-6"></p>
                        </div>
                        <div class="mb-4">
                            <label for="description_id">Description</label>
                            <textarea v-model="description" id="description_id"
                                class="border border-gray-300 px-2 py-1 rounded w-full" cols="10" rows="5"
                                placeholder="Wight product descriptions"></textarea>
                            <p class="text-red-600 dark:text-red-300 mb-6"></p>
                        </div>
                        <div class="mb-4">
                            <label for="">Upload photo</label>
                            <el-upload v-model:file-list="productImages" list-type="picture-card" multiple
                                :on-preview="handlePictureCardPreview" :on-remove="handleRemove"
                                :on-change="handleFileChange">
                                <el-icon>
                                    <Plus />
                                </el-icon>
                            </el-upload>
                        </div>
                        <div class="mb-4 flex flex-nowrap">
                            <div class="relative" v-for="(pimage,index) in product_images" :key="index">
                                <img class="w-32 h-28 rounded" :src="'/storage/'+pimage.image" alt="">
                                <span @click="removeImage(index)"
                                    class="cursor-pointer absolute top-0 left-28 transform -translate-y-1/2 w-3.5 h-3.5 bg-red-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
                            </div>
                        </div>
                        <button type="submit"
                            class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
<style scoped></style>
