@if(!empty($rooms))
    <option>Select Room...</option>
    @foreach($rooms as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
    @endforeach
@endif