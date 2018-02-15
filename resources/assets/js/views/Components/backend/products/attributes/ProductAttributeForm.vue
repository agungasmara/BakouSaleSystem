<template>
	<v-app id="inspire">
		<table>
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
					<td colspan="2"></td>
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