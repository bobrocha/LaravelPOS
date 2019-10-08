<template>
	<table class="table table-bordered table-sm">
		<thead>
			<tr>
				<th scope="col">Description</th>
				<th scope="col">SKU Number</th>
				<th scope="col">Category</th>
				<th scope="col">Price</th>
			</tr>
			<tr>
				<th scope="col"><input type="text" name="description"></th>
				<th scope="col"><input type="text" name="skunumber"></th>
				<th scope="col">
					<select>
						<option>Meat</option>
						<option>Vegetables</option>
						<option>Fruit</option>
					</select>
				</th>
				<th scope="col"><input type="number" min="0.00" step="0.01" name="price"></th>
			</tr>
		</thead>
	</table>
</template>

<script>
export default {
	name: 'add-product',
	data() {
		return {}
	},
}
</script>

<style>

</style>