<div class="card shadow-sm">

    <div class="card-header bg-primary text-white">

        <h5 class="mb-0">
            <i class="fas fa-user-cog"></i>
            User Information
        </h5>

    </div>

    <div class="card-body">

        <div class="row">

            <!-- Employee No -->

            <div class="col-md-4 mb-3">

                <label class="form-label">
                    Employee No.
                </label>

                <input type="text" name="employee_no" class="form-control"
                    value="{{ old('employee_no', $user->employee_no ?? '') }}" required>

            </div>

            <!-- Name -->

            <div class="col-md-8 mb-3">

                <label class="form-label">
                    Full Name
                </label>

                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}"
                    required>

            </div>

            <!-- Email -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Email Address
                </label>

                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}"
                    required>

            </div>

            <!-- Agency -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Agency
                </label>

                <input type="text" name="agency" class="form-control"
                    value="{{ old('agency', $user->agency ?? 'Philippine Coast Guard') }}">

            </div>

            <!-- Office -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Office
                </label>

                <input type="text" name="office" class="form-control"
                    value="{{ old('office', $user->office ?? '') }}">

            </div>

            <!-- Position -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Position
                </label>

                <input type="text" name="position" class="form-control"
                    value="{{ old('position', $user->position ?? '') }}">

            </div>

            <!-- Country -->

            <div class="col-md-4 mb-3">

                <label class="form-label">
                    Country
                </label>

                <input type="text" name="country" class="form-control"
                    value="{{ old('country', $user->country ?? 'Philippines') }}">

            </div>

            <!-- Role -->

            <div class="col-md-4 mb-3">

                <label class="form-label">
                    Role
                </label>

                <select name="role" class="form-select" required>

                    <option value="">-- Select Role --</option>

                    @foreach (['Administrator', 'MEPCOM', 'Inspector', 'Viewer'] as $role)
                        <option value="{{ $role }}"
                            {{ old('role', $user->role ?? '') == $role ? 'selected' : '' }}>
                            {{ $role }}
                        </option>
                    @endforeach

                </select>

            </div>

            <!-- Status -->

            <div class="col-md-4 mb-3">

                <label class="form-label">
                    Status
                </label>

                <select name="status" class="form-select" required>

                    <option value="Active"
                        {{ old('status', $user->status ?? 'Active') == 'Active' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="Inactive" {{ old('status', $user->status ?? '') == 'Inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>

                </select>

            </div>

            <!-- Password -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Password
                </label>

                <input type="password" name="password" class="form-control" {{ isset($user) ? '' : 'required' }}>

                @isset($user)
                    <small class="text-muted">
                        Leave blank to keep the current password.
                    </small>
                @endisset

            </div>

            <!-- Confirm Password -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Confirm Password
                </label>

                <input type="password" name="password_confirmation" class="form-control"
                    {{ isset($user) ? '' : 'required' }}>

            </div>

        </div>

    </div>

</div>
