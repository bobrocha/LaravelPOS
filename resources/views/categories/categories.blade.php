@extends('layouts.main_layout')

@section('title', 'Inventory Categories')

@section('app')
<categories></categories>
@endsection

@section('scripts')
<script>
	const controller_url = '{!! route('inventory_categories') !!}';
</script>
@endsection