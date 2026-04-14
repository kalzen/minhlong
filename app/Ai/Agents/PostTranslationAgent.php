<?php

namespace App\Ai\Agents;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\HasStructuredOutput;
use Laravel\Ai\Promptable;
use Stringable;

class PostTranslationAgent implements Agent, HasStructuredOutput
{
    use Promptable;

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
    {
        return <<<'PROMPT'
You are a professional content localizer for business blog posts.
Translate and adapt content for the requested locale while preserving meaning and structure.

Rules:
- Keep HTML tags in `content` valid.
- Return concise SEO-friendly title/meta fields.
- Do not include explanations.
- Output only fields defined in schema.
PROMPT;
    }

    /**
     * Get the agent's structured output schema definition.
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'title' => $schema->string()->required(),
            'excerpt' => $schema->string(),
            'content' => $schema->string(),
            'meta_title' => $schema->string(),
            'meta_description' => $schema->string(),
        ];
    }
}
