<template>
	<v-app id="inspire">
		<normal-form
			v-bind:url="url"
			v-bind:id="0"
			v-bind:breadcrumb-title="breadcrumbTitle"
			v-bind:breadcrumbs="breadcrumbs"
			v-bind:form-items="group"
			v-bind:form-rules="rules"
			v-bind:form-datas="data"
			v-bind:select-items="select"
			v-bind:back-url="backUrl"
		></normal-form>
	</v-app>
</template>
<script>
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	import normalForm from '../commons/form/normalForm.vue'
	export default{
		components:{
			'normalForm':normalForm
		},
		data(){
			return{
				url:'/api/attribute/',
				e1:true,
				valid: true,
			    group:[
					{	class:'xs12 sm6 md6',	 key:'name',	type:'text',	 text:'Attribute Name'	},
					{	class:'xs12 sm6 md6',	 key:'attribute_group_id',	type:'select',text:'Attribute Group',items:'attributeGroups'	},
					{	class:'xs12 sm6 md6',	 key:'sort_order',	type:'number',	 text:'Sort Order'	},
					{	class:'xs12 sm6 md6',	 key:'language_id',	type:'select',	 text:'Language',items:'languages'	}
				],
				rules:{
					name: [
				      (v) => !!v || 'Attribute Name is required',
				    ],
				    attribute_group_id:[
				      (v) => !!v || 'Group is required'
				    ],
				    language_id:[
				      (v) => !!v || 'Language is required'
				    ]
				},
				data:{
					name:'',
					attribute_group_id:'',
					language_id:'',
					sort_order:0,
				},
				select:{
					attributeGroups:[],
					languages:[]
				},
				breadcrumbTitle:'Attributes',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Attributes',
			          disabled: false
			        },
			        {
			          text: 'Create',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/attributes/list',
			}
		},
		created(){
			this.getAttributeGroup()
			this.getLanguage()
		},
		methods:{
			getAttributeGroup(){
				axios.get('/api/getAttributeGroup').then((res)=>{
					this.select.attributeGroups=res.data
				})
			},
			getLanguage(){
				axios.get('/api/getLanguage').then((res)=>{
					this.select.languages=res.data
				})
			}
		}
	}
</script>