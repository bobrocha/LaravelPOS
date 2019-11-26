<template>
	<section class="table-container">
		<header>
			<h1>Add Category</h1>
			<div class="animation-wrapper" ref="error_msg" >
				<div class="alert alert-danger error" role="alert" v-if="error">
					{{ error }}
				</div>
			</div>
			<div class="animation-wrapper" ref="progress_bar" >
				<div class="progress">
					<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%" ></div>
				</div>
			</div>
		</header>
		<table class="table table-bordered table-sm table-striped">
			<thead>
				<tr>
					<th scope="col">Title</th>
					<th scope="col"></th>
				</tr>
				<tr>
					<th scope="col"><input type="text" name="title" ref="title_input" v-model.trim="title" @keyup.enter="addRow" @keydown="error = null" :disabled="disable_input"></th>
					<th class="control">
						<button type="button" class="btn btn-success" @click="addRow" :disabled="disable_input">Add</button>
						<button type="button" class="btn btn-secondary" @click="clear" :disabled="disable_input">Clear</button>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(row, index) in rows" :key="row.index">
					<td v-if="editing_id === row.id"><input type="text"  @keyup.enter="saveEdit(index, row.id)" v-model.trim="updated_title" :disabled="disable_input"></td>
					<td v-else class="added-item">{{ row.title }}</td>

					<td v-if="editing_id === row.id" class="control">
						<button type="button" class="btn btn-success" @click="saveEdit(index, row.id)" :disabled="disable_input">Save</button>
						<button type="button" class="btn btn-danger" @click="cancelEdit" :disabled="disable_input">Cancel</button>
					</td>
					<td v-else class="control">
						<button type="button" class="btn btn-danger" @click="deleteRow(index, row.id)" :disabled="disable_input">Delete</button>
						<button type="button" class="btn btn-secondary" @click="editRow(index, row.id)" :disabled="disable_input">Edit</button>
					</td>
				</tr>
			</tbody>
		</table>
	</section>
</template>

<script>
export default {
	name: 'categories',
	data() {
		return {
			title         : null,
			rows          : [],
			error         : null,
			disable_save  : false,
			disable_input : false,
			editing_id    : null,
			new_row       : null,
			editing       : false,
			updated_title : null,
		}
	},
	methods : {
		addRow(title) {
			this.error = null;

			if(!this.title) {
				this.error = 'You must enter a category.';

				this.showError();

				return;
			}

			this.fadeInProgressbar();
			this.disableInput();

			axios.post(`${controller_url}/create/${this.title}`)
			.then((response) => {
				if(response.data.error) {
					this.error = response.data.error;

					this.showError();

					return;
				}
				this.new_row = response.data
				this.rows.unshift(this.new_row);

				this.new_row = null;
			})
			.catch(error => {
				console.log(error);
			})
			.finally(() => {
				this.title = null;
				this.fadeOutrogressbar();
				this.enableInput();

				this.$nextTick(() => {
					this.$refs.title_input.focus();
				});
			});

		},
		deleteRow(index, id) {
			this.rows.splice(index, 1);

			this.fadeInProgressbar();
			this.disableInput();

			axios.post(`${controller_url}/destroy/${id}`)
			.then(response => {})
			.catch(error => {})
			.finally(() => {
				this.fadeOutrogressbar();
				this.enableInput();
			});
		},
		editRow(index, id){
			this.editing_id    = id;
			this.updated_title = this.rows[index].title;
		},
		cancelEdit() {
			this.editing_id = null;
		},
		saveEdit(index, id) {
			this.fadeInProgressbar();
			this.disableInput();

			axios.post(`${controller_url}/update/${id}/${this.updated_title}`)
			.then(response => {
				if(response.data.error) {
					this.error = response.data.error;

					this.showError();

					return;
				}

				this.editing_id = null;
				this.updated_title = null;

				this.rows[index].title = response.data.title;
			})
			.catch(error => console.log(error))
			.finally(() => {
				this.fadeOutrogressbar();
				this.enableInput();
			});

		},
		clear() {
			this.title = null;
		},
		disableSave() {
			this.disable_save = true;
		},
		enableSave() {
			this.disable_save = false;
		},
		disableInput() {
			this.disable_input = true;
		},
		enableInput() {
			this.disable_input = false;
		},
		showError() {
			this.$refs.error_msg.classList.remove('animation-wrapper');
			this.$refs.error_msg.classList.add('fade-in');
		},
		getRows() {
			this.fadeInProgressbar();
			this.disableInput();

			axios.get(`${controller_url}/get`)
			.then((response) => {
				this.rows = response.data;
			})
			.catch((error) => {
				console.log(error);
			})
			.finally(() => {
				this.fadeOutrogressbar();
				this.enableInput();

				this.$nextTick(() => {
					this.$refs.title_input.focus();
				});
			});
		},
		fadeInProgressbar() {
			this.$refs.progress_bar.classList.remove('animation-wrapper');
			this.$refs.progress_bar.classList.add('fade-in');
		},
		fadeOutrogressbar() {
			this.$refs.progress_bar.classList.add('animation-wrapper');
			this.$refs.progress_bar.classList.remove('fade-in');
		}
	},
	mounted() {
		this.getRows();
	},
	computed : {
	},
}
</script>

<style>
.table-container .error {
	text-align: center;
}

.fade-in {
	opacity: 1;
	animation-name: fadeInOpacity;
	animation-iteration-count: 1;
	animation-timing-function: ease-in;
	animation-duration: 0.5s;

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
	box-shadow: 0 0 5px 1px #ccc;
}

.table-container thead {
	text-align: center;
}

.table-container input {
	width : 100%;
}

.table-container header {
	text-align: center;
	padding: 1em;
}

.table-container .added-item {
	text-align: center;
	vertical-align: middle;
}

.table-container th,
.table-container td {
	vertical-align: middle;
	padding: 0.5em;
}

.table-container .control {
	width: 10%;
	white-space: nowrap;
	text-align: center;
}
</style>