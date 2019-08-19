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
                <label for="treatment" class="col-md-4 control-label">Treatment</label>
                <textarea class="form-control col-md-6" name="treatment" id="treatment" rows="4">{{ ('' != old('treatment') ? old('treatment') : (isset($treatment->treatment) ? $treatment->treatment : '')) }}</textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <label for="treated_by" class="col-md-4 control-label">Treated By</label>
                <!--input type="text" class="col-md-6" name="treated_by" id="treated_by" value="{{ ('' != old('treated_by') ? old('treated_by') : (isset($treatment->treated_by) ? $treatment->treated_by : '')) }}" /-->
                <select class="custom-select col-md-6" name="treated_by" id="treated_by">
                    <option value="">Select...</option>
                    @foreach($healthtechs as $healthtech)
                        <option value="{{ $healthtech['id'] }}" @if (isset($id) && ($healthtech['id'] == old('treated_by') || $healthtech['id'] == $treatment->$healthtech)) selected="selected"@elseif ($healthtech->id == Auth::User()->id) selected="selected" @endif>{{ $healthtech->readableName() }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <label for="date" class="col-md-4 control-label">Date</label>
                <input class="form-control col-md-6" type="text" name="date" id="date" value="@if(isset($id)) {{ $treatment->updated_at->format('m/d/Y') }} @else {{ date('m/d/Y') }}@endif" readonly />
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <label for="time" class="col-md-4 control-label">Time</label>
                <input class="form-control col-md-6" type="text" name="time" id="time" value="@if(isset($id)) {{ $treatment->updated_at->format(':i:s A') }} @else {{ date('g:i:s A') }}@endif" readonly />
            </div>
        </div>

        <input type="hidden" name="report_id" value="{{ $report_id }}">
        <div class="row text-center">
            <div class="col-md-12">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="{{ route('dashboard') }}" class="btn btn-danger">Cancel</a>
            </div>
        </div>