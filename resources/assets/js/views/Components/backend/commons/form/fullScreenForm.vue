<template>
		<v-form v-model="valid" ref="form" lazy-validation>
	      		<v-container grid-list-md>
                		<v-layout row wrap>
          				<v-flex v-for="input in formItems" :key="input.key" :class="input.class">
	      					<div v-if="input.type=='select'">
								<v-select :label="input.text"  :rules="formRules[input.key]" v-model="formDatas[input.key]" :items="selectItems[input.items]" required></v-select>
	      					</div>
	      					<div v-if="input.type=='multiple'">
	      						<v-select :label="input.text"  :rules="formRules[input.key]" v-model="formDatas[input.key]" :items="selectItems[input.items]" autocomplete :loading="loading" multiple cache-items chips required :search-input.sync="search"></v-select>
	      					</div>
	      					<div class="col s12 m12 l3" v-if="input.type=='image'">
					                    	
	                    		<div class="row text-lg-right">
		                    		<h4 class="header">
			                    	<center> Logo </center>
			                    	</h4>
			                    		
				                    	<div >
											<input type="file" id="fileInput"  style="display:none" ref="fileInput" accept="image/*" @change="onFilePicked">
											<v-layout align-center justify-center >
												<label for="fileInput" style="width: auto;min-width:50px;max-width:200px;min-height:50px;height:auto;max-height: 100px;" >
													
														<v-card style="height: auto;max-height: 50px;padding: 10px;" v-if="formDatas[input.key]" @click="onPickFile">
															<v-badge color="red" overlap v-if="formDatas[input.key]">
																<v-btn  style="border-radius: 0px; margin-right: -20px; margin-top: -15px; height: 25px; width:50px; position: absolute; cursor: pointer; position: relative; opacity: 0.7; font-size: 8px;" @click="clearImage">
																	Remove
																</v-btn>
															</v-badge>
															<v-layout align-center justify-center>
																<img :src="formDatas[input.key]" style="height:auto;max-height:50px;width: auto;margin-right:-110px;margin-top:-10px;"  @click="onPickFile">
															</v-layout>
														</v-card>
														
														<v-flex style="height: 50px;" v-if="!formDatas[input.key]" @click="onPickFile">
															<v-layout align-center justify-center >
																<img class="image-dummy" width="200px" :src="'/images/icon/Antu_folder-camera.svg.png'">
															</v-layout>
														</v-flex>
												</label>
											</v-layout>
										</div>
		                    	</div>
		                    </div>
							<div v-if="input.type=='password'">
								<v-text-field  label="Confirm Password" v-model="formDatas[input.key]" name="confirmpassword" :rules="formRules[input.key]" required :append-icon="e1 ? 'visibility' : 'visibility_off'" :append-icon-cb="() => (e1 = !e1)" :type="e1 ? 'password' : 'text'"></v-text-field>
							</div>
							<div v-if="input.type=='textarea'">
								<v-text-field v-if="formRules[input.key]" multi-line v-model="formDatas[input.key]" :rules='formRules[input.key]' :label="input.text" color="light-blue" required></v-text-field>
								<v-text-field v-else textarea v-model="formDatas[input.key]" :rules='formRules[input.key]' :label="input.text" color="light-blue"></v-text-field>
								
							</div>
							<div v-if="input.type=='editor'">
								 <vue-editor v-model="formDatas[input.key]" style="min-height: 200px;" :editorToolbar="toolbar"></vue-editor>
							</div>
							<div v-if="input.type=='date'">
								<v-menu
						          lazy
						          :close-on-content-click="false"
						          v-model="selectItems[input.menu]"
						          transition="scale-transition"
						          offset-y
						          full-width
						          :nudge-right="40"
						          max-width="290px"
						          min-width="290px"
						        >
						          <v-text-field
						            slot="activator"
						            label="Picker in menu"
						            v-model="formDatas[input.key]"
						            prepend-icon="event"
						            readonly
						          ></v-text-field>
						          <v-date-picker v-model="formDatas[input.key]" no-title scrollable actions>
						            <template slot-scope="{ save, cancel }">
						              <v-card-actions>
						                <v-spacer></v-spacer>
						                <v-btn flat color="primary" @click="cancel">Cancel</v-btn>
						                <v-btn flat color="primary" @click="save">OK</v-btn>
						              </v-card-actions>
						            </template>
						          </v-date-picker>
						        </v-menu>
							</div>
							<div v-if="input.type=='number'">
	      						<v-text-field type="number" v-if="formRules[input.key]" :label="input.text" :rules='formRules[input.key]' v-model="formDatas[input.key]" :counter="input.count" required></v-text-field>
								<v-text-field v-else :label="input.text" v-model="formDatas[input.key]" :counter="input.count"></v-text-field>
	      					</div>
	      					<div v-if="input.type=='checkbox'">
	      						<v-checkbox v-if="formRules[input.key]"
							        :label="input.text"
							        v-model="formDatas[input.key]"
							        :rules="formRules[input.key]"
							        required
							    ></v-checkbox>
							    <v-checkbox v-else
							        :label="input.text"
							        v-model="formDatas[input.key]"
							        :rules="formRules[input.key]"
							    ></v-checkbox>
	      					</div>
	      					<div v-if="input.type=='text'">
	      						<v-text-field v-if="formRules[input.key]" :label="input.text" :rules='formRules[input.key]' v-model="formDatas[input.key]" :counter="input.count" required></v-text-field>
								<v-text-field v-else :label="input.text" v-model="formDatas[input.key]" :counter="input.count"></v-text-field>
	      					</div>
	      				</v-flex>
	      			</v-layout>
	      		</v-container>
	    </v-form>
</template>
<script>
	import Flash from '../../../../../helper/flash'
	import axios from 'axios'
	import breadcrumb3button from '../breadcrumb/breadcrumb3button.vue'
	var toolbars=[
				[
					'bold', 'italic', 'underline', 'strike',
					{ 'header': 1 }, 
					{ 'header': 2 },
					{ 'script': 'sub'},
					{ 'script': 'super' },
					{ 'indent': '-1'}, 
					{ 'indent': '+1' },
					{ 'list': 'ordered'}, { 'list': 'bullet' },
					'image'
				]
			]
	export default{
		props:[
			'id',
			'lid',
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
			//VueEditor
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
				flash:Flash.state,
				toolbar:toolbars,
			}
		},
		
		mounted(){
			
		},
		watch: {
			search (val) {
			  val && this.querySelections(val)
			}
		},
		// editorSettings: {
		//       modules: {
		//         imageDrop: true,
		//         imageResize: {}
		//       }
		//     },
		methods:{
			
			submit (opt) {
		      	if (this.$refs.form.validate()) {
			        // Native form submission is not yet supporte
			        
			        if(this.id==0){
			        	axios.post(this.url,
				          this.formDatas
				        ).then((res)=>{
				        	console.log(res.data)
				        	if(res.data.success==true){
				        		Flash.setSuccess(res.data.message)
				        		this.$refs.form.reset()
				        		if(opt==2){
				        			this.$router.push(this.backUrl)
				        		}
				        	}else{
				        		Flash.setError(res.data.message)
				        	}
				        })
				        .catch((err) => {
	                      	if(err.response.status === 422) {
	                          	this.error = err.response.message
							}
							Flash.setError('Error while saving data')
	                  	})
			        }else{
			        	console.log(this.formDatas)
			        	var url
			        	if(this.lid>0){
			        		url=this.url+this.id+'/'+this.lid
			        	}else{
			        		url=this.url+this.id
			        	}
			        	axios.put(url,
				          	this.formDatas
				        ).then((res)=>{
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
				        .catch((err) => {
	                      	if(err.response.status === 422) {
	                          	this.error = err.response.message
							}
							Flash.setError('Error while updateing data')
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
<style type="text/css">
	.image-dummy{
		opacity: 0.5;
		transition: all 0.5s ease;
		-webkit-transition: all 0.5s ease;
		-o-transition: all 0.5s ease;
		-moz-transition: all 0.5s ease;
	}
	.image-dummy:hover{
		opacity: 0.8;
		cursor: pointer;
	}
</style>