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
				url:'/admin/api/customer_groups/',
				e1:true,
				valid: true,
			    group:[
					{	class:'xs12 sm12 md12',	 key:'name',	type:'text',	 text:'Group Name'	},
					{	class:'xs12 sm12 md12',	 key:'description',	type:'editor',text:'Description'},
					{	class:'xs12 sm12 md12',	 key:'approval',	type:'checkbox',	 text:'Aprrove new customer',	},
					{	class:'xs12 sm6 md6',	 key:'sort_order',	type:'number',	 text:'Sort Order',	},
					{	class:'xs12 sm6 md6',	 key:'language_id',	type:'select',	 text:'Language',items:'languages'	}
				],
				rules:{
					name: [
				      (v) => !!v || 'Group Name is required'
				    ],
				    attribute_group_id:[
				      (v) => !!v || 'Group is required'
				    ],
				    language_id:[
				      (v) => !!v || 'Language is required'
				    ]
				},
				data:{
					approval:0,
					name:'',
					attribute_group_id:'',
					language_id:'',
					sort_order:0,
				},
				select:{
					attributeGroups:[],
					languages:[]
				},
				breadcrumbTitle:'Customer Group',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Customer Group',
			          disabled: false
			        },
			        {
			          text: 'Create',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/customer_groups/list',
			}
		},
		created(){
			this.getLanguage()
		},
		methods:{
			getLanguage(){
				axios.get('/admin/api/getLanguage').then((res)=>{
					this.select.languages=res.data
				})
			}
		}
	}
</script>