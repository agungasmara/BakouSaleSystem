<template>
	<div>
		<table class="chk-tbl">
			<thead>
				<tr>
					<th>Additional Image</th>
					<th>Sort Order</th>
					<th style="width: 50px;">Action</th>
				</tr>
			</thead>
			<tbody>
				<tr v-if="formDatas.length>0" v-for="(attr,index) in formDatas">
					<td align="center">
						<v-flex xs12 sm10 md10>
							<div>
								<v-form>
									<input type="file" :id="'additionalImage'+index" style="display: none;" ref="additionalImage" accept="image/*" @change="onFilePicked(index)">
								
								<v-layout align-center justify-center >
									<label style="width: auto;min-width:100px;max-width:200px;min-height:100px;height:auto;max-height: 200px;" >
										
											<div style="height: auto;max-height: 200px;padding: 10px;" v-if="attr.image" @click="onPickFile(index)">
												<!-- <v-badge color="red" overlap v-if="attr.image">
													<v-btn  style="border-radius: 0px; margin-right: -20px; margin-top: -15px; height: 25px; width:50px; position: absolute; cursor: pointer; position: relative; opacity: 0.7; font-size: 8px;background-color: #ff0000;color:#ffffff;" @click="clearImage(index)">
														Remove
													</v-btn>
												</v-badge> -->
												<v-layout align-center justify-center>
													<img :src="attr.image" style="height:auto;max-height:90px;width: auto;margin-right:0px;margin-top:0px;"  @click="onPickFile(index)">
												</v-layout>
											</div>
											
											<v-flex style="height: 90px;" v-if="!attr.image" @click="onPickFile(index)">
												<v-layout align-center justify-center >
													<img class="image-dummy" width="100px" style="margin-top: 5px;" :src="'/images/icon/Antu_folder-camera.svg.png'">
												</v-layout>
											</v-flex>
									</label>

								</v-layout>
							</v-form>
							</div>
						</v-flex>
					</td>
					<td align="center">
						<v-flex xs12 sm10 md10>
							<v-text-field :label="'Text'" :rules="[(v) => !!v || 'Text is required']" v-model="attr.sort_order"></v-text-field>
						</v-flex>
					</td>
					<td align="center" style="width: 50px;">
						<span @click="formDatas.splice(index,1)" :disabled="!isValid" style="cursor: pointer;"> 
							<v-icon large material-icons color="red darken">indeterminate_check_box</v-icon>
				     	</span>
			     	</td>
				</tr>

				<tr >
					<td colspan="2" ></td>
					<td align="center">
						<span @click="addImage()" :disabled="!isValid" style="cursor: pointer;">
				     		<v-icon large material-icons color="blue darken">add_box</v-icon>
				     	</span>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>
<script>
	import axios from 'axios'
	export default{
		props:['formDatas'],
		data(){
			return{
				isValid:true,
				attruibuteID:0,
				rules:[(v) => !!v || 'Group Name is required'],
				attrText:'',
				btnImageDisabled:false,
				btnText:'Upload Image',
				imageUrl:'sddfdg',
				image:null,
				arrInd:0
			}
		},
		created(){
		},
		methods:{
			addImage(){
				var attrArr={
					image:0,
					sort_order:0
				}
				this.formDatas.push(attrArr)
				// this.formDatas.forEach(function(v,i){
				// 	vm.formDatas[i].image=fileReader.result
	   //  		})
			},
			onPickFile(index) {
				
				document.getElementById('additionalImage'+index).click();
		    	this.btnImageDisabled=true
		    	this.btnText="Uploading..."
		        
		    },
		    onFilePicked(index){
		    	var vm=this
		    	
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
		    		// this.formDatas.forEach(function(v,i){
		    		// 	if(i==i){
						vm.formDatas[index].image=fileReader.result
		    		// 	}
		    		// })
		    		
		    		//console.log(fileReader.result)

		    	
		    	})
		    	fileReader.readAsDataURL(files[0])
		    	
		    },
		    clearImage(index){
		    	this.imageUrl=''
		    	this.formDatas[index].image=''
		    	this.$refs.additionalImage=''
		    },
		}
	}
</script>

<style type="text/css">
	.current{
		background-color: #b3d4fc;
	}
	table.chk-tbl{
		background-color: #FFFFFF !important;
		border-radius:2px;
		border-collapse:collapse;
		border-spacing:0;
		table-layout:fixed;
		width: 100%;
		max-width: 100%;
	}
	table.chk-tbl tr th{
		border: solid 1px #d9dbdd;
		text-align: center;
	}
	table.chk-tbl tr.chk-row td{
		background-color: #edeff2;
	}
	table.chk-tbl tr td{
		border: solid 1px #d9dbdd;
	}
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