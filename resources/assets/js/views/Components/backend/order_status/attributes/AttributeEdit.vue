<template id="{{ $route.params.id }}">
	<v-app id="inspire">
		<normal-form
			v-bind:url="url"
			v-bind:id="id"
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
		props:['id'],
		components:{
			'normalForm':normalForm
		},
		data(){
			return{
				url:'/admin/api/attribute/',
				e1:true,
				valid: true,
			    group:[
					{	class:'xs12 sm6 md6',	 key:'name',	type:'text',	 text:'Attribute Name',count:100	},
					{	class:'xs12 sm6 md6',	 key:'attribute_group_id',	type:'select',text:'Attribute Group',count:0,items:'attributeGroups'	},
					{	class:'xs12 sm6 md6',	 key:'sort_order',	type:'number',	 text:'Sort Order',count:100	},
					{	class:'xs12 sm6 md6',	 key:'language_id',	type:'select',	 text:'Language',count:100,items:'languages'	}
				],
				rules:{
					name: [
				      (v) => !!v || 'Attribute Name is required',
				      (v) => v && v.length <= 100 || 'Title must be less than 100 characters'
				    ],
				    attribute_group_id:[
				      (v) => !!v || 'Language Requied is required'
				    ],
				    language_id:[
				      (v) => !!v || 'Language Requied is required'
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
			this.dataID=this.id
			this.fetchData(this.id)
			this.getAttributeGroup()
			this.getLanguage()
		},
		methods:{
			fetchData(id){
				axios.get(this.url+id+'/edit').then(res=>{
					this.data=res.data
					console.log(res.data)
				});
			},
			getAttributeGroup(){
				axios.get('/admin/api/getAttributeGroup').then((res)=>{
					this.select.attributeGroups=res.data
				})
			},
			getLanguage(){
				axios.get('/admin/api/getLanguage').then((res)=>{
					this.select.languages=res.data
				})
			}
		}
	}
</script>