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
				url:'/api/filters/',
				e1:true,
				valid: true,
			    group:[
					{	class:'xs12 sm6 md6',	 key:'name',	type:'text',	 text:'Filter Name'	},
					{	class:'xs12 sm6 md6',	 key:'filter_group_id',	type:'select',text:'Filter Group',items:'filterGroups'	},
					{	class:'xs12 sm6 md6',	 key:'sort_order',	type:'number',	 text:'Sort Order'	},
					{	class:'xs12 sm6 md6',	 key:'language_id',	type:'select',	 text:'Language',items:'languages'	}
				],
				rules:{
					name: [
				      (v) => !!v || 'Filter Name is required'
				    ],
				    filter_group_id:[
				      (v) => !!v || 'Language Requied is required'
				    ],
				    language_id:[
				      (v) => !!v || 'Language Requied is required'
				    ]
				},
				data:{
					name:'',
					filter_group_id:'',
					language_id:'',
					sort_order:0,
				},
				select:{
					filterGroups:[],
					languages:[]
				},
				breadcrumbTitle:'Filter',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Filter',
			          disabled: false
			        },
			        {
			          text: 'Create',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/filters/list',
			}
		},
		created(){
			this.getFilterGroup()
			this.getLanguage()
		},
		methods:{
			getFilterGroup(){
				axios.get('/api/getFilterGroup').then((res)=>{
					this.select.filterGroups=res.data
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