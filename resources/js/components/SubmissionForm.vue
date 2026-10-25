<script setup>
import { ref, reactive, computed, watch, onMounted } from 'vue';
import { getStores, getProducts, createSubmission } from '../api';

const emit = defineEmits(['saved']);

const form = reactive({ name: '', store_id: '', product_id: '' });
const stores = ref([]);
const products = ref([]);
const loadingProducts = ref(false);
const submitting = ref(false);
const errors = ref({});
const message = ref('');
const loadError = ref('');

let controller = null;

const idr = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    maximumFractionDigits: 0,
});

const productPlaceholder = computed(() => {
    if(!form.store_id) return 'Select a store first!';
    if(loadingProducts.value) return 'Loading products...';
    return '-- Select Product --';
});

onMounted(async () => {
    try {
        stores.value = await getStores();
    } catch {
        loadError.value = 'Failed to load stores.';
    }
});

//when store changed: empty the products, cancel old request, take the new products
watch(() => form.store_id, async (storeId) => {
    controller?.abort();
    form.product_id = '';
    products.value = [];
    loadError.value = '';
    loadingProducts.value = false;

    if(!storeId) return;

    const current = new AbortController();
    controller = current;
    loadingProducts.value = true;

    try {
        products.value = await getProducts(storeId, current.signal);
    } catch (e) {
        if(e.name !== 'AbortError') loadError.value = 'Failed to load products.';
    } finally {
        if(controller === current) loadingProducts.value = false;
    }
});

async function submit() {
    submitting.value = true;
    errors.value = {};
    message.value = '';
    loadError.value = '';

    try {
        await createSubmission({ ...form });
        message.value = 'Data saved successfully.';
        form.name = '';
        form.store_id = '';   // watcher will reset the products
        emit('saved');
    } catch (e) {
        if (e.status === 422) errors.value = e.errors;
        else loadError.value = 'Failed to save. Please try again.';
    } finally {
        submitting.value = false;
    }
}
</script>

<template>
    <form class="border border-grid bg-white shadow-sm" @submit.prevent="submit">
        <h2 class="border-b border-grid bg-excel-light px-5 py-3 text-sm font-semibold uppercase tracking-wide text-excel-dark">
            Add Entry
        </h2>

        <div class="space-y-4 p-5">
            <p v-if="message" class="bg-excel-light px-3 py-2 text-sm text-excel-dark">{{  message }}</p>
            <p v-if="loadError" class="bg-red-50 px-3 py-2 text-sm text-red-700">{{  loadError }}</p>

            <div>
                <label for="name" class="field-label">Name</label>
                <input id="name" v-model="form.name" type="text" class="field" placeholder="e.g. Budi Santoso" />
                <p v-if="errors.name" class="mt-1 text-xs text-red-600">{{ errors.name[0] }}</p>
            </div>

            <div>
                <label for="store" class="field-label">Store</label>
                <select id="store" v-model="form.store_id" class="field">
                    <option value="">-- Select Store --</option>
                    <option v-for="s in stores" :key="s.store_id" :value="s.store_id">
                        {{ s.store_name }}
                    </option>
                </select>
                <p v-if="errors.store_id" class="mt-1 text-xs text-red-600">{{ errors.store_id[0] }}</p>
            </div>

            <div>
                <label for="product" class="field-label">Product</label>
                <select id="product"        
                    v-model="form.product_id"
                    class="field"
                    :disabled="!form.store_id || loadingProducts"
                >
                    <option value="">{{ productPlaceholder }}</option>
                    <option v-for="p in products" :key="p.product_id" :value="p.product_id">
                        {{ p.product_name }} - {{ idr.format(p.price) }}
                    </option>
                </select>
                <p v-if="errors.product_id" class="mt-1 text-xs text-red-600">{{ errors.product_id[0] }}</p>
            </div>

             <button
                type="submit"
                class="w-full bg-excel px-4 py-2.5 text-sm font-semibold text-white hover:bg-excel-dark disabled:cursor-not-allowed disabled:opacity-60"
                :disabled="submitting"
            >
                {{ submitting ? 'Saving...' : 'Save' }}
            </button>
        </div>
    </form>
</template>