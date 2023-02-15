<form method="POST" action="/community">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="title">Title:</label>

        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title')}}" placeholder="What is the title of your article?">

        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="link">Link:</label>
        <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{old('link')}}" placeholder="What is the URL?">

        @error('link')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="Channel">Channel:</label>
        <select class="form-control @error('channel_id') is-invalid @enderror" name="channel_id">
            <option selected disabled>Pick a Channel...</option>
            @foreach ($channels as $channel)
            <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>
            {{ $channel->title }}
            </option>
            @endforeach
        </select>
        @error('channel_id')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group pt-3">
        <button class="btn btn-primary">Contribute Link</button>
    </div>
</form>