<template>
	
	<modal-layouts name="editRecord" id="editRecord">
		
		<template slot="heading">Edit Record</template>

		<template slot="main">

			<div class="form-group">
				<label for="name">Name</label>

				<input type="text" 
					   name="name" 
					   id="name" 
					   class="form-control" 
					   v-model="editRec.name"
					   @keydown="delete errors.name">

				<span v-if="errors.name" class="text-danger">
					<small v-text="errors.name[0]"></small>
				</span>
			</div>

			<div class="form-group">
				<label for="email">E-Mail</label>

				<input type="email" 
					   name="email" 
					   id="email" 
					   class="form-control" 
					   v-model="editRec.email"
					   @keydown="delete errors.email"
					   >

				<span v-if="errors.email" class="text-danger">
					<small v-text="errors.email[0]"></small>
				</span>
			</div>

			<div class="form-group">
				<label for="phone">Phone</label>

				<input type="text" 
					   name="phone" 
					   id="phone" 
					   class="form-control" 
					   v-model="editRec.phone"
					   @keydown="delete errors.phone">

				<span v-if="errors.phone" class="text-danger">
					<small v-text="errors.phone[0]"></small>
				</span>
			</div>
			<div class="form-group">
				<label for="file">img</label>

				<input type="file" 
					   name="file" 
					   id="file" 
					   class="form-control" 
                       v-on:change="onChange"
					   >
			<img v-bind:src="editRec.parth"  width="100px" />
				<span v-if="errors.file" class="text-danger">
					<small v-text="errors.file[0]"></small>
				</span>
			</div>
		</template>

		<template slot="footer">
			<button type="button" 
					class="btn btn-outline-secondary" 
					@click="clearModal" 
					data-dismiss="modal">Close</button>

			<button type="submit" 
					class="btn btn-outline-primary" 
					@click="updateRecord">Save Changes</button>
		</template>

	</modal-layouts>

</template>


<script>
import ModalLayouts from '../partials/ModalLayouts'

export default ({
    setup() {
        
    },
    components:{
        ModalLayouts
    },
    props:
		['editRec']
		// editRec:new Form({
		// 	name:this.editRec.name,
		// 	email:this.editRec.email,
		// 	phone:this.editRec.phone,
		// 	phone:this.editRec.phone,
			
		// })
	
		
	,

		data() {
			return {
				errors: [],
				
			}
		},
    methods: {
		onChange(e) {
			
                
				this.editRec.file = e.target.files[0];
                
            },
			updateRecord() {
				 let config = { headers: { 'Content-Type': 'multipart/form-data' } }
				 let data = new FormData();
				data.append('file', this.editRec.file);
				data.append('phone', this.editRec.phone);
				data.append('email', this.editRec.email);
				data.append('name', this.editRec.name);
				axios.post(`pagess/${this.editRec.id}`,data,config)  
					.then(response => {
						this.$emit('recordUpdated', response);
						$('#editRecord').modal('hide');
					})
					.catch(error => this.errors = error.response.data.errors)
                    console.log(this.errors)
			},

			clearModal() {
				this.errors = [];
			}
		}
})
</script>

