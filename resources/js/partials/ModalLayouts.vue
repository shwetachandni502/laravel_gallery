<template>
	
	<div class="modal fade"  
		 :id="name" 
		 tabindex="-1" 
		 role="dialog" 
		 aria-labelledby="exampleModalLabel" 
		 aria-hidden="true"
		 >
		 
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">
						<slot name="heading"></slot>
					</h5>
				</div>

				<div class="modal-body">
					<slot name="main"></slot>
				</div>

				<div class="modal-footer">
					<slot name="footer"></slot>
				</div>
			</div>
		</div>
	</div>

</template>

<script>
	export default {
		props: {
			name: {
				type: String,
				required: true
			}
		},
	};
</script>
<style scoped>
@media (min-width: 576px){
.modal-dialog {
    max-width: 670px  !important;
}
}
</style>