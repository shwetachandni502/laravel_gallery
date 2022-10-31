<template>
	
	<modal-layouts name="addRecords" id="addRecords" @keydown.esc="clearModal" @click.left="clearModal">
		
		<template slot="heading">Update Profile</template>

		<template slot="main" class="py-3">

			<div class="form-group">
				<label for="name">Name</label>

				<input type="text" 
					   name="name" 
					   id="name" 
					   class="form-control" 
					   v-model="record.name"
					   @keydown="delete errors.name">

				<!-- <span v-if="errors.name" class="text-danger">
					<small v-text="errors.name[0]"></small>
				</span> -->
			</div>

			<div class="form-group">
				<label for="email">E-Mail</label>

				<input type="email" 
					   name="email" 
					   id="email" 
					   class="form-control" 
                       :disabled="disabled"
					   v-model="record.email" 
					   @keydown="delete errors.email">

				<!-- <span v-if="errors.email" class="text-danger">
					<small v-text="errors.email[0]"></small>
				</span> -->
			</div>

			<div class="form-group">
				<label for="phone">Phone</label>

				<input type="text" 
					   name="phone" 
					   id="phone" 
					   class="form-control" 
					   v-model="record.phone"
					   @keydown="delete errors.phone">

				<!-- <span v-if="errors.phone" class="text-danger">
					<small v-text="errors.phone[0]"></small>
				</span> -->
			</div>
            <div class=" row">
            <div class="form-group col-6">
				<label for="DOB">DOB</label>

				<input type="date" 
					   name="DOB" 
					   id="DOB" 
					   class="form-control" 
					   v-model="record.DOB"
					   @keydown="delete errors.DOB">

				<!-- <span v-if="errors.DOB" class="text-danger">
					<small v-text="errors.DOB[0]"></small>
				</span> -->
			</div>
           
              <div class="form-group col-6">
				<label for="country">country</label>

				<input type="text" 
					   name="country" 
					   id="country" 
					   class="form-control" 
					   v-model="record.country"
					   @keydown="delete errors.country">

				<!-- <span v-if="errors.country" class="text-danger">
					<small v-text="errors.country[0]"></small>
				</span> -->
			</div>
           
  
            
            <div class="form-group col-6">
				<label for="city">city</label>

				<input type="text" 
					   name="city" 
					   id="city" 
					   class="form-control" 
					   v-model="record.city"
					   @keydown="delete errors.city">

				<!-- <span v-if="errors.city" class="text-danger">
					<small v-text="errors.city[0]"></small>
				</span> -->
			</div>
             <div class="form-group col-6">
				<label for="state">state</label>

				<input type="text" 
					   name="state" 
					   id="state" 
					   class="form-control" 
					   v-model="record.state"
					   @keydown="delete errors.state">

				<!-- <span v-if="errors.state" class="text-danger">
					<small v-text="errors.state[0]"></small>
				</span> -->
			</div>
           
    </div>
         <div class="row pl-3" >
             <label class="pr-5" >gender</label>
            <div class="form-check pr-5">
            <input value="Female" class="form-check-input" type="radio" name="gender" v-model="record.gender" id="flexRadioDefault1">
            <label class="form-check-label" for="flexRadioDefault1">
               Female
            </label>
            </div>
            <div class="form-check ">
            <input value="meal" class="form-check-input" type="radio" name="gender" v-model="record.gender" id="flexRadioDefault2" checked>
            <label class="form-check-label" for="flexRadioDefault2">
                Male
            </label>
            </div>
            <!-- <span v-if="errors.gender" class="text-danger">
					<small v-text="errors.gender[0]"></small>
			</span> -->
        </div>
            <div class="form-group">
				<label for="file">img</label>

				<input type="file" 
					   name="file" 
					   id="file" 
					   class="form-control" 
                       v-on:change="onChange"
					   >

				<!-- <span v-if="errors.file" class="text-danger">
					<small v-text="errors.file[0]"></small>
				</span> -->
			</div>
            <!-- <span v-if="errors.dataerorr" class="text-danger">
					<small v-text="errors.dataerorr"></small>
				</span> -->
            
		</template>

		<template slot="footer">
			<button type="button" 
					class="btn btn-outline-secondary" 
					@click="clearModal" 
					data-dismiss="modal">Close</button>

			<button type="submit" class="btn btn-outline-primary" @click="saveRecord">Save</button>
		</template>

	</modal-layouts>

</template>

<script>
	import ModalLayouts from '../partials/ModalLayouts'

	export default {
		data() {
			return {
				record: {},
				errors: [],
                file:'',
                claims:'',
                claims1:'',
                disabled:true,
                formdata:'',
                data:'',
                mydata:''
			}
		},

		components: { ModalLayouts },

		methods: {
            getsingledata(){
                const sata=""
            axios.get(`/getsingledata/${this.claims.id}`)
            .then(data => {
                   sata =  data.data.data
            })
            .catch(error => this.errors = error.response.data.errors)
            console.log(sata)
            return this.sata
            },
            onChange(e) {
                this.record.file = e.target.files[0];
                
            },
            
			saveRecord() {
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }
				let data = new FormData();
				data.append('file', this.record.file);
				data.append('phone', this.record.phone);
				data.append('email', this.record.email);
				data.append('name', this.record.name);
				data.append('city', this.record.city);
				data.append('gender', this.record.gender);
				data.append('DOB', this.record.DOB);
				data.append('state', this.record.state);
				data.append('country', this.record.country);
                // console.log(data,"ygfdf")
                 
        this.$store
        .dispatch('profile', {
                    data
        },config)
        .then(() => {
          
          $('#addRecords').modal('hide');
           
        this.data=this.getsingledata()
         console.log(this.getsingledata(),"datassss")
        //   this.$router.push({ name: 'Profile' });
          this.$emit('recordAdded', this.data);
        })
        .catch(error => this.errors = error.response,)
        const userInfo1 = localStorage.getItem('profile')
           if (userInfo1) {
            const userData1 = JSON.parse(userInfo1)
            this.$store.commit('setUserProfile', userData1)
           }
				// axios.post('/profile', data,config)
				// 	.then(data => {
				// 		this.$emit('recordAdded', data);

				// 		this.record = {};
				// 		$('#addRecords').modal('hide');
				// 	})
				// 	.catch(error => this.errors = error.response.data.errors)
			},

			clearModal() {
				this.errors = [];
				this.record = {};
			}
            
		},
        created () { 
    //   this.setup()
        const userInfo = localStorage.getItem('user')
        if (userInfo) {
        const userData = JSON.parse(userInfo)
        this.claims=userData.data;
        console.log(this.claims)
        this.record.email=this.claims.email;
        this.record.name=this.claims.name;
         this.record.city=this.claims.city;
        this.record.state=this.claims.state;
        this.record.DOB=this.claims.DOB;
        this.record.country=this.claims.country;
        this.record.gender=this.claims.gender;
        this.record.phone=this.claims.phone;
        }

         const userprofile = localStorage.getItem('profile')
    if (userprofile) {
        const userData = JSON.parse(userInfo)
        this.claims1=userData.data;
        console.log(this.claims1,"profile")
         this.record.city=this.claims.city;
        this.record.state=this.claims.state;
        this.record.DOB=this.claims.DOB;
        this.record.country=this.claims.country;
        this.record.gender=this.claims.gender;
        this.record.phone=this.claims.phone;
        }
    },
	};
</script>
