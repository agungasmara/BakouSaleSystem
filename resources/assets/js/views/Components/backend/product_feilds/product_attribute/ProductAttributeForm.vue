<template>
	<div>
		<table class="chk-tbl">
			<thead>
				<tr>
					<th>Attribute</th>
					<th>Language</th>
					<th>Text</th>
					<th style="width: 50px;">Action</th>
				</tr>
			</thead>
			<tbody>
				<tr v-if="formDatas.length>0" v-for="(attr,index) in formDatas">
					<td align="center">
						<v-flex xs12 sm10 md10>
							<v-select :label="'Attribute'"  :rules="rules" v-model="attr.attribute_id" :items="attributes" required></v-select>
						</v-flex>
					</td>
					<td align="center">
						<v-flex xs12 sm10 md10>
							<v-select :label="'Language'"  :rules="rules" v-model="attr.language_id" :items="languages" required></v-select>
						</v-flex>
					</td>
					<td align="center">
						<v-flex xs12 sm10 md10>
							<v-text-field :label="'Text'" :rules="[(v) => !!v || 'Text is required']" v-model="attr.text"></v-text-field>
						</v-flex>
					</td>
					<td align="center" style="width: 50px;">
						<span @click="formDatas.splice(index,1)" :disabled="!isValid" style="cursor: pointer;"> 
							<v-icon large material-icons color="red darken">indeterminate_check_box</v-icon>
				     	</span>
			     	</td>
				</tr>
				<tr >
					<td colspan="3" ></td>
					<td align="center">
						<span @click="addAttribute" :disabled="!isValid" style="cursor: pointer;">
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
				attributes:[],
				languages:[],
				rules:[(v) => !!v || 'Group Name is required'],
				attrText:''
			}
		},
		created(){
			this.getAttribute()
			this.getLanguage()
		},
		methods:{
			getAttribute(){
				axios.get('/api/getAttribute').then((res)=>{
					this.attributes=res.data
				})
			},
			getLanguage(){
				axios.get('/api/getLanguage').then((res)=>{
					this.languages=res.data
				})
			},
			addAttribute(){
				var attrArr={
					attribute_id:0,
					language_id:0,
					text:this.attrText

				}
				this.formDatas.push(attrArr)
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