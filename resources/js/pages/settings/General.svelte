<script lang="ts">
    import { useForm, usePage } from '@inertiajs/svelte';
    import AppHead from '@/components/AppHead.svelte';
    import AppLayout from '@/layouts/AppLayout.svelte';
    import SettingsLayout from '@/layouts/settings/Layout.svelte';
    import type { BreadcrumbItem } from '@/types';

    const page = usePage<{
        props: {
            settings: {
                site_name: string | null;
                site_slogan: string | null;
                meta_title: string | null;
                meta_description: string | null;
                meta_keywords: string | null;
                default_meta_title: string | null;
                default_meta_description: string | null;
                contact_phone: string | null;
                contact_email: string | null;
                contact_address_haiphong: string | null;
                contact_address_hanoi: string | null;
                contact_address: string | null;
            };
        };
    }>();

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Website settings',
            href: '/settings/general',
        },
    ];

    const form = useForm({
        site_name: page.props.settings.site_name ?? '',
        site_slogan: page.props.settings.site_slogan ?? '',
        meta_title: page.props.settings.meta_title ?? '',
        meta_description: page.props.settings.meta_description ?? '',
        meta_keywords: page.props.settings.meta_keywords ?? '',
        default_meta_title: page.props.settings.default_meta_title ?? '',
        default_meta_description: page.props.settings.default_meta_description ?? '',
        contact_phone: page.props.settings.contact_phone ?? '',
        contact_email: page.props.settings.contact_email ?? '',
        contact_address_haiphong: page.props.settings.contact_address_haiphong ?? '',
        contact_address_hanoi: page.props.settings.contact_address_hanoi ?? '',
        contact_address: page.props.settings.contact_address ?? '',
    });

    function submit() {
        form.put(route('settings.general.update'));
    }
</script>

<AppHead title="Website settings" />

<AppLayout {breadcrumbs}>
    <h1 class="sr-only">Website settings</h1>

    <SettingsLayout>
        <div class="space-y-8">
            <section class="space-y-4">
                <h2 class="text-lg font-semibold">Thông tin chung</h2>

                <div class="space-y-4">
                    <div>
                        <label class="mb-1 block text-sm font-medium" for="site_name">Tên website</label>
                        <input
                            id="site_name"
                            type="text"
                            bind:value={$form.site_name}
                            class="w-full rounded border px-3 py-2 text-sm"
                        />
                        {#if $form.errors.site_name}
                            <p class="mt-1 text-sm text-red-600">{$form.errors.site_name}</p>
                        {/if}
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium" for="site_slogan">Slogan (tuỳ chọn)</label>
                        <input
                            id="site_slogan"
                            type="text"
                            bind:value={$form.site_slogan}
                            class="w-full rounded border px-3 py-2 text-sm"
                        />
                        {#if $form.errors.site_slogan}
                            <p class="mt-1 text-sm text-red-600">{$form.errors.site_slogan}</p>
                        {/if}
                    </div>
                </div>
            </section>

            <section class="space-y-4">
                <h2 class="text-lg font-semibold">Meta &amp; SEO (hiển thị trên layout công khai)</h2>
                <p class="text-sm text-muted-foreground">
                    Các giá trị mặc định dùng khi trang không ghi đè title/description riêng.
                </p>

                <div class="space-y-4">
                    <div>
                        <label class="mb-1 block text-sm font-medium" for="meta_title">Meta title mặc định</label>
                        <input
                            id="meta_title"
                            type="text"
                            bind:value={$form.meta_title}
                            class="w-full rounded border px-3 py-2 text-sm"
                        />
                        {#if $form.errors.meta_title}
                            <p class="mt-1 text-sm text-red-600">{$form.errors.meta_title}</p>
                        {/if}
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium" for="meta_description">Meta description mặc định</label>
                        <textarea
                            id="meta_description"
                            rows="4"
                            bind:value={$form.meta_description}
                            class="w-full rounded border px-3 py-2 text-sm"
                        ></textarea>
                        {#if $form.errors.meta_description}
                            <p class="mt-1 text-sm text-red-600">{$form.errors.meta_description}</p>
                        {/if}
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium" for="meta_keywords">Meta keywords</label>
                        <textarea
                            id="meta_keywords"
                            rows="3"
                            bind:value={$form.meta_keywords}
                            class="w-full rounded border px-3 py-2 text-sm"
                        ></textarea>
                        {#if $form.errors.meta_keywords}
                            <p class="mt-1 text-sm text-red-600">{$form.errors.meta_keywords}</p>
                        {/if}
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium" for="default_meta_title">Fallback meta title (tuỳ chọn)</label>
                        <input
                            id="default_meta_title"
                            type="text"
                            bind:value={$form.default_meta_title}
                            class="w-full rounded border px-3 py-2 text-sm"
                        />
                        {#if $form.errors.default_meta_title}
                            <p class="mt-1 text-sm text-red-600">{$form.errors.default_meta_title}</p>
                        {/if}
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium" for="default_meta_description"
                            >Fallback meta description (tuỳ chọn)</label
                        >
                        <textarea
                            id="default_meta_description"
                            rows="3"
                            bind:value={$form.default_meta_description}
                            class="w-full rounded border px-3 py-2 text-sm"
                        ></textarea>
                        {#if $form.errors.default_meta_description}
                            <p class="mt-1 text-sm text-red-600">{$form.errors.default_meta_description}</p>
                        {/if}
                    </div>
                </div>
            </section>

            <section class="space-y-4">
                <h2 class="text-lg font-semibold">Thông tin liên hệ (footer &amp; trang liên hệ)</h2>

                <div class="space-y-4">
                    <div>
                        <label class="mb-1 block text-sm font-medium" for="contact_phone">Số điện thoại</label>
                        <input
                            id="contact_phone"
                            type="text"
                            bind:value={$form.contact_phone}
                            class="w-full rounded border px-3 py-2 text-sm"
                        />
                        {#if $form.errors.contact_phone}
                            <p class="mt-1 text-sm text-red-600">{$form.errors.contact_phone}</p>
                        {/if}
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium" for="contact_email">Email</label>
                        <input
                            id="contact_email"
                            type="email"
                            bind:value={$form.contact_email}
                            class="w-full rounded border px-3 py-2 text-sm"
                        />
                        {#if $form.errors.contact_email}
                            <p class="mt-1 text-sm text-red-600">{$form.errors.contact_email}</p>
                        {/if}
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium" for="contact_address_haiphong">Địa chỉ — Hải Phòng</label>
                        <textarea
                            id="contact_address_haiphong"
                            rows="2"
                            bind:value={$form.contact_address_haiphong}
                            class="w-full rounded border px-3 py-2 text-sm"
                        ></textarea>
                        {#if $form.errors.contact_address_haiphong}
                            <p class="mt-1 text-sm text-red-600">{$form.errors.contact_address_haiphong}</p>
                        {/if}
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium" for="contact_address_hanoi">Địa chỉ — Hà Nội</label>
                        <textarea
                            id="contact_address_hanoi"
                            rows="2"
                            bind:value={$form.contact_address_hanoi}
                            class="w-full rounded border px-3 py-2 text-sm"
                        ></textarea>
                        {#if $form.errors.contact_address_hanoi}
                            <p class="mt-1 text-sm text-red-600">{$form.errors.contact_address_hanoi}</p>
                        {/if}
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium" for="contact_address"
                            >Địa chỉ dự phòng (một dòng, tuỳ chọn)</label
                        >
                        <textarea
                            id="contact_address"
                            rows="2"
                            bind:value={$form.contact_address}
                            class="w-full rounded border px-3 py-2 text-sm"
                        ></textarea>
                        <p class="mt-1 text-xs text-muted-foreground">
                            Chỉ hiển thị khi hai địa chỉ trên đều để trống.
                        </p>
                        {#if $form.errors.contact_address}
                            <p class="mt-1 text-sm text-red-600">{$form.errors.contact_address}</p>
                        {/if}
                    </div>
                </div>
            </section>

            <div class="flex justify-end">
                <button
                    type="button"
                    class="inline-flex items-center rounded bg-primary px-4 py-2 text-sm font-medium text-primary-foreground hover:bg-primary/90 disabled:opacity-50"
                    disabled={$form.processing}
                    onclick={(e) => {
                        e.preventDefault();
                        submit();
                    }}
                >
                    Lưu cài đặt
                </button>
            </div>
        </div>
    </SettingsLayout>
</AppLayout>
