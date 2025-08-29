<!-- resources/views/doctors/_form.blade.php -->
<form method="POST" action="{{ $formAction }}" enctype="multipart/form-data">
  @csrf
  @isset($method) 
    @method($method)   <!-- e.g., 'PUT' for update -->
  @endisset

  <!-- Name Field -->
  <div class="form-group">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="{{ old('name', $doctor->name ?? '') }}" required>
  </div>

  <!-- Gender Field -->
  <div class="form-group">
    <label for="gender">Gender:</label>
    <input type="text" id="gender" name="gender" value="{{ old('gender', $doctor->gender ?? '') }}">
    <!-- Alternatively, could be a select: e.g., Male/Female -->
  </div>

  <!-- Address Field -->
  <div class="form-group">
    <label for="address">Address:</label>
    <textarea id="address" name="address">{{ old('address', $doctor->address ?? '') }}</textarea>
  </div>

  <!-- Country Field -->
  <div class="form-group">
    <label for="country">Country:</label>
    <input type="text" id="country" name="country" value="{{ old('country', $doctor->country ?? '') }}">
  </div>

  <!-- Role Field -->
  <div class="form-group">
    <label for="role">Role:</label>
    <input type="text" id="role" name="role" value="{{ old('role', $doctor->role ?? '') }}">
  </div>

  <!-- Image Field -->
  <div class="form-group">
    <label for="image">Profile Image:</label>
    <input type="file" id="image" name="image">
    @isset($doctor->image)
      <p>Current image: <em>{{ $doctor->image }}</em></p>
    @endisset
  </div>

  <!-- Submit Button -->
  <button type="submit" class="btn btn-primary">Save</button>
</form>
