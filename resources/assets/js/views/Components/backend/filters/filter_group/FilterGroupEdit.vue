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
	import Flash from '../../../../../helper/flash'
	import axios from 'axios'
	import normalForm from '../../commons/form/normalForm.vue'
	export default{
		props:['id'],
		components:{
			'normalForm':normalForm
		},
		data(){
			return{
				url:'/api/filters_group/',
				e1:true,
				valid: true,
			    group:[
			    	{	class:'xs12 sm4 md4',	 key:'language_id',	type:'select',	 text:'Language',items:'languages'	},
					{	class:'xs12 sm4 md4',	 key:'name',	type:'text',	 text:'Group Name'	},
					{	class:'xs12 sm4 md4',	 key:'sort_order',	type:'number',	 text:'Sort Order'	}
				],
				rules:{
					name: [
				      (v) => !!v || 'Group Name is required'
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
				breadcrumbTitle:'Filter Group',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Filter Group',
			          disabled: false
			        },
			        {
			          text: 'Edit',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/filters_group/list',
			}
		},
		created(){
			this.dataID=this.id
			this.fetchData(this.id)
			this.getLanguage()
		},
		methods:{
			fetchData(id){
				axios.get(this.url+id+'/edit').then(res=>{
					this.data=res.data
					console.log(res.data)
				});
			},
			getLanguage(){
				axios.get('/api/getLanguage').then((res)=>{
					this.select.languages=res.data
				})
			}
		}
	}
</script>