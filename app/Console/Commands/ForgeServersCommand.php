<?php

namespace App\Console\Commands;

use App\Models\Server;
use ReflectionProperty;
use Laravel\Forge\Forge;
use Illuminate\Support\Str;
use Laravel\Forge\ApiProvider;
use Illuminate\Console\Command;

class ForgeServersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forge:servers';

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
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $servers = $this->forge->lazyload();

        foreach ($servers as $server) {
            $this->updateServer($server);
        }

        $this->info('Fetched forge servers.');
    }

    public function updateServer($server)
    {
        $server = Server::updateOrCreate([
            'id' => $server->id(),
        ], [
            'id' => $server->id(),
            'name' => $server->name(),
            'data' => $this->getUnaccessibleProperty($server, 'data'),
            'created_at' => $server->createdAt()
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
