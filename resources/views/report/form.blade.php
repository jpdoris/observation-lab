@include('shared.alerts')

        @if($id)
        <div class="form-group">
            <div class="row">
                <label for="id" class="col-md-2 col-form-label">ID</label>
                <div class="col-md-10">
                  <input readonly class="form-control-plaintext" type="text" name="id" id="id" value="{{ $id }}"/>
                </div>
            </div>
        </div>
        @endif

        <div class="form-group{{ $errors->has('patient_id') ? ' is-invalid' : '' }} row">
          <label for="patientlist" class="col-md-2 col-form-label">Patient ID</label>
          <div class="col-md-10">
            <input type="text"
                   placeholder="Start typing patient's name here..."
                   autocomplete="name"
                   list="patientlist"
                   class="form-control"
                   name="patient-name"
                   id="patient"
                   value="{{ ('' != old('patient-name') ? old('patient-name') : (isset($report->patient->name) ? $report->patient->name : '')) }}"
            >
            <datalist id="patientlist">
                @foreach($lookups['patients'] as $patient)
                    <option data-value="{{ $patient->id }}" @if($id && ($patient->id == old('patient-hidden') || $patient->id == $report->patient_id)) selected="selected" @endif>{{ $patient->name }}</option>
                @endforeach
            </datalist>
            <input type="hidden" name="patient" id="patient-hidden">
            <input type="hidden" name="patient-exists" id="patient-exists">
          </div>
        </div>


        <div class="form-group{{ $errors->has('animal_type_id') ? ' is-invalid' : '' }} row">
          <label for="animal_type_id" class="col-md-2 col-form-label">Animal Type</label>
          <div class="col-md-10">
            <select class="custom-select" name="animal_type_id" id="animal_type_id">
                <option value="">Select...</option>
                @foreach($lookups['animaltypes'] as $animaltype)
                    <option value="{{ $animaltype->id }}" @if($animaltype->id == old('animal_type_id') || $animaltype->id == $report->animal_type_id) selected="selected" @endif>{{ $animaltype->name }}</option>
                @endforeach
            </select>
          </div>
        </div>

        <div class="form-group{{ $errors->has('animal_type_id') ? ' is-invalid' : '' }} row">
          <label for="animal_subtype_id" class="col-md-2 col-form-label">Animal Subtype</label>
          <div class="col-md-10">
            <select class="custom-select" name="animal_subtype_id" id="animal_subtype_id">
                <option value="">Select...</option>
                  @foreach($lookups['animalsubtypes'] as $animalsubtype)
                    <option value="{{ $animalsubtype->id }}" @if($animalsubtype->id == old('animal_subtype_id') || $animalsubtype->id == $report->animal_subtype_id) selected="selected" @endif>{{ $animalsubtype->name }}</option>
                  @endforeach
            </select>
          </div>
        </div>


        <div class="form-group{{ $errors->has('building_id') ? ' is-invalid' : '' }} row">
          <label for="building_id" class="col-md-2 col-form-label">Building</label>
          <div class="col-md-10">
            <select class="custom-select" name="building_id" id="building_id">
                <option value="">Select...</option>
                  @foreach($lookups['buildings'] as $building)
                    <option value="{{ $building->id }}" @if($building->id == old('building_id') || $building->id == $report->building_id) selected="selected" @endif>{{ $building->name }}</option>
                  @endforeach
            </select>
          </div>
        </div>

        <div class="form-group{{ $errors->has('building_id') ? ' is-invalid' : '' }} row">
          <label for="room_id" class="col-md-2 col-form-label">Room</label>
          <div class="col-md-10">
            <select class="custom-select" name="room_id" id="room_id">
                <option value="">Select...</option>
                  @foreach($lookups['rooms'] as $room)
                    <option value="{{ $room->id }}" @if($room->id == old('room_id') || $room->id == $report->room_id) selected="selected" @endif>{{ $room->name }}</option>
                  @endforeach
            </select>
          </div>
        </div>

        <div class="form-group{{ $errors->has('owner_id') ? ' is-invalid' : '' }} row">
          <label for="owner_id" class="col-md-2 col-form-label">Owner</label>
          <div class="col-md-10">
            <select class="custom-select" name="owner_id" id="owner_id">
                <option value="">Select...</option>
                  @foreach($lookups['owners'] as $owner)
                    <option value="{{ $owner->id }}" @if($owner->id == old('owner_id') || $owner->id == $report->owner_id) selected="selected" @endif>{{ $owner->readableName() }}</option>
                  @endforeach
            </select>
          </div>
        </div>

        <div class="form-group{{ $errors->has('study_id') ? ' is-invalid' : '' }} row">
          <label for="studylist" class="col-md-2 col-form-label">Study ID</label>
          <div class="col-md-10">
            <input type="text"
                   placeholder="Start typing study name here..."
                   autocomplete="name"
                   list="studylist"
                   class="form-control"
                   name="study-name"
                   id="study"
                   value="{{ ('' != old('study-name') ? old('study-name') : (isset($report->study->name) ? $report->study->name : '')) }}"
            >
            <datalist id="studylist">
                @foreach($lookups['studies'] as $study)
                    <option data-value="{{ $study->id }}" @if($id && ($study->id == old('study-hidden') || $study->id == $report->study_id)) selected="selected" @endif>{{ $study->name }}</option>
                @endforeach
            </datalist>
            <input type="hidden" name="study" id="study-hidden">
            <input type="hidden" name="study-exists" id="study-exists">
          </div>
        </div>

        <div class="form-group{{ $errors->has('concern_quality_id') ? ' is-invalid' : '' }} row">
          <label for="concern_quality_id" class="col-md-2 col-form-label">Concern Quality</label>
          <div class="col-md-10">
            <select class="col-md-3 custom-select" name="concern_quality_id" id="concern_quality_id">
                <option value="">Select...</option>
                  @foreach($lookups['concernqualities'] as $quality)
                    <option value="{{ $quality->id }}" @if($quality->id == old('concern_quality_id') || $quality->id == $report->concern_quality_id) selected="selected" @endif>{{ $quality->name }}</option>
                  @endforeach
            </select>
          </div>
        </div>

        <div class="form-group{{ $errors->has('concern_quality_id') ? ' is-invalid' : '' }} row">
          <label for="concern_location_id" class="col-md-2 col-form-label">Concern Location</label>
          <div class="col-md-10">
            <select class="col-md-3 custom-select" name="concern_location_id" id="concern_location_id">
                <option value="">Select...</option>
                  @foreach($lookups['concernlocations'] as $location)
                    <option value="{{ $location->id }}" @if($location->id == old('concern_location_id') || $location->id == $report->concern_location_id) selected="selected" @endif>{{ $location->name }}</option>
                  @endforeach
            </select>
          </div>
        </div>

        <div class="form-group{{ $errors->has('reporter_id') ? ' is-invalid' : '' }} row">
          <label for="reporter_id" class="col-md-2 col-form-label">Reported By</label>
          <div class="col-md-10">
            <select class="col-md-3 custom-select" name="reporter_id" id="reporter_id">
                <option value="">Select...</option>
                  @foreach($lookups['reporters'] as $reporter)
                    <option value="{{ $reporter->id }}" @if($reporter->id == old('reporter_id') || $reporter->id == $report->reporter_id) selected="selected" @endif>{{ $reporter->readableName() }}</option>
                  @endforeach
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label for="date" class="col-md-2 col-form-label">Date</label>
          <div class="col-md-10">
            <input readonly class="form-control-plaintext" type="text" name="date" id="date" value="@if($id) {{ $report->updated_at->format('m/d/Y') }} @else {{ date('m/d/Y') }}@endif" />
          </div>
        </div>

        <div class="form-group row">
            <label for="time" class="col-md-2 col-form-label">Time</label>
            <div class="col-md-10">
              <input readonly class="form-control-plaintext" type="text" name="time" id="time" value="@if($id){{ $report->updated_at->format('g:i A') }} @else {{ date('g:i A') }} @endif"/>
            </div>
        </div>

        <div class="row text-right">
            <div class="col-md-12">
              @if(isset($id))
                @if($report->status->name == 'Reported')
                    <a href="{{action( 'ReviewController@create', ['id' => $id])}}" class="btn btn-primary">Review</a>
                @elseif($report->status->name == 'Reviewed')
                    <a href="{{action('TreatmentController@create', ['id' => $id])}}" class="btn btn-primary">Treatment</a>
                @elseif($report->status->name == 'Treatment')
                    <a href="{{action('CloseoutController@create', ['id' => $id])}}" class="btn btn-primary">Close-out</a>
                @endif
              @endif
                <input type="submit" class="btn btn-primary" value="Save Changes">
                <a href="{{ route('dashboard') }}" class="btn btn-danger">Cancel</a>
            </div>
        </div>
