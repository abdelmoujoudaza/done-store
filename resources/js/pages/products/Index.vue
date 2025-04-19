<script setup>
import ProductLayout from '@/layouts/ProductLayout.vue';
import Pagination from '@/components/Pagination.vue';
import { Head, Link, router } from '@inertiajs/vue3'
import { ref, watch } from 'vue';

const props = defineProps({
    products: Object,
    categories: Array,
    filters: Object,
});

const sorts = [
    {
        id: 'ASC',
        label: 'Low to High'
    },
    {
        id: 'DESC',
        label: 'High to Low'
    }
];

const selectedSort = ref(props.filters.sort || 'asc');
const selectedCategory = ref(props.filters.category || '');

// Watch for sort filter changes
watch(selectedSort, (value) => {
    router.get('/products', { sort: value, category: selectedCategory.value, page: 1 }, {
        preserveState: true,
        replace: true,
    });
});

// Watch for category filter changes
watch(selectedCategory, (value) => {
    router.get('/products', { category: value, sort: selectedSort.value, page: 1 }, {
        preserveState: true,
        replace: true,
    });
});
</script>

<template>
    <Head title="Products" />

    <ProductLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        <div class="flex justify-between mb-6">
                            <h3 class="text-lg font-medium">Product List</h3>
                            <Link
                                href="/products/create"
                                class="px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600"
                            >
                                Add Product
                            </Link>
                        </div>

                        <!-- Filter Section -->
                        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                            <div class="flex flex-wrap items-end gap-4">
                                <!-- Category Filter -->
                                <div class="flex-1 min-w-[200px]">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                    <select
                                        v-model="selectedCategory"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    >
                                        <option value="">All Categories</option>
                                        <option
                                            v-for="category in categories"
                                            :key="category.id"
                                            :value="category.id"
                                        >
                                            {{ category.name }}
                                        </option>
                                    </select>
                                </div>

                                <!-- Sort Filter -->
                                <div class="flex-1 min-w-[200px]">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Sort by Price</label>
                                    <select
                                        v-model="selectedSort"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    >
                                        <option
                                            v-for="sort in sorts"
                                            :key="sort.id"
                                            :value="sort.id"
                                        >
                                            {{ sort.label }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Table Section -->
                        <div class="max-w-7xl">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50 min-w-full">
                                    <tr class="min-w-full">
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/12">ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-2/12">Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-3/12">Description</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/12">Price</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-3/12">Categories</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-2/12">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 min-w-full">
                                    <tr v-for="product in products.data" :key="product.id" class="min-w-full">
                                        <td class="px-6 py-4 text-sm text-gray-500 w-1/12">{{ product.id }}</td>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900 w-2/12">{{ product.name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500 w-3/12">{{ product.description }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500 w-1/12">${{ product.price.toFixed(2) }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500 w-3/12">{{ product.categories.map((category) => category.name).join(', ') }}</td>
                                        <td class="px-6 py-4 text-sm font-medium w-2/12">
                                            <Link
                                                :href="`/products/${product.id}`"
                                                method="delete"
                                                as="button"
                                                class="text-red-600 hover:text-red-900"
                                            >
                                                Delete
                                            </Link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <Pagination class="mt-6" :links="products.links" />
                    </div>
                </div>
            </div>
        </div>
    </ProductLayout>
</template>
