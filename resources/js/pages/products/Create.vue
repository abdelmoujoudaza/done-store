<script setup>
import ProductLayout from '@/layouts/ProductLayout.vue';
import InputError from '@/components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    categories: Array,
});

const form = useForm({
    name: '',
    description: '',
    price: 0.0,
    image: null,
    categories: [],
});

const submit = () => {
    form.post(route('products.store'), {
        onSuccess: () => form.reset(),
    });
};

</script>

<template>
    <Head title="Products - Form" />

    <ProductLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-between mb-6">
                            <h3 class="text-lg font-medium">Product Form</h3>
                            <Link
                                href="/products"
                                class="px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600"
                            >
                                List Products
                            </Link>
                        </div>

                        <form @submit.prevent="submit">
                            <div class="space-y-6">
                                <div class="grid gap-2">
                                    <label htmlFor="name">Name</label>
                                    <input
                                        id="name"
                                        type="text"
                                        class="mt-1 block w-full py-2 px-4 border"
                                        v-model="form.name"
                                        required
                                        autocomplete="current-name"
                                        autofocus
                                    />

                                    <InputError :message="form.errors.name" />
                                </div>
                                <div class="grid gap-2">
                                    <label htmlFor="description">Description</label>
                                    <textarea
                                        id="description"
                                        type="text"
                                        class="mt-1 block w-full py-2 px-4 border"
                                        v-model="form.description"
                                        required
                                        autocomplete="current-description"
                                        autofocus
                                    />

                                    <InputError :message="form.errors.description" />
                                </div>
                                <div class="grid gap-2">
                                    <label htmlFor="price">Price</label>
                                    <input
                                        id="price"
                                        type="number"
                                        step="0.01"
                                        class="mt-1 block w-full py-2 px-4 border"
                                        v-model="form.price"
                                        required
                                        autocomplete="current-price"
                                        autofocus
                                    />

                                    <InputError :message="form.errors.price" />
                                </div>

                                <div class="grid gap-2">
                                    <label htmlFor="image">Image</label>
                                    <input
                                        id="image"
                                        type="file"
                                        @input="form.image = $event.target.files[0]"
                                        class="mt-1 block w-full py-2 px-4 border"
                                        required
                                        autocomplete="current-image"
                                        autofocus
                                    />

                                    <InputError :message="form.errors.image" />
                                </div>
                                <div class="grid gap-2">
                                    <label htmlFor="categories">Categories</label>
                                    <select
                                        id="categories"
                                        v-model="form.categories"
                                        class="mt-1 block w-full py-2 px-4 border focus:border-indigo-500 focus:ring-indigo-500"
                                        multiple
                                        required
                                        autocomplete="current-categories"
                                        autofocus
                                    >
                                        <option
                                            v-for="category in categories"
                                            :key="category.id"
                                            :value="category.id"
                                        >
                                            {{ category.name }}
                                        </option>
                                    </select>

                                    <InputError :message="form.errors.categories" />
                                </div>

                                <div class="flex items-center">
                                    <button class="w-full px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600" :disabled="form.processing">
                                        <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                                        Create
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </ProductLayout>
</template>
