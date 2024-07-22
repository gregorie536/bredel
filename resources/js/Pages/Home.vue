<template>
    <div class="container mx-auto mt-10 px-4">
        <section class="mb-8">
            <h1 class="text-3xl font-bold text-center text-gray-800">Barbecue Bredel</h1>
        </section>

        <!-- <div class="flex justify-center gap-4 mb-4">
            <button class="px-4 py-2 text-white bg-blue-500 rounded-lg shadow hover:bg-blue-600 transition-colors"
                @click="naviguerVers('/taches')">Tâches</button>
            <button class="px-4 py-2 text-white bg-blue-500 rounded-lg shadow hover:bg-blue-600 transition-colors"
                @click="naviguerVers('/presences')">Présences</button>
        </div> -->
        <section class="mt-10">
            <h1 class="text-3xl font-bold text-center text-gray-800">Rendez-vous l'année prochaine pour la Saison 5</h1>
        </section>
        <div class="flex justify-center">
            <img src="/img/bredel.webp" alt="Description de l'image" class="max-w-full h-auto img-smaller">
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

<style scoped>
.img-smaller {
    max-width: 75%;
    height: auto;
}
</style>
