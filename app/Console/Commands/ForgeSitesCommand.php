<?php

namespace App\Console\Commands;

use App\Models\Site;
use App\Models\Server;
use ReflectionProperty;
use Laravel\Forge\Forge;
use Laravel\Forge\ApiProvider;
use Illuminate\Console\Command;
use Laravel\Forge\Sites\SitesManager;

class ForgeSitesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forge:sites';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->forge = new Forge(
            new ApiProvider(env('FORGE_API_TOKEN'))
        );
        $this->sitesManager = new SitesManager();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $servers = Server::all();

        foreach ($servers as $server) {
            $sites = $this->sitesManager->list()->from($this->forge[$server->name]);

            foreach ($sites as $site) {
                $this->updateSite($server, $site);
            }
        }

        $this->info('Fetched forge sites.');
    }

    public function updateSite($server, $site)
    {
        $server = Site::updateOrCreate([
            'id' => $site->id(),
        ], [
            'id' => $site->id(),
            'server_id' => $server->id,
            'data' => $this->getUnaccessibleProperty($site, 'data'),
            'created_at' => $this->getUnaccessibleProperty($site, 'data')['created_at']
        ]);
    }

    /**
     * Get protected or private class property value.
     *
     * @param mixed $instance
     * @param string $property
     * @param mixed $value
     * @return mixed
     */
    public function getUnaccessibleProperty($instance, string $property)
    {
        $reflection = new ReflectionProperty(get_class($instance), $property);
        $reflection->setAccessible(true);
        return $reflection->getValue($instance);
    }
}
