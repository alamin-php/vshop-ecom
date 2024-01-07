<script setup>
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import Navbar from './Navbar.vue';
import Sidebar from './Sidebar.vue';

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})
</script>
<template>
    <div class="antialiased">
        <!-- Navbar start  -->
        <Navbar />
        <!-- Navbar end -->

        <!-- Sidebar -->
        <Sidebar />
        <!-- Sidebar end -->
        <main class="p-4 md:ml-64 h-auto pt-20">
            <slot />
        </main>
    </div>
</template>
<style scoped></style>
