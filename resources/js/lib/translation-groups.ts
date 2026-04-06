export type Postish = {
    id: number;
    locale: string;
    translation_group_id: string | null;
};

export type TranslationGroupBlock<T extends Postish> = {
    key: string;
    translation_group_id: string | null;
    posts: T[];
    locales: string[];
};

/**
 * Group rows by translation_group_id. Rows without a group are each their own block.
 */
export function groupByTranslationGroup<T extends Postish>(rows: T[]): TranslationGroupBlock<T>[] {
    const byKey = new Map<string, T[]>();

    for (const row of rows) {
        const key = row.translation_group_id ?? `single-${row.id}`;
        const list = byKey.get(key);
        if (list) {
            list.push(row);
        } else {
            byKey.set(key, [row]);
        }
    }

    const order: string[] = [];
    const seen = new Set<string>();
    for (const row of rows) {
        const key = row.translation_group_id ?? `single-${row.id}`;
        if (seen.has(key)) {
            continue;
        }
        seen.add(key);
        order.push(key);
    }

    return order.map((key) => {
        const posts = byKey.get(key) ?? [];
        const translation_group_id = posts[0]?.translation_group_id ?? null;
        const locales = [...new Set(posts.map((p) => p.locale))];

        return {
            key,
            translation_group_id,
            posts,
            locales,
        };
    });
}
