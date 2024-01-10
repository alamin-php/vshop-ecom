<script setup>
import Header from '@/Pages/User/Layout/Header.vue'
import Hero from '@/Pages/User/Layout/Hero.vue'
import Footer from '@/Pages/User/Layout/Footer.vue'
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})

const products = [
    {
        id: 1,
        name: 'Basic Tee',
        href: '#',
        imageSrc: 'https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-01.jpg',
        imageAlt: "Front of men's Basic Tee in black.",
        price: '$35',
        color: 'Black',
    },
    // More products...
]
</script>
<template>
    <Header/>
    <Hero/>
    <slot/>
    <Footer/>
</template>
<style scoped></style>
