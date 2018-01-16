<template>
	<v-app id="inspire">
		<v-form v-model="valid" ref="form" lazy-validation>
	      	<v-card flat>
	        	<v-card-text>
	        		<v-container grid-list-md offset-s3>
	          			<v-layout wrap>
	          				<v-flex v-for="input in formItems" :key="input.key" :class="input.class">
		      					<div v-if="input.type=='select'">
									<v-select :label="input.key"  :rules="formRules[input.key]" v-model="input.Value" :items="input.items" required></v-select>
		      					</div>
		      					<div v-if="input.type=='image'">
									<input type="file" id="fileInput"  style="display:none" ref="fileInput" accept="image/*" @change="onFilePicked">
									<v-layout align-center justify-center >
										<div>
											<v-badge color="indigo" v-if="imageUrl">
												<span slot="badge" style="cursor:pointer;" @click="clearImage">
													x
												</span>
											</v-badge>
											<label for="fileInput">
												<img  :src="imageUrl" height="100" style="height:100px; max-width: 300px; cursor:pointer; margin-top: -30px;" @click="onPickFile">
											
												<div v-if="!imageUrl" height="100" style="height:100px; max-width: 300px; cursor:pointer; margin-top: -30px;">
													<v-alert outline color="info" :value="true" @click="onPickFile">{{ btnText }}
													</v-alert>
												</div>
											</label>
										</div>
									</v-layout>
								</div>
								<div v-else-if="input.type=='password'">
									<v-text-field  label="Confirm Password" v-model="input.Value" name="confirmpassword" :rules="formRules[input.key]" required :append-icon="e1 ? 'visibility' : 'visibility_off'" :append-icon-cb="() => (e1 = !e1)" :type="e1 ? 'password' : 'text'"></v-text-field>
								</div>
		      					<div v-else>
									<v-text-field :label="input.key" :rules='formRules[input.key]' v-model="input.value" :counter="input.count" required></v-text-field>
		      					</div>
		      				</v-flex>
					    </v-layout>
					</v-container>
	        	</v-card-text>
	      	</v-card>
	    </v-form>
	</v-app>
</template>
<script>
	import Flash from '../../../../../helper/flash'
	import axios from 'axios'
	import breadcrumb3button from '../breadcrumb/breadcrumb3button.vue'
	export default{
		props:[
			'formItems',
			'formRules'
		],
		data(){
			return{
				e1:true,
				count:0,
				valid:true,
				btnImageDisabled:false,
				btnText:'Upload Image',
				imageUrl:'',
				image:null,
			}
		},
		methods:{
			onPickFile() {
				

		    	this.btnImageDisabled=true
		    	this.btnText="Uploading..."
		        
		    },
		    onFilePicked(event){
		    	
		    	this.image=this.imageUrl
		    	const files=event.target.files
		    	let filename=files[0].name;
		    	if(filename.lastIndexOf('.')<=0){
		    		return alert('Please add a valid file!')
		    	}
		    	const fileReader=new FileReader()
		    	fileReader.addEventListener('load',()=>{
		    		
		    		this.imageUrl=fileReader.result
					this.btnImageDisabled=false
		    		this.btnText="Upload Image"
		    	
		    	})
		    	fileReader.readAsDataURL(files[0])
		    	
		    },
		    clearImage(){
		    	this.imageUrl=''
		    	const input = this.$refs.fileInput
		    	input.reset()
		    }
		}
	}
</script>