@extends('layouts.main_layout')

@section('title', 'Add Category')

@section('app')
<add-category></add-category>
@endsection

@section('scripts')
<script>
	const action_url = '{!! action('Inventory\Categories\CategoriesController@create') !!}';
</script>
@endsection