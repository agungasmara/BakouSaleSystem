<template>
	<v-layout row wrap>
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
					<label for="fileInput" style="width: auto;min-width:200px;max-width:500px;min-height:200px;height:auto;max-height: 300px;" >
						
							<v-card v-if="formDatas[input.key]" @click="onPickFile">
								<v-badge color="red" overlap v-if="formDatas[input.key]">
									<v-btn  style="border-radius: 0px; margin-right: -15px; margin-top: -0; height: 25px; width:100%;max-width: 80px; position: absolute; cursor: pointer; position: relative; opacity: 0.7; font-size: 11px;" @click="clearImage">
										Remove
									</v-btn>
								</v-badge>
								<v-layout align-center justify-center>
							    	<img :src="formDatas[input.key]" style="height:auto;max-height:200px;width: auto;margin-right:-110px;margin-top:-10px;"  @click="onPickFile">
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
			<div v-if="input.type=='textarea'">
				<v-text-field v-if="formRules[input.key]" textarea v-model="formDatas[input.key]" :rules='formRules[input.key]' :label="input.text" color="light-blue" required></v-text-field>
				<v-text-field v-else textarea v-model="formDatas[input.key]" :rules='formRules[input.key]' :label="input.text" color="light-blue"></v-text-field>
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
				<v-checkbox
		        :label="input.text"
		        v-model="formDatas[input.key]"
		        :rules="formRules[input.key]"
		        required
		    ></v-checkbox>
			</div>
			<div v-if="input.type=='text'">
				<v-text-field v-if="formRules[input.key]" :label="input.text" :rules='formRules[input.key]' v-model="formDatas[input.key]" :counter="input.count" required></v-text-field>
				<v-text-field v-else :label="input.text" v-model="formDatas[input.key]" :counter="input.count"></v-text-field>
			</div>
		</v-flex>
	</v-layout>
</template>
<script>
	import Flash from '../../../../../helper/flash'
	import axios from 'axios'
	//import { VueEditor } from 'vue2-editor'
	export default{
		props:[
			'formItems',
			'formRules',
			'formDatas',
			'selectItems',
		],
		
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