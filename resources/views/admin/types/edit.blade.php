@extends('layouts.app')

@section('title', 'Projects.edit')

{{-- @section('cdn')
Bootstrap Icons
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
@endsection --}}

@section('content')

<h1 class="my-3 text-success">Edit details of project n° {{ $project->id }}:</h1>

<form 
action="{{ route('admin.projects.update', $project) }}" 
enctype="multipart/form-data" 
method="POST" 
class="row gy-3">
  @csrf
  @method('PUT')

  {{-- TITLE --}}
<div class="col-6">
  <label for="title" class="form-label">Title</label>
  <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" 
  value="{{ old('title') ?? $project->title }}">
  @error('title')
  <div class="invalid-feedback">
    {{ $message }}
  </div>
  @enderror

  {{-- SELECT TYPE --}}

  <label for="type_id" class="form-label">Stack</label>
  <select class="form-select @error('type_id') is-invalid @enderror" id="type_id" name="type_id">
    <option value="">Nessuna tipologia</option>
    @foreach($types as $type)
    <option @if(old('type_id', $project->type_id) == $type->id) selected @endif value="{{ $type->id }}">{{ $type->label }}</option>
    @endforeach
    {{-- prova errore --}}
    {{-- <option value="10">Prova errore</option> --}}
  </select>
  @error('type_id')
  <div class="invalid-feedback">
    {{ $message }}
  </div>
  @enderror

  {{-- DATE --}}

  <label for="date" class="form-label">Date</label>
  <input type="text" class="form-control @error('date') is-invalid @enderror" id="date" name="date" 
  value="{{ old('date') ?? $project->date}}">
  @error('date')
  <div class="invalid-feedback">
    {{ $message }}
  </div>
  @enderror

  {{-- DESCRIPTION --}}

  <label for="description" class="form-label">Description</label>
  <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" 
  value="{{ old('description') ?? $project->description }}">
  @error('description')
  <div class="invalid-feedback">
    {{ $message }}
  </div>
  @enderror

  {{-- LINK --}}

  <label for="link" class="form-label">Link</label>
  <input type="file" class="form-control @error('link') is-invalid @enderror" id="link" name="link"  
  value="{{ old('link') ?? $project->link }}">
  @error('link')
  <div class="invalid-feedback">
    {{ $message }}
  </div>
  @enderror
</div>

{{-- MUTATOR VERSION FOR WHEN IS WORKING --}}
    {{-- $value ? asset('storage/' . $value) : 'https://www.frosinonecalcio.com/wp-content/uploads/bfi_thumb/default-placeholder-38gbdutk2nbrubtodg93tqlizprlhjpd1i4m8gzrsct8ss250.png' --}}
    
<div class="col-6">
  <img src="{{ $project->link ? asset('storage/' . $project->link) : 'https://www.frosinonecalcio.com/wp-content/uploads/bfi_thumb/default-placeholder-38gbdutk2nbrubtodg93tqlizprlhjpd1i4m8gzrsct8ss250.png' }}" alt="" class="img-fluid">
</div>

<div class="col-12 d-flex">
  <button type="submit" class="btn btn-outline-success ms-auto">Save</button>
</div>

</form>
@endsection