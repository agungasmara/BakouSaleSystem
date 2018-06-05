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
	import Flash from '../../../../../helper/flash'
	import axios from 'axios'
	import normalForm from '../../commons/form/normalForm.vue'
	export default{
		components:{
			'normalForm':normalForm
		},
		data(){
			return{
				url:'/admin/api/attribute_group/',
				e1:true,
				valid: true,
			    group:[
			    	{	class:'xs12 sm4 md4',	 key:'language_id',	type:'select',	 text:'Language',count:100,items:'languages'	},
					{	class:'xs12 sm4 md4',	 key:'name',	type:'text',	 text:'Group Name',count:100	},
					{	class:'xs12 sm4 md4',	 key:'sort_order',	type:'number',	 text:'Sort Order',count:100	}
				],
				rules:{
					name: [
				      (v) => !!v || 'Attribute Name is required',
				      (v) => v && v.length <= 100 || 'Title must be less than 100 characters'
				    ],
				    language_id:[
				      (v) => !!v || 'Language Requied is required'
				    ]
				},
				data:{
					name:'',
					language_id:'',
					sort_order:0,
				},
				select:{
					languages:[]
				},
				breadcrumbTitle:'Attributes Group',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Attributes Group',
			          disabled: false
			        },
			        {
			          text: 'Create',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/attributes_group/list',
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