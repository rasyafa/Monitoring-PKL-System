@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Assign Mentor to Siswa</h2>

    <!-- Menampilkan pesan sukses jika ada -->
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.assignMentor', $students->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="mentor_id">Pilih Mentor</label>
            <select class="form-control" id="mentor_id" name="mentor_id">
                @foreach ($mentors as $mentor)
                <option value="{{ $mentor->id }}" {{ old('mentor_id', $students->mentor_id) == $mentor->id ? 'selected' :
                    '' }}>
                    {{ $mentor->name }}
                </option>
                @endforeach
            </select>
            @error('mentor_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Assign Mentor</button>
    </form>
</div>
@endsection
