<script lang="ts">
    import { Link, useForm } from '@inertiajs/svelte';
    import AppHead from '@/components/AppHead.svelte';
    import AppLayout from '@/layouts/AppLayout.svelte';
    import SettingsLayout from '@/layouts/settings/Layout.svelte';
    import { toUrl } from '@/lib/utils';
    import admin from '@/routes/admin';
    import settingsRoutes from '@/routes/settings';
    import type { BreadcrumbItem } from '@/types';

    type SiteSettingsPayload = {
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
        social_facebook: string | null;
        social_linkedin: string | null;
        social_instagram: string | null;
        social_youtube: string | null;
        social_zalo: string | null;
    };

    const emptySettings = (): SiteSettingsPayload => ({
        site_name: null,
        site_slogan: null,
        meta_title: null,
        meta_description: null,
        meta_keywords: null,
        default_meta_title: null,
        default_meta_description: null,
        contact_phone: null,
        contact_email: null,
        contact_address_haiphong: null,
        contact_address_hanoi: null,
        contact_address: null,
        social_facebook: null,
        social_linkedin: null,
        social_instagram: null,
        social_youtube: null,
        social_zalo: null,
    });

    let {
        settings = emptySettings(),
    }: {
        settings?: SiteSettingsPayload;
    } = $props();

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Website settings',
            href: '/settings/general',
        },
    ];

    const form = useForm({
        site_name: settings.site_name ?? '',
        site_slogan: settings.site_slogan ?? '',
        meta_title: settings.meta_title ?? '',
        meta_description: settings.meta_description ?? '',
        meta_keywords: settings.meta_keywords ?? '',
        default_meta_title: settings.default_meta_title ?? '',
        default_meta_description: settings.default_meta_description ?? '',
        contact_phone: settings.contact_phone ?? '',
        contact_email: settings.contact_email ?? '',
        contact_address_haiphong: settings.contact_address_haiphong ?? '',
        contact_address_hanoi: settings.contact_address_hanoi ?? '',
        contact_address: settings.contact_address ?? '',
        social_facebook: settings.social_facebook ?? '',
        social_linkedin: settings.social_linkedin ?? '',
        social_instagram: settings.social_instagram ?? '',
        social_youtube: settings.social_youtube ?? '',
        social_zalo: settings.social_zalo ?? '',
    });

    function submit() {
        form.put(settingsRoutes.general.update.url());
    }
</script>

<AppHead title="Website settings" />

<AppLayout {breadcrumbs}>
    <h1 class="sr-only">Website settings</h1>

    <SettingsLayout>
        <div class="space-y-8">
            <section class="rounded-lg border border-dashed bg-muted/30 p-4">
                <p class="text-sm text-muted-foreground">
                    Để đổi banner, logo, ảnh trang chủ và ảnh các trang ngành, mở
                    <Link
                        class="font-medium text-primary underline-offset-4 hover:underline"
                        href={toUrl(admin.siteMedia.index())}
                    >
                        chỉnh sửa hình ảnh website
                    </Link>
                    .
                </p>
            </section>

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

            <section class="space-y-4">
                <h2 class="text-lg font-semibold">Mạng xã hội (footer)</h2>
                <p class="text-sm text-muted-foreground">
                    Nhập URL đầy đủ (https://…). Để trống để ẩn icon tương ứng trên website.
                </p>
                <div class="space-y-4">
                    <div>
                        <label class="mb-1 block text-sm font-medium" for="social_facebook">Facebook</label>
                        <input
                            id="social_facebook"
                            type="url"
                            bind:value={$form.social_facebook}
                            class="w-full rounded border px-3 py-2 text-sm"
                            placeholder="https://"
                        />
                        {#if $form.errors.social_facebook}
                            <p class="mt-1 text-sm text-red-600">{$form.errors.social_facebook}</p>
                        {/if}
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium" for="social_linkedin">LinkedIn</label>
                        <input
                            id="social_linkedin"
                            type="url"
                            bind:value={$form.social_linkedin}
                            class="w-full rounded border px-3 py-2 text-sm"
                            placeholder="https://"
                        />
                        {#if $form.errors.social_linkedin}
                            <p class="mt-1 text-sm text-red-600">{$form.errors.social_linkedin}</p>
                        {/if}
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium" for="social_instagram">Instagram</label>
                        <input
                            id="social_instagram"
                            type="url"
                            bind:value={$form.social_instagram}
                            class="w-full rounded border px-3 py-2 text-sm"
                            placeholder="https://"
                        />
                        {#if $form.errors.social_instagram}
                            <p class="mt-1 text-sm text-red-600">{$form.errors.social_instagram}</p>
                        {/if}
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium" for="social_youtube">YouTube</label>
                        <input
                            id="social_youtube"
                            type="url"
                            bind:value={$form.social_youtube}
                            class="w-full rounded border px-3 py-2 text-sm"
                            placeholder="https://"
                        />
                        {#if $form.errors.social_youtube}
                            <p class="mt-1 text-sm text-red-600">{$form.errors.social_youtube}</p>
                        {/if}
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium" for="social_zalo">Zalo</label>
                        <input
                            id="social_zalo"
                            type="url"
                            bind:value={$form.social_zalo}
                            class="w-full rounded border px-3 py-2 text-sm"
                            placeholder="https://zalo.me/…"
                        />
                        {#if $form.errors.social_zalo}
                            <p class="mt-1 text-sm text-red-600">{$form.errors.social_zalo}</p>
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
