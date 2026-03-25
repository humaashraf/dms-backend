@extends('layouts.admin')

@section('content')
@section('title', 'General Settings')

<div class="container mt-4">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">General Settings</h5>
        </div>

        <div class="card-body">
                <form action="{{ url('general-settings/update/' . $setting->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">App Name</label>
                    <input type="text" name="app_name" value="{{ old('app_name', $setting->app_name) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Timezone</label>
                    <select name="timezone" class="form-control" required>
                        <option disabled selected>Select TimeZone</option>

                        <option value="UTC" {{ old('timezone', $setting->timezone) == 'UTC' ? 'selected' : '' }}>(UTC+00:00) UTC</option>
                        <option value="Asia/Karachi" {{ old('timezone', $setting->timezone) == 'Asia/Karachi' ? 'selected' : '' }}>(UTC+05:00) Islamabad, Karachi</option>
                        <option value="Asia/Dubai" {{ old('timezone', $setting->timezone) == 'Asia/Dubai' ? 'selected' : '' }}>(UTC+04:00) Abu Dhabi, Dubai</option>
                        <option value="Asia/Kolkata" {{ old('timezone', $setting->timezone) == 'Asia/Kolkata' ? 'selected' : '' }}>(UTC+05:30) Mumbai, Kolkata</option>
                        <option value="Asia/Riyadh" {{ old('timezone', $setting->timezone) == 'Asia/Riyadh' ? 'selected' : '' }}>(UTC+03:00) Riyadh</option>
                        <option value="Europe/London" {{ old('timezone', $setting->timezone) == 'Europe/London' ? 'selected' : '' }}>(UTC+00:00) London</option>
                        <option value="Europe/Berlin" {{ old('timezone', $setting->timezone) == 'Europe/Berlin' ? 'selected' : '' }}>(UTC+01:00) Berlin</option>
                        <option value="America/New_York" {{ old('timezone', $setting->timezone) == 'America/New_York' ? 'selected' : '' }}>(UTC-05:00) New York</option>
                        <option value="America/Chicago" {{ old('timezone', $setting->timezone) == 'America/Chicago' ? 'selected' : '' }}>(UTC-06:00) Chicago</option>
                        <option value="America/Denver" {{ old('timezone', $setting->timezone) == 'America/Denver' ? 'selected' : '' }}>(UTC-07:00) Denver</option>
                        <option value="America/Los_Angeles" {{ old('timezone', $setting->timezone) == 'America/Los_Angeles' ? 'selected' : '' }}>(UTC-08:00) Los Angeles</option>
                        <option value="Pacific/Honolulu" {{ old('timezone', $setting->timezone) == 'Pacific/Honolulu' ? 'selected' : '' }}>(UTC-10:00) Honolulu</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Currency</label>
                    <select name="currency_id" class="form-control">
                        <option value="">Select Currency</option>
                        @foreach($currencies as $currency)
                            <option value="{{ $currency->id }}" {{ old('currency_id', $setting->currency_id) == $currency->id ? 'selected' : '' }}>
                                {{ $currency->name }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="mb-3">
                    <label class="form-label">Date & Time Format</label>
                    {{-- <input type="text" name="datetime_format" value="{{ old('datetime_format', $setting->datetime_format) }}" class="form-control" required> --}}
                <select name="datetime_format" class="form-control" required>
                    <option disabled selected>Select Time Format</option>

                    {{-- 12hr Format --}}
                    <option disabled class="text-muted">12hr format</option>
                    <option value="d/m/Y h:i A" {{ old('datetime_format', $setting->datetime_format) == 'd/m/Y h:i A' ? 'selected' : '' }}>
                        24/06/2025 12:06 PM
                    </option>
                    <option value="d-m-Y h:i A" {{ old('datetime_format', $setting->datetime_format) == 'd-m-Y h:i A' ? 'selected' : '' }}>
                        24-06-2025 12:06 PM
                    </option>
                    <option value="m-d-Y h:i A" {{ old('datetime_format', $setting->datetime_format) == 'm-d-Y h:i A' ? 'selected' : '' }}>
                        06-24-2025 12:06 PM
                    </option>
                    <option value="Y/m/d h:i A" {{ old('datetime_format', $setting->datetime_format) == 'Y/m/d h:i A' ? 'selected' : '' }}>
                        2025/06/24 12:06 PM
                    </option>
                    <option value="Y-m-d h:i A" {{ old('datetime_format', $setting->datetime_format) == 'Y-m-d h:i A' ? 'selected' : '' }}>
                        2025-06-24 12:06 PM
                    </option>

                    {{-- 24hr Format --}}
                    <option disabled class="text-muted">24hr format</option>
                    <option value="d/m/Y H:i" {{ old('datetime_format', $setting->datetime_format) == 'd/m/Y H:i' ? 'selected' : '' }}>
                        24/06/2025 12:06
                    </option>
                    <option value="d-m-Y H:i" {{ old('datetime_format', $setting->datetime_format) == 'd-m-Y H:i' ? 'selected' : '' }}>
                        24-06-2025 12:06
                    </option>
                    <option value="m-d-Y H:i" {{ old('datetime_format', $setting->datetime_format) == 'm-d-Y H:i' ? 'selected' : '' }}>
                        06-24-2025 12:06
                    </option>
                    <option value="Y/m/d H:i" {{ old('datetime_format', $setting->datetime_format) == 'Y/m/d H:i' ? 'selected' : '' }}>
                        2025/06/24 12:06
                    </option>
                    <option value="Y-m-d H:i" {{ old('datetime_format', $setting->datetime_format) == 'Y-m-d H:i' ? 'selected' : '' }}>
                        2025-06-24 12:06
                    </option>
                </select>


                </div>


                <button type="submit" class="btn btn-danger">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
