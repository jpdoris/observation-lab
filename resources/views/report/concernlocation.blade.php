@if(count($locations))
    <option value="">Select Concern Location...</option>
    @foreach($locations as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
    @endforeach
@endif