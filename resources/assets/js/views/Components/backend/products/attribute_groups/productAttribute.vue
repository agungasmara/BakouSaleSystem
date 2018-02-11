<template>
	<div>
		<v-form v-model="valid" ref="form" lazy-validation>
			<div class="row">
				
				<v-flex v-for="(index,attr) in attribute" :key="attr.value">
					<v-container grid-list-md>
						<v-flex col s12 m12 l3>
							<v-select label="Attribute"  :rules="attrRule" v-model="attr" :items="selectItems" required></v-select>
						</v-flex>
						<v-flex col s12 m12 l6>
							<v-text-field   required></v-text-field>
						</v-flex>
						<v-flex col s12 m12 l3>
							<v-btn @click.prevent="addAttribute()" class="btn dropdown-settings waves-effect waves-light right" color="success"></v-btn>
						</v-flex>
					</v-container>
				</v-flex>
			</div>
		</v-form>
	</div>
</template>

<script type="text/javascript">
	export default{
		data(){
			return{
				attr:'',
				selectItems:[
					{value:1,text:'test1'},
					{value:2,text:'test2'},
					{value:3,text:'test3'}
				],
				attribute:['attribute'],
				attrRule:[(v) => !!v || 'Username is required']
			}
		},
		methods:{
			addAttribute(){
				this.attribute.push('attribute')
			}
		}
	}
</script>