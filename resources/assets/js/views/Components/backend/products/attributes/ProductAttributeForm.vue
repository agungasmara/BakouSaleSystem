<template>
	<v-app id="inspire">
		<table class="table chk-tbl datatable">
			<thead>
				<tr>
					<th>Attribute</th>
					<th>Text</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<tr v-if="attributeArr.length>0" v-for="(attr,index) in attributeArr">
					<td>
						<v-select :label="'Attribute'"  :rules="rules" v-model="attr.attrId" :items="attributes" required></v-select>
					</td>
					<td>
						<v-text-field :label="'Text'" :rules="[(v) => !!v || 'Text is required']" v-model="attr.text"></v-text-field>
					</td>
					<td>
						<span @click="attributeArr.splice(index,1)" :disabled="!isValid" style="cursor: pointer;"> 
							<v-icon large material-icons color="red darken">indeterminate_check_box</v-icon>
				     	</span>
			     	</td>
				</tr>
				<tr >
					<td colspan="2" align="center"></td>
					<td>
						<span @click="addAttribute" :disabled="!isValid" style="cursor: pointer;">
				     		<v-icon large material-icons color="blue darken">add_box</v-icon>
				     	</span>
					</td>
				</tr>
			</tbody>
		</table>
	</v-app>
</template>
<script>
	import axios from 'axios'
	export default{
		components:{
			
		},
		data(){
			return{
				isValid:true,
				attruibuteID:0,
				attributes:[],
				attributeArr:[],
				rules:[(v) => !!v || 'Group Name is required'],
				id:'',
				attrText:''
			}
		},
		created(){
			this.getAttribute()
		},
		methods:{
			getAttribute(){
				axios.get('/api/getAttribute').then((res)=>{
					this.attributes=res.data
				})
			},
			addAttribute(){
				var attrArr={

					id:this.id,
					attrId:this.attruibuteID,
					text:this.attrText

				}
				this.attributeArr.push(attrArr)
				this.id=this.id+1
			}
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
</style>