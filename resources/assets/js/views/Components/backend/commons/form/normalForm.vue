<template>
	<v-app id="inspire">
		<!--breadcrumbs start-->
			<breadcrumb3button
			v-bind:breadcrumb-item="breadcrumbs"
			v-bind:breadcrumb-title="breadcrumbTitle"
			v-bind:submit="submit"
			v-bind:is-valid="valid"
			v-bind:back-url="backUrl"
			></breadcrumb3button>
		<!--breadcrumbs end-->
		
		<v-form v-model="valid" ref="form" lazy-validation>
			<v-alert color="success" value='true' v-if="flash.success">
	          	{{flash.success}}
	      	</v-alert>
	      	<v-alert color="error" value='true' v-if="flash.error">
	          	{{flash.error}}
	      	</v-alert>
	      	<v-card flat>
	        	<v-card-text>
	        		<v-container grid-list-md offset-s3>
	          			<v-layout wrap>
	          				<v-flex v-for="input in formItems" :key="input.key" :class="input.class">
		      					<div v-if="input.type=='select'">
									<v-select :label="input.text"  :rules="formRules[input.key]" v-model="formDatas[input.key]" :items="selectItems[input.items]" required></v-select>
		      					</div>
		      					<div v-if="input.type=='multiple'">
		      						<v-select :label="input.text"  :rules="formRules[input.key]" v-model="formDatas[input.key]" :items="selectItems[input.items]" autocomplete :loading="loading" multiple cache-items chips required :search-input.sync="search"></v-select>
		      					</div>
		      					<div v-if="input.type=='image'">
									<input type="file" id="fileInput"  style="display:none" ref="fileInput" accept="image/*" @change="onFilePicked">
									<v-layout align-center justify-center >
										<label for="fileInput" style="width: 500px;height:auto;max-height: 300px;" >
											
												<v-card style="height: auto;max-height: 200px;padding: 10px;" v-if="formDatas[input.key]" @click="onPickFile">
													<v-badge color="red" overlap v-if="formDatas[input.key]">
														<v-btn  style="border-radius: 0px; margin-right: -20px; margin-top: -15px; height: 25px; width:50px; position: absolute; cursor: pointer; position: relative; opacity: 0.7; font-size: 8px;" @click="clearImage">
															Remove
														</v-btn>
													</v-badge>
													<v-layout align-center justify-center>
												    	<img :src="formDatas[input.key]" style="height:auto;max-height:200px;width: auto;"  @click="onPickFile">
													</v-layout>
												</v-card>
												
												<v-card style="height: 200px;" v-if="!formDatas[input.key]" @click="onPickFile">
													<v-layout align-center justify-center style="margin-top:75px;">
												    	<v-icon dark color="blue" x-large>backup</v-icon>
													</v-layout>
												</v-card>
										</label>
									</v-layout>
								</div>
								<div v-if="input.type=='password'">
									<v-text-field  label="Confirm Password" v-model="formDatas[input.key]" name="confirmpassword" :rules="formRules[input.key]" required :append-icon="e1 ? 'visibility' : 'visibility_off'" :append-icon-cb="() => (e1 = !e1)" :type="e1 ? 'password' : 'text'"></v-text-field>
								</div>
		      					<div v-if="input.type=='text'">
		      						<v-text-field v-if="formRules[input.key]" :label="input.text" :rules='formRules[input.key]' v-model="formDatas[input.key]" :counter="input.count" required></v-text-field>
									<v-text-field v-else :label="input.text" v-model="formDatas[input.key]" :counter="input.count"></v-text-field>
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
			'id',
			'breadcrumbTitle',
			'breadcrumbs',
			'formItems',
			'formRules',
			'formDatas',
			'selectItems',
			'url',
			'backUrl'
		],
		components:{
			'breadcrumb3button':breadcrumb3button
		},
		data(){
			return{
				e1:true,
				count:0,
				search: null,
				loading: false,
				valid:true,
				btnImageDisabled:false,
				btnText:'Upload Image',
				imageUrl:'sddfdg',
				image:null,
				flash:Flash.state
			}
		},
		mounted(){
			
		},
		watch: {
			search (val) {
			  val && this.querySelections(val)
			}
		},
		methods:{
			submit (opt) {
		      	if (this.$refs.form.validate()) {
			        // Native form submission is not yet supporte
			        
			        if(this.id==0){
			        	axios.post(this.url,{
				          data:this.formDatas

				        }).then((res)=>{
				        	if(res.data.success==true){
				        		Flash.setSuccess(res.data.message)
				        		if(opt==2){
				        			this.$router.push(this.backUrl)
				        		}
				        	}else{
				        		Flash.setError(res.data.message)
				        	}
				        })
			        }else{
			        	console.log(this.formDatas)
			        	axios.put(this.url+this.id, {
				          data:this.formDatas
				        }).then((res)=>{
				        	console.log(res.data)
				        	if(res.data.success==true){
				        		Flash.setSuccess(res.data.message)
				        		if(opt==2){
				        			this.$router.push(this.backUrl)
				        		}
				        	}else{
				        		Flash.setError(res.data.message)
				        	}
				        })
			        }
			        
		      	}
		    },
			onPickFile() {
				

		    	this.btnImageDisabled=true
		    	this.btnText="Uploading..."
		        
		    },
		    onFilePicked(event){
		    	
		    	
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
		    		this.formDatas.image=fileReader.result

		    	
		    	})
		    	fileReader.readAsDataURL(files[0])
		    	
		    },
		    clearImage(){
		    	this.imageUrl=''
		    	this.formDatas.image=''
		    	this.$refs.fileInput=''
		    },
		    querySelections (v) {
				this.loading = true
					// Simulated ajax query
					setTimeout(() => {
					this.items = this.states.filter(e => {
					return (e || '').toLowerCase().indexOf((v || '').toLowerCase()) > -1
				})
					this.loading = false
				}, 500)
		    }
		}
	}
</script>