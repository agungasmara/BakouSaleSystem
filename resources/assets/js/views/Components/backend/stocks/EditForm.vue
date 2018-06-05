<template id="{{ $route.params.id }}">
	<v-app id="inspire">
		<normal-form
			v-bind:url="url"
			v-bind:id="dataID"
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
				url:'/admin/api/stock_status/',
				e1:true,
				valid: true,
				btnImageDisabled:false,
				btnText:'Upload Image',
				imageUrl:'',
				image:null,
			    group:[
					{	class:'xs12 sm6 md6',	 key:'language_id',	type:'select',	 text:'Store',count:100,items:'languages',	},
					{	class:'xs12 sm6 md6',	 key:'name',	type:'text',text:'Status Name',count:100	}
				],
				rules:{
					name: [
				      (v) => !!v || 'Status Name is required',
				      (v) => v && v.length <= 100 || 'Status Name must be less than 100 characters'
				    ],
				    language_id:[v => !!v || 'Item is required']
				},
				data:{
					name:'',
					language_id: null
				},
				select:{
					languages:[]
				},
				breadcrumbTitle:'Stock Status',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Stock Status',
			          disabled: false
			        },
			        {
			          text: 'Create',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/stock_status/list',
			}
		},
		created(){
			this.dataID=this.id
			this.fetchData(this.id)
			this.fetchLanguage()
		},
		methods:{
			fetchData(id){
				axios.get(this.url+id+'/edit').then(res=>{
					this.data=res.data
				});
			},
			fetchLanguage(){
				axios.get('/admin/api/getLanguage').then((res)=>{
					this.select.languages=res.data
					// console.log(res.data.code)
				})
			}
		}
	}
</script>