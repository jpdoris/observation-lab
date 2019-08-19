@if(!empty($subtypes))
    <option value="">Select Animal Subtype...</option>
    @foreach($subtypes as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
    @endforeach
@endif