<template>
    <div class="container mx-auto mt-10 px-4">
        <!-- Section Titre -->
        <section class="mb-8">
            <h1 class="text-3xl font-bold text-center text-gray-800">Barbecue Bredel Saison 4</h1>
        </section>

        <!-- Onglets -->
        <div class="flex justify-center gap-4 mb-4">
            <button class="px-4 py-2 text-white bg-blue-500 rounded-lg shadow hover:bg-blue-600 transition-colors" @click="naviguerVers('/taches')">Tâches</button>
            <button class="px-4 py-2 text-white bg-blue-500 rounded-lg shadow hover:bg-blue-600 transition-colors" @click="naviguerVers('/presences')">Présences</button>
        </div>

        <!-- Image -->
        <div class="flex justify-center">
            <img src="/img/bredel.webp" alt="Description de l'image" class="max-w-full h-auto">
        </div>
    </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia'

export default {
    methods: {
        naviguerVers(url) {
            Inertia.visit(url);
        }
    },
};
</script>