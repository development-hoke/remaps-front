@php
    $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']
@endphp
<div class="row">
    <div class="col-md-6 col-xs-12">
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-radio" type="radio" name="notify_check" value="0" @if($company->notify_check == 0) checked @endif>
                <label class="form-check-label">Allow file services when closed</label>
            </div>
            <div class="form-check">
                <input class="form-check-radio" type="radio" name="notify_check" value="1" @if($company->notify_check == 1) checked @endif>
                <label class="form-check-label">No file services when closed</label>
            </div>
        </div>
        @foreach ($days as $day)
        @php
            $daymark_from = substr($day, 0, 3).'_from';
            $daymark_to = substr($day, 0, 3).'_to';
        @endphp
        <div class="form-group">
            <label>{{ ucfirst($day) }}</label>
            <div style="display: flex; align-items: center">
                <input type="time" name="{{ $daymark_from }}" class="form-control" value="{{ $company->$daymark_from }}">
                <span style="margin: 10px">~</span>
                <input type="time" name="{{ $daymark_to }}" class="form-control" value="{{ $company->$daymark_to }}">
            </div>
        </div>
        @endforeach
    </div>
</div>
