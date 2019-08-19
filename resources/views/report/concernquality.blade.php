@if(!empty($qualities))
    <option value="">Select Concern Quality...</option>
    @foreach($qualities as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
    @endforeach
@endif