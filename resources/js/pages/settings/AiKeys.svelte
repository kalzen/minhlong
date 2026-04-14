<script lang="ts">
    import { router, useForm } from '@inertiajs/svelte';
    import { get } from 'svelte/store';
    import AppHead from '@/components/AppHead.svelte';
    import AppLayout from '@/layouts/AppLayout.svelte';
    import SettingsLayout from '@/layouts/settings/Layout.svelte';
    import type { BreadcrumbItem } from '@/types';

    type Provider = { value: string; label: string };
    type ApiKeyRow = {
        id: number;
        provider: string;
        model: string | null;
        name: string;
        masked_key: string;
        is_default: boolean;
        is_active: boolean;
    };

    let {
        keys,
        providers,
    }: {
        keys: ApiKeyRow[];
        providers: Provider[];
    } = $props();

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'AI API keys',
            href: '/settings/ai-keys',
        },
    ];

    const createForm = useForm({
        provider: 'openai',
        model: '',
        name: '',
        api_key: '',
        is_default: false,
        is_active: true,
    });

    const toRowDrafts = (rows: ApiKeyRow[]) => {
        const next: Record<number, { provider: string; model: string; name: string; api_key: string; is_default: boolean; is_active: boolean }> = {};

        for (const row of rows) {
            next[row.id] = {
                provider: row.provider,
                model: row.model ?? '',
                name: row.name,
                api_key: '',
                is_default: row.is_default,
                is_active: row.is_active,
            };
        }

        return next;
    };

    let rowDrafts = $state<Record<number, { provider: string; model: string; name: string; api_key: string; is_default: boolean; is_active: boolean }>>(
        toRowDrafts(keys),
    );

    $effect(() => {
        rowDrafts = toRowDrafts(keys);
    });

    function submitCreate(e: Event) {
        e.preventDefault();
        get(createForm).post('/settings/ai-keys');
    }

    function saveRow(id: number) {
        router.put(`/settings/ai-keys/${id}`, rowDrafts[id]);
    }

    function deleteRow(id: number) {
        router.delete(`/settings/ai-keys/${id}`);
    }
</script>

<AppHead title="AI API keys" />

<AppLayout {breadcrumbs}>
    <SettingsLayout>
        <div class="space-y-8">
            <section class="space-y-3">
                <h2 class="text-lg font-semibold">AI API keys</h2>
                <p class="text-sm text-muted-foreground">
                    Lưu nhiều API key theo từng nền tảng để dùng cho các tính năng AI (dịch bài viết tự động, v.v.).
                    Key được mã hóa khi lưu trong cơ sở dữ liệu.
                </p>
            </section>

            <section class="rounded-lg border p-4">
                <h3 class="mb-4 text-sm font-semibold uppercase tracking-wide text-muted-foreground">Thêm key mới</h3>
                <form class="space-y-4" onsubmit={submitCreate}>
                    <div>
                        <label class="mb-1 block text-sm font-medium" for="provider">Nền tảng</label>
                        <select id="provider" class="w-full rounded border px-3 py-2 text-sm" bind:value={$createForm.provider}>
                            {#each providers as provider (provider.value)}
                                <option value={provider.value}>{provider.label}</option>
                            {/each}
                        </select>
                        {#if $createForm.errors.provider}
                            <p class="mt-1 text-sm text-red-600">{$createForm.errors.provider}</p>
                        {/if}
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium" for="name">Tên hiển thị</label>
                        <input id="name" type="text" class="w-full rounded border px-3 py-2 text-sm" bind:value={$createForm.name} />
                        {#if $createForm.errors.name}
                            <p class="mt-1 text-sm text-red-600">{$createForm.errors.name}</p>
                        {/if}
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium" for="model">Model (tuỳ chọn)</label>
                        <input
                            id="model"
                            type="text"
                            class="w-full rounded border px-3 py-2 text-sm font-mono"
                            placeholder="vd: gpt-5.4, claude-haiku-4-5-20251001"
                            bind:value={$createForm.model}
                        />
                        {#if $createForm.errors.model}
                            <p class="mt-1 text-sm text-red-600">{$createForm.errors.model}</p>
                        {/if}
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium" for="api_key">API key</label>
                        <input id="api_key" type="password" class="w-full rounded border px-3 py-2 text-sm font-mono" bind:value={$createForm.api_key} />
                        {#if $createForm.errors.api_key}
                            <p class="mt-1 text-sm text-red-600">{$createForm.errors.api_key}</p>
                        {/if}
                    </div>

                    <label class="flex items-center gap-2 text-sm">
                        <input type="checkbox" bind:checked={$createForm.is_default} />
                        Đặt làm key mặc định cho provider này
                    </label>
                    <label class="flex items-center gap-2 text-sm">
                        <input type="checkbox" bind:checked={$createForm.is_active} />
                        Kích hoạt key
                    </label>

                    <button
                        type="submit"
                        class="inline-flex items-center rounded bg-primary px-4 py-2 text-sm font-medium text-primary-foreground hover:bg-primary/90 disabled:opacity-50"
                        disabled={$createForm.processing}
                    >
                        {$createForm.processing ? 'Đang lưu…' : 'Lưu key'}
                    </button>
                </form>
            </section>

            <section class="space-y-4">
                <h3 class="text-sm font-semibold uppercase tracking-wide text-muted-foreground">Các key đã lưu</h3>
                {#if keys.length === 0}
                    <p class="text-sm text-muted-foreground">Chưa có API key nào.</p>
                {:else}
                    <div class="space-y-4">
                        {#each keys as row (row.id)}
                            <div class="rounded-lg border p-4">
                                <p class="mb-2 text-xs text-muted-foreground">Key hiện tại: <span class="font-mono">{row.masked_key}</span></p>
                                <div class="grid gap-4 md:grid-cols-2">
                                    <div>
                                        <label class="mb-1 block text-sm font-medium">Nền tảng</label>
                                        <select class="w-full rounded border px-3 py-2 text-sm" bind:value={rowDrafts[row.id].provider}>
                                            {#each providers as provider (provider.value)}
                                                <option value={provider.value}>{provider.label}</option>
                                            {/each}
                                        </select>
                                    </div>
                                    <div>
                                        <label class="mb-1 block text-sm font-medium">Tên hiển thị</label>
                                        <input class="w-full rounded border px-3 py-2 text-sm" bind:value={rowDrafts[row.id].name} />
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <label class="mb-1 block text-sm font-medium">Model (tuỳ chọn)</label>
                                    <input class="w-full rounded border px-3 py-2 text-sm font-mono" bind:value={rowDrafts[row.id].model} />
                                </div>
                                <div class="mt-4">
                                    <label class="mb-1 block text-sm font-medium">API key mới (để trống nếu giữ nguyên)</label>
                                    <input
                                        type="password"
                                        class="w-full rounded border px-3 py-2 text-sm font-mono"
                                        bind:value={rowDrafts[row.id].api_key}
                                    />
                                </div>
                                <div class="mt-4 flex flex-wrap gap-4">
                                    <label class="flex items-center gap-2 text-sm">
                                        <input type="checkbox" bind:checked={rowDrafts[row.id].is_default} />
                                        Mặc định
                                    </label>
                                    <label class="flex items-center gap-2 text-sm">
                                        <input type="checkbox" bind:checked={rowDrafts[row.id].is_active} />
                                        Kích hoạt
                                    </label>
                                </div>
                                <div class="mt-4 flex gap-2">
                                    <button
                                        type="button"
                                        class="inline-flex items-center rounded border px-3 py-2 text-sm hover:bg-muted/40"
                                        onclick={() => saveRow(row.id)}
                                    >
                                        Cập nhật
                                    </button>
                                    <button
                                        type="button"
                                        class="inline-flex items-center rounded border border-red-300 px-3 py-2 text-sm text-red-600 hover:bg-red-50"
                                        onclick={() => deleteRow(row.id)}
                                    >
                                        Xóa key
                                    </button>
                                </div>
                            </div>
                        {/each}
                    </div>
                {/if}
            </section>
        </div>
    </SettingsLayout>
</AppLayout>
