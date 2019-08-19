@include('shared.alerts')
        @if(isset($id))
            <div class="form-group">
                <div class="row">
                    <label for="id" class="col-md-4 control-label">ID</label>
                    <input type="text" name="id" id="id" value="{{ $id }}" disabled="disabled" />
                </div>
            </div>
        @endif

        <div class="form-group">
            <div class="row">
                <label for="comments" class="col-md-4 control-label">Comments</label>
                <textarea class="form-control col-md-6" name="comments" id="comments" rows="4">{{ ('' != old('comments') ? old('comments') : (isset($closeout->comments) ? $closeout->comments : '')) }}</textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <label for="closed_by" class="col-md-4 control-label">Closed By</label>
                <select class="custom-select col-md-6" name="closed_by" id="closed_by">
                    <option value="">Select...</option>
                    @foreach($closers as $closer)
                        <option value="{{ $closer['id'] }}" @if (isset($id) && ($closer['id'] == old('closed_by') || $closer['id'] == $closeout->$closer)) selected="selected"@elseif ($closer->id == Auth::User()->id) selected="selected" @endif>{{ $closer->readableName() }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <label for="date" class="col-md-4 control-label">Date</label>
                <input class="form-control col-md-6" type="text" name="date" id="date" value="@if(isset($id)) {{ $closeout->updated_at->format('m/d/Y') }} @else {{ date('m/d/Y') }}@endif" readonly />
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <label for="time" class="col-md-4 control-label">Time</label>
                <input class="form-control col-md-6" type="text" name="time" id="time" value="@if(isset($id)){{ $closeout->updated_at->format(':i:s A') }} @else {{ date('g:i:s A') }}@endif" readonly />
            </div>
        </div>

        <input type="hidden" name="report_id" value="{{ $report_id }}">
        <div class="row text-center">
            <div class="col-md-12">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="{{ route('dashboard') }}" class="btn btn-danger">Cancel</a>
            </div>
        </div>