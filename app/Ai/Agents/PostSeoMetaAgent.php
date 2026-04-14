<?php

namespace App\Ai\Agents;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\HasStructuredOutput;
use Laravel\Ai\Promptable;
use Stringable;

class PostSeoMetaAgent implements Agent, HasStructuredOutput
{
    use Promptable;

    public function instructions(): Stringable|string
    {
        return <<<'PROMPT'
You are an SEO assistant for blog articles.
Generate concise and accurate SEO metadata in the requested locale.

Rules:
- meta_title should be under 60 characters when possible.
- meta_description should be around 140-160 characters.
- Keep terminology natural for the locale and article topic.
- Return only schema fields.
PROMPT;
    }

    public function schema(JsonSchema $schema): array
    {
        return [
            'meta_title' => $schema->string()->required(),
            'meta_description' => $schema->string()->required(),
        ];
    }
}
