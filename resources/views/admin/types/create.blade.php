@extends('layouts.app')

@section('title', 'Create a new Project to show:')

@section('content')
  <h1 class="my-3">Insert details :</h1>
<form 
action="{{ route('admin.projects.store') }}" 
enctype="multipart/form-data" 
method="POST" class="row gy-3">

@csrf

{{-- TITLE --}}
<label for="type_id" class="form-label">Stack</label>
  <select class="form-select @error('type_id') is-invalid @enderror" id="type_id" name="type_id" >
    <option value="">Default</option>
    @foreach($types as $type)
    <option @if(old('type_id') == $type->id) @endif value="{{ $type->id }}">{{ $type->label }}</option>
    
    @endforeach
    {{-- prova errore --}}
    {{-- <option value="10">Prova errore</option> --}}
  </select>
  @error('type_id')
  <div class="invalid-feedback">
    {{ $message }}
  </div>
  @enderror

  {{-- SELECT TYPE --}}
  
  <label for="type_id" class="form-label">Color</label>
  <input type="color" >
  
  @error('type_id')
  <div class="invalid-feedback">
    {{ $message }}
  </div>
  @enderror

  {{-- DATE --}}

  {{-- <label for="date" class="form-label">Date</label>
  <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date') }}">
  @error('date')
  <div class="invalid-feedback">
    {{ $message }}
  </div>
  @enderror --}}

  {{-- DESCRIPTION --}}

  {{-- <label for="description" class="form-label">Description</label>
  <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description') }}">
  @error('description')
  <div class="invalid-feedback">
    {{ $message }}
  </div>
  @enderror --}}

  {{-- LINK --}}

  {{-- <label for="link" class="form-label">Link</label>
  <input type="file" class="form-control @error('link') is-invalid @enderror" id="link" name="link"  value="{{ old('link') }}">
  @error('link')
  <div class="invalid-feedback">
    {{ $message }}
  </div>
  @enderror
</div> --}}

{{-- MUTATOR VERSION FOR WHEN IS WORKING --}}
{{-- <div class="col-2">
  <img src="{{ $project->link }}" alt="" class="img-fluid">
</div> --}}

  {{-- <div class="col-6 mt-5">
    <img src="{{ $project->link ? asset('storage/' . $project->link) : 'https://www.frosinonecalcio.com/wp-content/uploads/bfi_thumb/default-placeholder-38gbdutk2nbrubtodg93tqlizprlhjpd1i4m8gzrsct8ss250.png' }}" alt="" class="img-fluid">
  </div> --}}

<div class="col-12 d-flex">
  <button type="submit" class="btn btn-outline-success ms-auto">Save</button>
</div>



</form>
@endsection