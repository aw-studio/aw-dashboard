
<div class="w-full lg:w-1/2 box-border" wire:poll.100ms>
<div class="card m-8 p-8">
    <h2 class="text-2xl font-bold">Forge Status</h2>
    <br>
    <p>
        Servers: {{ count($servers) }}
    </p>
    <p>
        Sites: {{ count($sites) }}
    </p>
    
    {{-- <p>
        Healthy {{ count($_instance->getHealthySites()) }}/{{ count(collect($sites)->flatten()) }}
    </p> --}}
    
    {{-- <div class="m-y-2">
        <h3>
            Issues
        </h3>
        <ul>
            <li>site 1</li>
            <li>site 2</li>
        </ul>
    </div> --}}

    @if(count($deploys) > 0)
    <br>
    <div class="m-y-2">
        <h3>
            Deployments
        </h3>
        <ul>
            @foreach($deploys as $deploy) 
                <li>{{ $deploy->site->data['name'] }}
                    <pre>
{{ collect($deploy->data)->toJson(JSON_PRETTY_PRINT) }}
                    </pre>
                </li>
            @endforeach
        </ul>
    </div>
    @endif
    


</div>
</div>
