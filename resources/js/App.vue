<script setup>
import { ref, onMounted } from 'vue';
import SubmissionForm from './components/SubmissionForm.vue';
import SubmissionTable from './components/SubmissionTable.vue';
import { getSubmissions } from './api';

const submissions = ref([]);
const loading = ref(true);
const error = ref('');

async function loadSubmissions() {
    try {
        submissions.value = await getSubmissions();
        error.value = '';
    } catch {
        error.value = 'Failed to load submissions.';
    } finally {
        loading.value = false;
    }
}

onMounted(loadSubmissions);
</script>

<template>
    <div class="min-h-screen">
         <header class="bg-excel text-white">
            <div class="mx-auto flex max-w-6xl items-baseline gap-3 px-4 py-3">
                <h1 class="text-lg font-semibold">Innocean Bakery</h1>
                <span class="text-sm text-excel-light">Data Entry</span>
            </div>
        </header>

        <main class="mx-auto grid max-w-6xl gap-6 px-4 py-6 lg:grid-cols-[22rem_1fr] lg:items-start">
            <SubmissionForm @saved="loadSubmissions" />
            <SubmissionTable :submissions="submissions" :loading="loading" :error="error" />
        </main>
    </div>
</template>