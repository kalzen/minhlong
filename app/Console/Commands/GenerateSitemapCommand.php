<?php

namespace App\Console\Commands;

use App\Sitemap\SiteSitemapBuilder;
use Illuminate\Console\Command;

class GenerateSitemapCommand extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate the public sitemap.xml file';

    public function handle(SiteSitemapBuilder $builder): int
    {
        $builder->writeToPublic();

        $this->components->info('Sitemap written to '.public_path('sitemap.xml'));

        return self::SUCCESS;
    }
}
