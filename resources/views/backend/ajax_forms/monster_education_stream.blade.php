<div class="form-group">
    <label class="pay">Education Stream <small>(monster)</small></label>
    <select name="monster_education_stream_id" class="list-dt form-control" id="monster_education_stream_id">
        <option value="0">-Select Education Stream-</option>
        @if(count($monster_education_streams))
        @foreach($monster_education_streams as $monster_education_stream)
        <option value="{{ $monster_education_stream->stream_id }}">
            {{ isset($monster_education_stream->specialization)?$monster_education_stream->specialization:'' }}
        </option>
        @endforeach
        @endif
    </select>
</div>