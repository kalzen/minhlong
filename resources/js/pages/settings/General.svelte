<script lang="ts">
  import Layout from '@/layouts/settings/Layout.svelte';
  import { router, useForm, usePage } from '@inertiajs/svelte';

  const page = usePage<{
    props: {
      settings: {
        site_name: string | null;
        site_slogan: string | null;
        meta_title: string | null;
        meta_description: string | null;
        contact_phone: string | null;
        contact_email: string | null;
        contact_address: string | null;
      };
    };
  }>();

  const form = useForm({
    site_name: page.props.settings.site_name ?? '',
    site_slogan: page.props.settings.site_slogan ?? '',
    meta_title: page.props.settings.meta_title ?? '',
    meta_description: page.props.settings.meta_description ?? '',
    contact_phone: page.props.settings.contact_phone ?? '',
    contact_email: page.props.settings.contact_email ?? '',
    contact_address: page.props.settings.contact_address ?? '',
  });

  function submit() {
    form.put(route('settings.general.update'));
  }
</script>

<Layout title="Cài đặt website">
  <div class="space-y-8">
    <section class="space-y-4">
      <h2 class="text-lg font-semibold">Thông tin chung</h2>

      <div class="space-y-4">
        <div>
          <label class="block text-sm font-medium mb-1" for="site_name">
            Tên website
          </label>
          <input
            id="site_name"
            type="text"
            bind:value={form.site_name}
            class="w-full rounded border px-3 py-2 text-sm"
          />
          {#if form.errors.site_name}
            <p class="mt-1 text-sm text-red-600">{form.errors.site_name}</p>
          {/if}
        </div>

        <div>
          <label class="block text-sm font-medium mb-1" for="site_slogan">
            Slogan (tuỳ chọn)
          </label>
          <input
            id="site_slogan"
            type="text"
            bind:value={form.site_slogan}
            class="w-full rounded border px-3 py-2 text-sm"
          />
          {#if form.errors.site_slogan}
            <p class="mt-1 text-sm text-red-600">{form.errors.site_slogan}</p>
          {/if}
        </div>

        <div>
          <label class="block text-sm font-medium mb-1" for="meta_title">
            Meta title mặc định
          </label>
          <input
            id="meta_title"
            type="text"
            bind:value={form.meta_title}
            class="w-full rounded border px-3 py-2 text-sm"
          />
          {#if form.errors.meta_title}
            <p class="mt-1 text-sm text-red-600">{form.errors.meta_title}</p>
          {/if}
        </div>

        <div>
          <label class="block text-sm font-medium mb-1" for="meta_description">
            Meta description mặc định
          </label>
          <textarea
            id="meta_description"
            rows="3"
            bind:value={form.meta_description}
            class="w-full rounded border px-3 py-2 text-sm"
          />
          {#if form.errors.meta_description}
            <p class="mt-1 text-sm text-red-600">{form.errors.meta_description}</p>
          {/if}
        </div>
      </div>
    </section>

    <section class="space-y-4">
      <h2 class="text-lg font-semibold">Thông tin liên hệ</h2>

      <div class="space-y-4">
        <div>
          <label class="block text-sm font-medium mb-1" for="contact_phone">
            Số điện thoại
          </label>
          <input
            id="contact_phone"
            type="text"
            bind:value={form.contact_phone}
            class="w-full rounded border px-3 py-2 text-sm"
          />
          {#if form.errors.contact_phone}
            <p class="mt-1 text-sm text-red-600">{form.errors.contact_phone}</p>
          {/if}
        </div>

        <div>
          <label class="block text-sm font-medium mb-1" for="contact_email">
            Email
          </label>
          <input
            id="contact_email"
            type="email"
            bind:value={form.contact_email}
            class="w-full rounded border px-3 py-2 text-sm"
          />
          {#if form.errors.contact_email}
            <p class="mt-1 text-sm text-red-600">{form.errors.contact_email}</p>
          {/if}
        </div>

        <div>
          <label class="block text-sm font-medium mb-1" for="contact_address">
            Địa chỉ
          </label>
          <textarea
            id="contact_address"
            rows="2"
            bind:value={form.contact_address}
            class="w-full rounded border px-3 py-2 text-sm"
          />
          {#if form.errors.contact_address}
            <p class="mt-1 text-sm text-red-600">{form.errors.contact_address}</p>
          {/if}
        </div>
      </div>
    </section>

    <div class="flex justify-end">
      <button
        type="button"
        on:click|preventDefault={submit}
        class="inline-flex items-center rounded bg-primary-600 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700 disabled:opacity-50"
        disabled={form.processing}
      >
        Lưu cài đặt
      </button>
    </div>
  </div>
</Layout>

