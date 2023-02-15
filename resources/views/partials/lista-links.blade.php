@foreach ($links as $link)
<tr>
    <td>
        <span class="channel label label-default" style="background: {{ $link->channel->color }}">
            <a href="/community/{{ $link->channel->slug }}">
                {{$link->channel->title}}
            </a>
        </span>
    
        
        <a class="ps-2" href="{{$link->link}}" target="_blank">
            {{$link->title}}
        </a>
    
        <small>Contributed by: {{$link->creator->name}} {{$link->updated_at->diffForHumans()}}</small>
    </td>
</tr>
@endforeach