@php($postTags = $post->tags ?? collect())
<label for="tagsInput">Теги</label>
<select multiple type="text" class="form-control" id="tagsInput" name="tags[]">
    @foreach($tags as $tag)
        @if(old('tags'))
            <option {{ in_array($tag->name, old('tags')) ? 'selected' : '' }}
                    value="{{ $tag->name }}">{{ $tag->name }}</option>
        @else
            {{-- TODO: не уверен, что это оптимальный вариант в плане ресурсов. --}}
            {{-- TODO: Можно как-то улучшить данный код?--}}
            <option {{ $postTags->where('name', $tag->name)->first() ? 'selected' : '' }}
                    value="{{ $tag->name }}">{{ $tag->name }}</option>
        @endif
    @endforeach
</select>
