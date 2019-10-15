<template>
	<section class="table-container">
		<header>
			<h1>Add Category</h1>
			<button class="btn btn-success" @click="save" :disabled="disable_save">Save</button>
		</header>
		<div class="animation-wrapper" ref="error_msg" >
			<div class="alert alert-danger error" role="alert" v-if="error">
				{{ error }}
			</div>
		</div>
		<table class="table table-bordered table-sm">
			<thead>
				<tr>
					<th scope="col"></th>
					<th scope="col">Title</th>
					<th scope="col"></th>
				</tr>
				<tr>
					<th scope="col"></th>
					<th scope="col" class="edit-col"><input type="text" name="title" v-model.trim="title" @keyup.enter="addRow" :disabled="disable_input"></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(row, index) in rows" :key="row.id">
					<td class="delete-col"><button type="button" class="btn btn-danger" @click="deleteRow(index)" :disabled="disable_input">Delete</button></td>
					<td class="added-item">{{ row.title }}</td>
					<td><button type="button" class="btn btn-secondary" :disabled="disable_input">Edit</button></td>
				</tr>
			</tbody>
		</table>
	</section>
</template>

<script>
export default {
	name: 'add-category',
	data() {
		return {
			title         : null,
			submitted     : false,
			rows          : [],
			error         : null,
			disable_save  : false,
			disable_input : false,
		}
	},
	methods : {
		addRow(title = null) {
			this.$refs.error_msg.classList.add('animation-wrapper');
			this.$refs.error_msg.classList.remove('fade-in');
			this.error = null;

			if(!this.title) {
				this.error = 'You must enter a category.';
				
				this.$refs.error_msg.classList.remove('animation-wrapper');
				this.$refs.error_msg.classList.add('fade-in');

				return;
			}

			this.disable_save = false;

			this.rows.unshift({
				id    : this.rows.length + 1,
				title : this.title,
			});

			this.title = null;
		},
		deleteRow(index = null) {
			this.rows.splice(index, 1);
		},
		save() {
			// Clean up data before sending it to server
			this.rows.forEach(row => {
				delete row.id;
			});

			this.disable_save = true;
			this.disable_input = true;

			axios.post(action_url, {
				rows :{
					...this.rows,
				}
			})
			.then((response) => {
				this.rows          = [];
				this.disable_save  = false;
				this.disable_input = false;

				
			})
			.catch((error) => {
				
			});
		},
	},
	mounted() {
		// Disable save as there are no rows
		this.disable_save = this.rows.length === 0;
	},
	computed : {
	},
}
</script>

<style>
input {
	width : 100%;
}

thead {
	text-align: center;
}

.error {
	text-align: center;
}

.fade-in {
	opacity: 1;
	animation-name: fadeInOpacity;
	animation-iteration-count: 1;
	animation-timing-function: ease-in;
	animation-duration: 1s;

}
@keyframes fadeInOpacity {
	0% {
		opacity: 0;
	}
	100% {
		opacity: 1;
	}
}

.animation-wrapper {
	opacity: 0;
	display: none;
}

.table-container {
	width: 600px;
	margin : 1em auto;
}

.table-container table {
	box-shadow: 0 0 5px 1px #ccc;
}

.table-container header {
	text-align: center;
	margin: 1em  0;
	padding: 1em;
	box-shadow: 0 0 5px 1px #ccc;
}

.table-container .added-item {
	text-align: center;
	vertical-align: middle;
}

.table-container thead tr th:first-child,
.table-container thead tr th:last-child,
.table-container tbody tr td:first-child,
.table-container tbody tr td:last-child {
	width : 80px;
	text-align: center;
}
</style>